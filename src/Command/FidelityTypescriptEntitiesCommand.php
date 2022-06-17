<?php

namespace App\Command;

use phpDocumentor\Reflection\Type;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FidelityTypescriptEntitiesCommand extends Command
{
    protected static $defaultName = 'fidelity:js:entities';

    protected function configure()
    {
        $this
            ->setDescription('Create a self contained file with all Doctrine Enities in Typescript Lang')
            // ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            // ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');

        $files = scandir('./src/Entity/Fidelity');
        $phpFiles = array_values(array_filter($files, function ($arr) {
            return strstr($arr, ".php");
        }));

        $phpClassNames = [];
        $dartEntities = [];

        foreach ($phpFiles as $file) {
            // dd($file);
            // if($file == 'Users.php') {
                $phpClassNames[] = str_replace(".php", "", $file);
            // }
            //break;
        }

        $io->text("Reading files...");
        foreach ($phpClassNames as $className) {
            $this->generateArray($className, $dartEntities);
        }

        $allFile = <<<TS
import { format as dateFnsFormat } from 'date-fns'
import { BaseModel, DateTimeNullable } from './base-model'

TS;
        $io->text("Generating classes");
        foreach ($dartEntities as $classe => $props) {
            $allFile .= $this->generateDartClass($classe, $props, $phpClassNames);
        }

        $io->text("Writing File");
        print_r(dir(__DIR__.'/../../../admin/src/model/')->path);
        file_put_contents(dir(__DIR__.'/../../../admin/src/model/')->path . '/index.ts', $allFile);
        //$io->write("Done.");
        $io->success('Done!');
        return 0;
    }

    private function generateArray(string $class, array &$dart)
    {
        $className = "App\Entity\\Fidelity\\" . $class;
        // print $className."\n";

        $reflectionClass = new \ReflectionClass($className);

        $propertiesArray = $reflectionClass->getDefaultProperties();
        $properties = $reflectionClass->getProperties();

        // dd($properties[0], $properties[0]->isDefault());

        $arrayPropertyNames = [];
        $arrayTypes = [];
        $arrayDartProperties = [];

        $skipColumns = ['id', 'createdBy', 'updatedBy', 'createdAt', 'updatedAt', 'deletedAt', 'statusCode'];

        foreach ($properties as $prop) {
            if(in_array($prop->getName(), $skipColumns)) {
                continue;
            }

            $arrayPropertyNames[] = $prop->getName();
            if($prop->getName() === 'id')
            {
                $arrayDartProperties[] = 'public id: string | null = null';
                $arrayTypes['id'] = ['string', 'null'];
                continue;
            }

            $docBlockType = $this->getDocBlockType($prop->getDocComment());
            $defaultValue = $propertiesArray[$prop->getName()] ?? null;
            $mappedType = $docBlockType;

            $arrayTypes[$prop->getName()] = $mappedType;

            if($class === "PaymentType") {
                dump($this->getDocBlockType($prop->getDocComment(), $class));
            }

            if ($defaultValue !== null) {
                $_type = implode(" | ", $mappedType);

                if ($defaultValue === 'CURRENT_TIMESTAMP') {
                    // $defaultValue = "moment().format('YYYY-MM-DD HH:mm:ss')";
                    $defaultValue = "dateFnsFormat(Date.now(), 'yyyy-MM-dd HH:mm:ss')";
                }

                $defaultValue = is_array($defaultValue) ? '[]' : $defaultValue;

                if (in_array('string', $mappedType)) {
                    $arrayDartProperties[] = "public {$prop->getName()} = '{$defaultValue}'";
                } else if (in_array('boolean', $mappedType)) {
                    $arrayDartProperties[] = "public {$prop->getName()} = " . ($defaultValue ? 'true' : 'false') . "";
                } else {
                    $arrayDartProperties[] = "public {$prop->getName()} = " . (string)$defaultValue . "";
                }
            } else {
                // string always have empty value
                // if($mappedType)
                $timestampables = ['createdAt', 'updatedAt', 'deletedAt'];
                $blamables = ['createdBy','updatedBy'];


                $_type = implode(" | ", $mappedType);
                $_defaultValue = "";
                $_defaultValueProp = "";

                if(in_array('null', $mappedType) || in_array('DateTimeNull', $mappedType)) {
                    $_defaultValue = "null";
                }

                if(in_array('string', $mappedType) && in_array('null', $mappedType)) {
                    $_defaultValue = "''";
                }

                if(in_array($prop->getName(), $timestampables) || in_array($prop->getName(), $blamables)) {
                    $_defaultValue = 'null';
                }

                if(count($mappedType) === 1 && $mappedType[0] === 'string') {
                    $_defaultValue = "''";
                }

                if(count($mappedType) === 1 && $mappedType[0] === 'boolean') {
                    $_defaultValue = "false";
                }

                if(count($mappedType) === 1 && $mappedType[0] === 'number') {
                    $_defaultValue = "0";
                }


                if($_defaultValue !== '') {
                    $_defaultValueProp = " = {$_defaultValue}";
                }
                if(!in_array($_type, ['string', 'boolean', 'number'])) {
                    $arrayDartProperties[] = "public {$prop->getName()}: {$_type}{$_defaultValueProp}";
                } else
                {
                    $arrayDartProperties[] = "public {$prop->getName()}{$_defaultValueProp}";
                }

            }
        }

        $dart[$class] = ['dart' => $arrayDartProperties, 'json' => $arrayPropertyNames, 'types' => $arrayTypes];
    }

    private function getDocBlockType(string $docBlock, $classe = '')
    {
        $nativeTypes = ['object','string', 'number', 'boolean', 'function', 'DateTimeNull'];
        $defType = 'string';
        if (preg_match('/@var\s+([^\s]+)/', $docBlock, $matches)) {
            list(, $type) = $matches;
            $defType = $type;
        }

        $defType = str_replace("ArrayCollection<", "Array<", $defType);

        $multiTypes = explode("|", $defType);



        $types = [];
        foreach ($multiTypes as $t) {
            if(!in_array($t, ["ArrayCollection"])) {
                $types[] = $this->mapPhpTypesToTypescriptTypes($t);
            }
        }

        if(in_array('DateTimeNull', $types)) {
            $types = ['DateTimeNull'];
        }


        if(count($types) === 1 && !in_array($types[0], $nativeTypes)) {
            $types[] = 'null';
        }


//        if (count($multiTypes) > 1) {
//            $defType = $multiTypes[0] == "ArrayCollection" ? $multiTypes[1] : $multiTypes[0];
//        }
//
//        if (strstr($defType, "[]") !== false) {
//            $noSquareBrackets = str_replace("[]", "", $defType);
//            $defType = "List<{$noSquareBrackets}>";
//        }

        return $types;
    }

    private function generateDartClass($classe, $props, $phpClassNames)
    {
        $fromJson = [];
        $toJson = [];
        foreach ($props['json'] as $jsonProps) {
            $type = preg_replace('/(List\<)([A-z]{1,})(\>)/', '$2', $props['types'][$jsonProps]);
            //print_r($phpClassNames);

            $typeIsList = strstr(implode("|",$props['types'][$jsonProps]), "List<") !== false;

            $isInPHPClasses = array_filter($type, function($arr) use ($phpClassNames){
               return in_array($arr, $phpClassNames);
            });

            if(count($isInPHPClasses)>=1) {
                $__type = $isInPHPClasses[0];
                $fromJson[] = "this.{$jsonProps} = {$__type}.fromJson(json['{$jsonProps}'])";
            } else {
                $isInPHPClassesArray = array_filter($type, function ($arr) use ($phpClassNames) {
                    return in_array(str_replace('[]', '', $arr), $phpClassNames);
                });

                if(count($isInPHPClassesArray)>=1) {
                    // dump($classe, $isInPHPClassesArray);
                    $__type = str_replace('[]', '', $isInPHPClassesArray[array_key_first($isInPHPClassesArray)]);
                    $fromJson[] = "this.{$jsonProps} = {$__type}.fromJsonArray(json['{$jsonProps}'])";
                } else {
                    $fromJson[] = "this.{$jsonProps} = isNullOrUndef(json['{$jsonProps}'], this.{$jsonProps}, json['{$jsonProps}'])";
                }
            }

//            if ($typeIsList && in_array($type, $phpClassNames)) {
//                //(json['userss'] as List)?.map((i) => Users.fromJson(i))?.toList();
//                $fromJson[] = "this.{$jsonProps} = (json['$jsonProps'] as List)?.map((i) => {$type}.fromJson(i))?.toList();";
//            } else if ($typeIsList && !in_array($type, $phpClassNames)) {
//                //(json['userss'] as List)?.map((i) => Users.fromJson(i))?.toList();
//                $fromJson[] = "this.{$jsonProps} = (json['$jsonProps'] as List)?.map((i) => (i as {$type}))?.toList();";
//            } else if (in_array($type, $phpClassNames)) {
//                print "entra aki?\n";
//                $fromJson[] = "this.{$jsonProps} = {$type}.fromJson(json['{$jsonProps}']);";
//            } else {
//                if ($type == 'DateTime') {
//                    $fromJson[] = "this.{$jsonProps} = DateTime.tryParse(json['{$jsonProps}'] ?? '') ?? {$jsonProps};";
//                } else {
//                    $fromJson[] = "this.{$jsonProps} = json['{$jsonProps}'] ?? {$jsonProps};";
//                }
//            }

//            if ($type == 'DateTime') {
//                $toJson[] = "obj['{$jsonProps}'] = {$jsonProps}.toString();";
//            } else {
//                $toJson[] = "obj['{$jsonProps}'] = {$jsonProps};";
//            }
        }

        $props = implode("\n  ", $props['dart']);
        $propsTrimmed = strlen($props) > 0 ? '  '.$props : '';
        $file = "
export class {$classe} extends BaseModel {
  [key: string]: any
{$propsTrimmed}
  static fromJson = (json: any | {$classe}) => Object.assign(new {$classe}(), json)
  static fromJsonArray = (json: any[]): {$classe}[] => {
    return json.map(function (item: any | {$classe}) {
      return {$classe}.fromJson(item)
    })
  }
}
";
        return $file;
    }

    private function mapPhpTypesToTypescriptTypes($value)
    {
        $mappedType = $value;
        switch ($value) {
            case 'List<string>':
                $mappedType = 'List<String>';
                break;
            case 'UuidInterface':
            case 'string':
                $mappedType = 'string';
                break;
            case 'DateTime':
                $mappedType = 'DateTimeNullable';
                break;
            case 'bool':
            case 'boolean':
                $mappedType = 'boolean';
                break;
            case 'float':
            case '?float':
            case 'int':
            case '?int':
                $mappedType = 'number';
                break;
            case 'array':
                $mappedType = '[]';
                break;
            case 'null':
                $mappedType = 'null';
                break;
            case 'ArrayCollection':
                $mappedType = 'Array';
                break;
            default:
                $mappedType = $value;
        }
        return $mappedType;
    }
}
