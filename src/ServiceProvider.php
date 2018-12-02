<?php
/**
 *
 *
 * @author Jeremy Ward <jeremy@jmichaelward.com>
 * @package JMW\PHPractice
 * @since 2018-12-02
 */

namespace JMW\PHPractice;

use Pimple\Container;

/**
 * Class ServiceProvider
 *
 * @author Jeremy Ward <jeremy@jmichaelward.com>
 * @package JMW\PHPractice
 * @since 2018-12-02
 */
abstract class ServiceProvider
{
    /**
     * @var Container
     * @since 2018-12-02
     */
    protected $container;

    /**
     * ServiceProvider constructor.
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
     * @since 2018-12-02
     * @return void
     */
    public function run()
    {
        // @TODO Probably make this abstract.
    }
}
