<?php

namespace App\Command;

use App\Util\Container\ContainerService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Routing\Route;

class FidelityGatewayTsRoutesCommand extends Command
{
    protected static $defaultName = 'fidelity:gateway:ts:routes';

    protected function configure()
    {
        $this
            ->setDescription('Create ts file containing all /api/web/* routes');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $file = $this->generateGatewayRoutes();
        $exist = file_get_contents($_SERVER['VUE_GATEWAY_SERVICE_PATH'] . 'gateway-routes.ts');
        //dd($file);

        $file2 = $this->generateGatewayUrlRoutes();
        $exist2 = file_get_contents($_SERVER['VUE_GATEWAY_SERVICE_PATH'] . 'routes.d.ts');

        $io->writeln($file2);
        if ($exist != $file) {
            file_put_contents($_SERVER['VUE_GATEWAY_SERVICE_PATH'] . 'gateway-routes.ts', $file);
        } else {
            $io->comment('File: ' . $_SERVER['VUE_GATEWAY_SERVICE_PATH'] . 'gateway-routes.ts is identical');
        }

        if ($exist2 != $file2) {
            file_put_contents($_SERVER['VUE_GATEWAY_SERVICE_PATH'] . 'routes.d.ts', $file2);
        } else {
            $io->comment('File: ' . $_SERVER['VUE_GATEWAY_SERVICE_PATH'] . 'routes.d.ts is identical');
        }

        $io->comment('File: ' . $_SERVER['VUE_GATEWAY_SERVICE_PATH'] . 'gateway-routes.ts');
        $io->success('Gateway route successfully generated');


        return 0;
    }

    private function generateRoutesDTs()
    {
        $routeNamesTemp = ContainerService::get('router')->getRouteCollection()->getIterator()->getArrayCopy();

        $allRoutes = [];
        /** @var Route $route */
        foreach ($routeNamesTemp as $key => $route) {
            if (strpos($key, '_profiler') !== false ||
                strpos($key, '_twig_error_test') !== false ||
                strpos($key, '_error') !== false ||
                strpos($key, '_wdt') !== false) {
                continue;
            }
            if (strpos($key, 'app_web_', 0) === 0) {
                // $routeNames[$key] = $route; //str_replace(['/api/web/','/','-'],['', '_', ''], rtrim($route->getPath(), '/'));
                $allRoutes[] = '\'' . str_replace('/api/web/', '', $route->getPath()) . '\'';
            }
        }
        $file = "export type GatewayUrlRoute = " . PHP_EOL;
        $joinRoutes = implode("\n  | ", $allRoutes);
        $file .= '  ' . $joinRoutes . ';';

        return $file;
    }

    private function generateGatewayRoutes()
    {
        $routeNamesTemp = ContainerService::get('router')->getRouteCollection()->getIterator()->getArrayCopy();

        //dd($routeNamesTemp);
        $allRoutes = [];
        /** @var Route $route */
        foreach ($routeNamesTemp as $key => $route) {
            if (strpos($key, '_profiler') !== false ||
                strpos($key, '_twig_error_test') !== false ||
                strpos($key, '_error') !== false ||
                strpos($key, '_wdt') !== false ||
                strpos($key, 'app_web_hotupdatejson') !== false ||
                strpos($key, 'app_web_hotupdatejs') !== false) {
                continue;
            }
            if (strpos($key, 'app_web_', 0) === 0) {
                // $routeNames[$key] = $route; //str_replace(['/api/web/','/','-'],['', '_', ''], rtrim($route->getPath(), '/'));
                $completePath = $route->getPath();
                $methods = implode(', ', $route->getMethods());
                $controller = $route->getDefaults()['_controller'];
                $parts = explode('/', rtrim($route->getPath(), '/'));
                $parts = array_map(function ($item) {
                    if (strpos($item, '-') !== false) {
                        return '$' . $item . '$';
                    }
                    return $item;
                }, $parts);

                $normalizedName = str_replace(['/api/web/', '/', '-'], ['', '_', '_'], implode('/', $parts));
                $name = str_replace(['/api/web/'], [''], rtrim($route->getPath(), '/'));
                $allRoutes[] = "  /**
   * Route: '{$completePath}'
   *
   * Methods: {$methods}
   *
   * Controller: {$controller}
   * @type {string}
   */
  '{$name}': '{$name}'";
                $route->getPath();
            }
        }

        $file = "const GatewayRoutes = {" . PHP_EOL;
        $joinRoutes = implode(",\n", $allRoutes);
        $file .= $joinRoutes . "\n}\n\nexport default GatewayRoutes\n";

        // print $file;
        return $file;
    }

    private function generateGatewayUrlRoutes()
    {
        $routeNamesTemp = ContainerService::get('router')->getRouteCollection()->getIterator()->getArrayCopy();

        $allRoutes = [];
        /** @var Route $route */
        foreach ($routeNamesTemp as $key => $route) {
            if (strpos($key, '_profiler') !== false ||
                strpos($key, '_twig_error_test') !== false ||
                strpos($key, '_error') !== false ||
                strpos($key, '_wdt') !== false) {
                continue;
            }
            if (strpos($key, 'app_web_', 0) === 0) {
                // $routeNames[$key] = $route; //str_replace(['/api/web/','/','-'],['', '_', ''], rtrim($route->getPath(), '/'));
                $completePath = $route->getPath();
                $allRoutes[] = "'" . str_replace('/api/web/', '', $completePath) . "'";
            }
        }

        $joinRoutes = implode("\n  | ", $allRoutes);
        return 'export type GatewayUrlRoute = string | ' . PHP_EOL . '  ' . $joinRoutes . ";\n";
    }
}
