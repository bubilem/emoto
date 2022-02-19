<?php

/**
 * Application class loader
 */
class Loader
{

    /**
     * Main load method - makes require class file
     *
     * @param string $className
     * @return void
     */
    public static function loadClass(string $className)
    {
        $path = self::detectClassTypeDir($className) . '/' . $className . '.php';
        if (file_exists($path)) {
            require_once $path;
        } else {
            throw new Exception("Class $className not found!");
        }
    }

    /**
     * Specifies by class name its directory
     *
     * @param string $className
     * @return string
     */
    private static function detectClassTypeDir(string $className): string
    {
        foreach ([
            'Controller' => APP_DIR . 'controllers',
            'Model' => APP_DIR . 'models',
            'View' => APP_DIR . 'views'
        ] as $classTypeName => $classTypeDirectory) {
            if (preg_match('~.*' . $classTypeName . '$~', $className)) {
                return $classTypeDirectory;
            }
        }
        return APP_DIR . 'utils';
    }
}
