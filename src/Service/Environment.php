<?php
/**
 *
 *
 * @author Jeremy Ward <jeremy@jmichaelward.com>
 * @package JMW\PHPractice\Service
 * @since 2018-12-02
 */

namespace JMW\PHPractice\Service;

use JMW\PHPractice\ServiceProvider;
use Pimple\Container;
use Symfony\Component\Dotenv\Dotenv;

/**
 * Class Environment
 *
 * @author Jeremy Ward <jeremy@jmichaelward.com>
 * @package JMW\PHPractice\Service
 * @since 2018-12-02
 */
class Environment extends ServiceProvider
{
    /**
     * @var Dotenv
     * @since 2018-12-02
     */
    private $settings;

    /**
     * Environment constructor.
     * @param Container $container
     * @author Jeremy Ward <jeremy@jmichaelward.com>
     * @since 2018-12-02
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->settings = new Dotenv();
    }

    /**
     * @author Jeremy Ward <jeremy@jmichaelward.com>
     * @since 2018-12-02
     * @return void
     */
    public function run()
    {
        $this->settings->loadEnv($this->container['dirpath'] . '.env');
    }
}
