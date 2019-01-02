<?php
/**
 * Handle HTTP requests and load the correct routes.
 *
 * @author  Jeremy Ward <jeremy.ward@webdevstudios.com>
 * @package JMW\PHPractice\Service
 * @since   2019-01-01
 */

namespace JMW\PHPractice\Service;

use JMW\PHPractice\ServiceProvider;
use Pimple\Container;

/**
 * Class Router
 *
 * @author  Jeremy Ward <jeremy.ward@webdevstudios.com>
 * @package JMW\PHPractice\Service
 * @since   2019-01-01
 */
class Router extends ServiceProvider
{
    /**
     * @var
     * @since 2019-01-01
     */
    private $viewPath;

    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->viewPath = $this->container['dirpath'] . '/views/';
    }

    /**
     * @author Jeremy Ward <jeremy.ward@webdevstudios.com>
     * @since 2019-01-01
     * @return void
     */
    public function run()
    {
        $route = $this->parseRoute();

        $this->load($route);
    }

    /**
     * @author Jeremy Ward <jeremy.ward@webdevstudios.com>
     * @since 2019-01-01
     * @return
     */
    private function parseRoute()
    {
        $requestUri = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));

        if (1 <= count($requestUri)) {
            return $requestUri[0];
        }

        return 'home';
    }

    /**
     * @param string $file
     * @author Jeremy Ward <jeremy.ward@webdevstudios.com>
     * @since 2019-01-01
     * @return void
     */
    private function load(string $file)
    {
        $view = $this->viewPath . "{$file}.php";

        if (is_readable($view)) {
            require_once $view;
            return;
        }

        $this->loadNotFound();
    }

    /**
     * @author Jeremy Ward <jeremy.ward@webdevstudios.com>
     * @since 2019-01-01
     * @return void
     */
    private function loadNotFound()
    {
        require_once $this->viewPath . '404.php';
    }
}
