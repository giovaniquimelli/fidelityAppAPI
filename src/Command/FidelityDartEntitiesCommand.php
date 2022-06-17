<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FidelityDartEntitiesCommand extends Command
{
    protected static $defaultName = 'fidelity:dart:entities';

    protected function configure()
    {
        $this
            ->setDescription('Create a self contained file with all Doctrine Enities in Dart Lang')
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
            $phpClassNames[] = str_replace(".php", "", $file);
        }

        $io->text("Reading files...");
        foreach ($phpClassNames as $className) {
            $this->generateArray($className, $dartEntities);
        }

        $allFile = "import 'dart:convert'; \n\n";
        $io->text("Generating classes");
        foreach ($dartEntities as $classe => $props) {
            $allFile .= $this->generateDartClass($classe, $props, $phpClassNames);
        }

        $io->text("Writing File");
        file_put_contents($_SERVER['DART_ENTITIES_PATH_UNIX'], $allFile);
        //$io->write("Done.");
        $io->success('Done!');

        return 0;
    }

    private function getDocBlockType(string $docBlock)
    {
        $defType = 'String';
        if (preg_match('/@var\s+([^\s]+)/', $docBlock, $matches)) {
            list(, $type) = $matches;
            $defType = $type;
        }

        $multiTypes = explode("|", $defType);
        if (count($multiTypes) > 1) {
            $defType = $multiTypes[0] == "ArrayCollection" ? $multiTypes[1] : $multiTypes[0];
        }

        if (strstr($defType, "[]") !== false) {
            $noSquareBrackets = str_replace("[]", "", $defType);
            $defType = "List<{$noSquareBrackets}>";
        }

        return $defType;
    }

    private function generateArray(string $class, array &$dart){
        $className = "App\Entity\Fidelity\\" . $class;
         print $className."\n";

        $reflectionClass = new \ReflectionClass($className);

        $propertiesArray = $reflectionClass->getDefaultProperties();
        $properties = $reflectionClass->getProperties();

        $arrayPropertyNames = [];
        $arrayTypes = [];
        $arrayDartProperties = [];

        foreach ($properties as $prop) {

            $arrayPropertyNames[] = $prop->getName();
            $docBlockType = $this->getDocBlockType($prop->getDocComment());
            $defaultValue = $propertiesArray[$prop->getName()] ?? null;
            $mappedType = 'String';


            // map types
            switch ($docBlockType) {
                case 'List<string>':
                    $mappedType = 'List<String>';
                    break;
                case 'UuidInterface':
                case 'string':
                    $mappedType = 'String';
                    break;
                case 'int':
                    $mappedType = 'int';
                    break;
                case 'bool':
                    $mappedType = 'bool';
                    $defaultValue = $defaultValue ? 'true' : 'false';
                    break;
                case 'boolean':
                    $mappedType = 'bool';
                    break;
                case 'float':
                case '?float':
                    $mappedType = 'double';
                    break;
                case 'DateTime':
                    $mappedType = 'DateTime';
                    break;
                default:
                    $mappedType = $docBlockType;
            }

            $arrayTypes[$prop->getName()] = $mappedType;

            if ($defaultValue !== null) {

                if($defaultValue === 'CURRENT_TIMESTAMP')
                {
                    $defaultValue = 'DateTime.now()';
                }
                $defaultValue = is_array($defaultValue) ? implode(",", $defaultValue) : $defaultValue;

                    //$mappedTypee = is_array($mappedType) ? implode(" ", $mappedType) : $mappedType;
                if ($mappedType === "String") {

                    $arrayDartProperties[] = "{$mappedType} {$prop->getName()} = \"{$defaultValue}\";";
                } else {

                    $arrayDartProperties[] = "{$mappedType} {$prop->getName()} = " . (string)$defaultValue . ";";
                }
            } else {
                $arrayDartProperties[] = "{$mappedType} {$prop->getName()};";
            }
        }

        $dart[$class] = ['dart' => $arrayDartProperties, 'json' => $arrayPropertyNames, 'types' => $arrayTypes];
    }

    private function generateDartClass($classe, $props, $phpClassNames)
    {
        $fromJson = [];
        $toJson = [];
        foreach ($props['json'] as $jsonProps) {
            $type = preg_replace('/(List\<)([A-z]{1,})(\>)/', '$2', $props['types'][$jsonProps]);

            $typeIsList = strstr($props['types'][$jsonProps], "List<") !== false;

            if ($typeIsList && in_array($type, $phpClassNames)) {
                //(json['userss'] as List)?.map((i) => Users.fromJson(i))?.toList();
                $fromJson[] = "{$jsonProps} = (json['$jsonProps'] as List)?.map((i) => {$type}.fromJson(i))?.toList();";
            } else if ($typeIsList && !in_array($type, $phpClassNames)) {
                //(json['userss'] as List)?.map((i) => Users.fromJson(i))?.toList();
                $fromJson[] = "{$jsonProps} = (json['$jsonProps'] as List)?.map((i) => (i as {$type}))?.toList();";
            } else if (in_array($type, $phpClassNames)) {
                $fromJson[] = "{$jsonProps} = {$type}.fromJson(json['{$jsonProps}']);";
            } else {
                if($type == 'DateTime') {
                    $fromJson[] = "{$jsonProps} = DateTime.tryParse(json['{$jsonProps}'] ?? '') ?? {$jsonProps};";
                } else {
                    $fromJson[] = "{$jsonProps} = json['{$jsonProps}'] ?? {$jsonProps};";
                }
            }

            if ($type == 'DateTime') {
                $toJson[] = "obj['{$jsonProps}'] = {$jsonProps}.toString();";
            } else {
                $toJson[] = "obj['{$jsonProps}'] = {$jsonProps};";
            }
        }

        $file = "
class {$classe} {
  " . implode("\n  ", $props['dart']) . "
  {$classe}();
  String jsonEncode() => json.encode(this).replaceAll('''\"null\"''', \"null\");
  factory {$classe}.jsonDecode(String jsonString) =>
      {$classe}.fromJson(json.decode(jsonString));
  factory {$classe}.fromJson(Map<String, dynamic> jsonMap) {
    if(jsonMap == null) {
      return null;
    }
    {$classe} obj = new {$classe}();
    obj.fromMappedJson(jsonMap);
    return obj;
  }
  void fromMappedJson(Map<String, dynamic> json) {
    " . implode("\n    ", $fromJson) . "
  }
  Map<String, dynamic> toJson() {
    var obj = new Map<String, dynamic>();
    " . implode("\n    ", $toJson) . "
    return obj;
  }
}
";
        return $file;
    }
}
