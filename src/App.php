<?php
/**
 * The main app to kick everything off.
 *
 * @author  Jeremy Ward <jeremy@jmichaelward.com>
 * @package JMW\PHPractice
 * @since   2018-12-02
 */

namespace JMW\PHPractice;

use JMW\PHPractice\Service\DB;
use JMW\PHPractice\Service\Environment;
use JMW\PHPractice\Service\Router;
use Pimple\Container;

/**
 * Class App
 *
 * @author  Jeremy Ward <jeremy@jmichaelward.com>
 * @package JMW\PHPractice
 * @since   2018-12-02
 */
class App
{
    /**
     * @var Container
     * @since 2018-12-02
     */
    private $container;

    /**
     * @var array
     * @since 2018-12-02
     */
    private $services = [
        Environment::class,
        DB::class,
        Router::class,
    ];

    /**
     * App constructor.
     * @param Container $container
     * @author Jeremy Ward <jeremy@jmichaelward.com>
     * @since 2018-12-02
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @author Jeremy Ward <jeremy@jmichaelward.com>
     * @since  2018-12-02
     * @return void
     */
    public function run()
    {
        $this->registerServices();
        $this->runServices();
    }

    /**
     * @author Jeremy Ward <jeremy@jmichaelward.com>
     * @since 2018-12-02
     * @return void
     */
    private function registerServices()
    {
        foreach ($this->services as $service_class) {
            $this->container[$service_class] = function ($container) use ($service_class) {
                return new $service_class($container);
            };
        }
    }

    /**
     * @author Jeremy Ward <jeremy@jmichaelward.com>
     * @since 2018-12-02
     * @return void
     */
    private function runServices()
    {
        foreach ($this->services as $service) {
            $this->container[$service]->run();
        }
    }
}
