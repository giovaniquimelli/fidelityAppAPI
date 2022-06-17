<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FidelityVueRouterCommand extends Command
{
    protected static $defaultName = 'fidelity:vue:router';

    protected function configure(): void
    {
        $this
            ->setDescription('Generate typescript entity class')
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $_SERVER['VUE_VIEWS_PATH'] = dir(__DIR__.'/../../../admin/src/views/')->path;
        $_SERVER['VUE_ROUTER_PATH'] = dir(__DIR__.'/../../../admin/src/router/')->path;
        $meta = ['requiresAuth' => true];
        $removePath = $_SERVER['VUE_VIEWS_PATH']; //"ts/src/";
        $removeExt = ".vue";

        $routeTemplate = <<<TEXT
  {
    path: '%path%',
    name: '%name%',
    meta: %meta%,
    component: %component%
  }
TEXT;
        $fileTemplate = <<<TEXT
import { RouteConfig } from 'vue-router'

const viewRouter: RouteConfig[] = [
//#
]

export default viewRouter

TEXT;
        // $arg1 = $input->getArgument('arg1');

        // $io->success($_SERVER['VUE_VIEWS_PATH']);
        $allFiles = [];
        $this->getFiles($_SERVER['VUE_VIEWS_PATH'], $allFiles);

        $allRoutes = [];
        foreach ($allFiles as $file) {
            $firstLine = fgets(fopen($file, 'r'));
            $fileComponent = str_replace($removePath, "", str_replace($removeExt, "", $file));

            if ($firstLine === "<!--ignore-->\n") {
                continue;
            }
            $routePath = str_replace(['.', '_'], ['/', ':'], $fileComponent);

            if (!strstr($firstLine, "<!--")) {
                $this->buildRouteFromFile($file, $fileComponent, $meta, $allRoutes);
            } else {
                $json = str_replace("<!--", "", str_replace("-->", "", $firstLine));
                $this->buildRouteFromJson($file, $fileComponent, $json, $meta, $allRoutes);
            }
        }

        $allRoutesJson = [];
        foreach ($allRoutes as $route) {
            $rota = str_replace(
                ['%path%', '%name%', '%meta%', '%component%'],
                [
                    $route['path'],
                    $route['name'],
                    $this->replaceQuotes(json_encode($route['meta'], JSON_NUMERIC_CHECK)),
                    $route['component']
                ],
                $routeTemplate
            );
            $allRoutesJson[] = $rota;
        }

        $file = str_replace("//#", implode(",\n", $allRoutesJson), $fileTemplate);
        // print_r($file);
        $exist = file_get_contents($_SERVER['VUE_ROUTER_PATH'].'view-router.ts');
        if($exist != $file) {
            file_put_contents($_SERVER['VUE_ROUTER_PATH'] . 'view-router.ts', $file);
            $io->success('Arquivo atualizado com sucesso');
        } else {
            $io->warning('Aquivo: ' . $_SERVER['VUE_ROUTER_PATH'].'view-router.ts is identical');
        }

        return 0;
    }

    private function getFiles($dir, &$files)
    {
        $ffs = scandir($dir);
        foreach ($ffs as $ff) {
            if ($ff !== '.' && $ff !== '..') {
                if (is_dir($dir . '/' . $ff)) {
                    $this->getFiles($dir . '/' . $ff, $files);
                } else {
                    if (!strpos($ff, '.inc')) {
                        $files[] = $dir . '/' . $ff;
                    }
                }
            }
        }

        return $files;
    }

    private function buildRouteFromJson($file, $fileComponent, $json, $meta, &$allRoutes)
    {
        $assoc = json_decode($json, true);
        if (isset($assoc["meta"])) {
            $assoc["meta"] = array_merge($assoc["meta"], $meta);
        }
        $assoc['component'] = "() => import('../views{$fileComponent}.vue')";
        $allRoutes[] = $assoc;
    }

    private function buildRouteFromFile($file, $fileComponent, $meta, &$allRoutes): void
    {

        $route = [];
        $path = str_replace(['.', '_'], ['/', ':'], strtolower($fileComponent));
        // $path = str_replace("../views", "", $path);
        $path = preg_replace('/\/index$/', '/', $path);

        //$name = str_replace("/", "-", $fileComponent);
        // $name = str_replace("..-", "", $name);
        // $names = explode("/", str_replace("_", "", strtolower($fileComponent)));
        $name = str_replace(['/'],['_'], ltrim($path, '/'));

        // $name = preg_replace('/^-/', '', implode('-', $names));
        $path = str_replace(':guid', ':guid([A-Fa-f0-9]{8}-[A-Fa-f0-9]{4}-[A-Fa-f0-9]{4}-[A-Fa-f0-9]{4}-[A-Fa-f0-9]{12})', $path);
        $route['path'] = $path;
        $route['name'] = $name;
        $route['component'] = "() => import('../views{$fileComponent}.vue')";
        $route['meta'] = $meta;
        $allRoutes[] = $route;
    }

    private function replaceQuotes(string $encodedJson)
    {
        $json = preg_replace('/(\")([a-zA-Z]{1,})(\")(\:)/s', ' $2$4 $5', $encodedJson);
        $json = str_replace("\"", "'", $json);
        // $json = preg_replace('/^\{/s', '$0 ', $json, 1);
        $json = preg_replace('/\}$/s', ' $0', $json, 1);
        //$json = preg_replace('/\,/s', ' $0', $json, 1);

        return $json;
    }
}
