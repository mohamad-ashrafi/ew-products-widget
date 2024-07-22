<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit5e5c95ca8221189cfe98771e8cf56506
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit5e5c95ca8221189cfe98771e8cf56506', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit5e5c95ca8221189cfe98771e8cf56506', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit5e5c95ca8221189cfe98771e8cf56506::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}