<?php

if (is_file($autoLoader = __DIR__ . '/../../../vendor/autoload.php')) {
    require_once $autoLoader;
} else {
    spl_autoload_register(function (string $className) {
        if (strncmp('openWebX\\Rule\\', $className, 13) === 0) {
            if (is_file($file = __DIR__ . '/' . str_replace('\\', '/', substr($className, 13)) . '.php')) {
                require $file;
            }
        }
    });
}
