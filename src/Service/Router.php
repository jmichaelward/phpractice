<?php
/**
 * Handle HTTP requests and load the correct routes.
 *
 * @author  Jeremy Ward <jeremy.ward@webdevstudios.com>
 * @package JMW\PHPractice\Service
 * @since   2019-01-01
 */

namespace JMW\PHPractice\Service;

use JMW\PHPractice\Controller\HomeController;
use JMW\PHPractice\Controller\UserController;
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
     * The path to our template files.
     *
     * @var
     * @since 2019-01-01
     */
    private $viewPath;

    /**
     * @var array
     * @since 2019-01-01
     */
    private $controllers = [
        'user' => UserController::class,
        'home' => HomeController::class,
    ];

    /**
     * Router constructor.
     * @param Container $container
     * @author Jeremy Ward <jeremy.ward@webdevstudios.com>
     * @since 2019-01-01
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->viewPath = $this->container['dirpath'] . '/views/';
    }

    /**
     * Run the routing service.
     *
     * @author Jeremy Ward <jeremy.ward@webdevstudios.com>
     * @since 2019-01-01
     * @return void
     */
    public function run()
    {
        $this->load($this->parseRoute());
    }

    /**
     * Parse the route from the request.
     *
     * @TODO This corresponds 1:1 with a view file. In reality, a controller should and will eventually act as an intermediary.
     *
     * @author Jeremy Ward <jeremy.ward@webdevstudios.com>
     * @since 2019-01-01
     * @return string
     */
    private function parseRoute()
    {
        $requestUri = array_values(array_filter(explode('/', $_SERVER['PHP_SELF'])));

        if (1 <= count($requestUri)) {
            return $requestUri[0];
        }

        return 'home';
    }

    /**
     * Load a view on page request.
     *
     * @param string $path
     * @author Jeremy Ward <jeremy.ward@webdevstudios.com>
     * @since 2019-01-01
     * @return void
     */
    private function load(string $path)
    {
        $view = $this->viewPath . "{$path}.php";

        if (array_key_exists($path, $this->controllers)) {
            $controller = new $this->controllers[$path]($view);
            require_once $view;
            return;
        }

        $this->loadNotFound();
    }

    /**
     * Load a 404 template if we can't find a view.
     *
     * @author Jeremy Ward <jeremy.ward@webdevstudios.com>
     * @since 2019-01-01
     * @return void
     */
    private function loadNotFound()
    {
        require_once $this->viewPath . '404.php';
    }
}
