<?php
/**
 * Just a little application to play around with PHP and MySQL.
 *
 * @author Jeremy Ward <jeremy@jmichaelward.com>
 * @since  2018-12-02
 */

namespace JMW\PHPractice;

use Pimple\Container;

$autoload = __DIR__ . '/vendor/autoload.php';

if (!is_readable($autoload)) {
    throw new \Error('No autoloader found.');
}

require_once $autoload;

$container = new Container();

$container['dirpath']  = __DIR__ . '/';
$container[App::class] = function ($container) {
    return new App($container);
};

$container[App::class]->run();
