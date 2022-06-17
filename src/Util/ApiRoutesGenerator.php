<?php

namespace App\Util;

use ArrayIterator;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Remove Class ApiRoutesGenerator
 * @package App\Util
 */
class ApiRoutesGenerator
{
    public static function generate(): void
    {
        $self = new ApiRoutesGenerator();

        /** @var ArrayIterator $arr */
        $routeNamesTemp = container('router')->getRouteCollection()->getIterator()->getArrayCopy();

        $routeNames = [];
        foreach ($routeNamesTemp as $key => $route) {
            if (strpos($key, '_profiler') !== false ||
                strpos($key, '_twig_error_test') !== false ||
                strpos($key, '_error') !== false ||
                strpos($key, '_wdt') !== false) {
                continue;
            }
            $routeNames[$key] = $route;
        }

        $fileContentJs = $self->generateJavascript($routeNames);
        $fileContentDart = $self->generateDart($routeNames);


        if (PHP_OS == 'WIN' || PHP_OS == 'WINNT') {
            file_put_contents($_SERVER['API_ROUTES_JS_PROJECT_PATH_WIN'], $fileContentJs);
        } else {
            $existFile = file_get_contents($_SERVER['API_ROUTES_JS_PROJECT_PATH_MAC']);
            if ($existFile != $fileContentJs) {
                file_put_contents($_SERVER['API_ROUTES_JS_PROJECT_PATH_MAC'], $fileContentJs);
            }
        }

        if (PHP_OS == 'WIN' || PHP_OS == 'WINNT') {
            file_put_contents($_SERVER['API_ROUTES_DART_PROJECT_PATH_WIN'], $fileContentDart);
        } else {
            file_put_contents($_SERVER['API_ROUTES_DART_PROJECT_PATH_MAC'], $fileContentDart);
        }
    }

    public function generateJavascript(array $finalArray): string
    {
        $routes = '';
        /** @var Route $route */
        foreach ($finalArray as $key => $route) {
            $routes .= "  /**\n";
            $routes .= "   * Route: {$route->getPath()}\n";
            $routes .= "   *\n";
            $routes .= "   * Controller: {$route->getDefaults()['_controller']} \n";
            $routes .= "   *\n";
            $routes .= '   * Methods: ' . implode(', ', $route->getMethods()) . "\n";
            $routes .= "   * @type {string}\n";
            $routes .= "   */\n";

            //$propertyName = str_replace("-", "", ltrim(implode('_', explode('/', $route->getPath())), '_'));
            $propertyName = str_replace(['/api/web/', '/', '-'], ['', '_', '$_'], rtrim($route->getPath(), '/'));
            $camelCase = lcfirst(implode('', array_map('ucfirst', explode('_', $key))));
            $name = str_replace(['/api/web/'],[''], rtrim($route->getPath(), '/'));
            $routes .= "  {$propertyName}: '{$name}',\n\n";
        }

        $file = str_replace('//#', rtrim(trim($routes), ','), $this->getJavascriptTemplate());
        return $file;
    }

    public function generateDart(array $finalArray): string
    {
        $routes = '';
        /** @var Route $route */
        foreach ($finalArray as $key => $route) {
            $routes .= "  /// Route: {$route->getPath()}\n";
            $routes .= "  /// \n";
            $routes .= '  /// Methods: ' . implode(', ', $route->getMethods()) . "\n";
            $camelCase = lcfirst(implode('', array_map('ucfirst', explode('_', $key))));
            $routes .= "  String {$camelCase} = \"{$key}\";\n\n";
        }

        $file = str_replace('//#', trim($routes), $this->getDartTemplate());
        return $file;
    }

    private function getJavascriptTemplate()
    {
        return <<<JS
const gatewayRoutes = {
  //#
};

export default gatewayRoutes;

JS;
    }

    private function getDartTemplate()
    {
        return <<<DART
class Router {
  //#
}

DART;
    }

    private function buildRoutesObject(array $routes): array
    {
        $returnArray = [];

        foreach ($routes as $route) {
            $returnArray[$route] = $route;
        }

        return $returnArray;
    }
}
