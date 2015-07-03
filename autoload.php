<?php
/**
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


/**
 * Если Вы не используете composer - просто подключите этот файл.
 * Мы, все же, рекомендуем использовать composer - https://getcomposer.org/
 */

if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    throw new Exception('The Rutube API Client requires PHP version 5.4 or higher.');
}

/**
 * По мотивам официального загрузчика PSR-4:
 * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class)
{
    // project-specific namespace prefix
    $prefix = 'Rutube\\';

    // base directory for the namespace prefix
    $base_dir = defined('RUTUBE_CLIENT_SRC_DIR') ? RUTUBE_CLIENT_SRC_DIR : __DIR__ . '/src/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});