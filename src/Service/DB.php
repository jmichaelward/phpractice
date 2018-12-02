<?php
/**
 * Database Service.
 *
 * @author  Jeremy Ward <jeremy@jmichaelward.com>
 * @package JMW\PHPractice
 * @since   2018-12-02
 */

namespace JMW\PHPractice\Service;

use JMW\PHPractice\ServiceProvider;
use Pimple\Container;

/**
 * Class DB
 *
 * @author  Jeremy Ward <jeremy@jmichaelward.com>
 * @package JMW\PHPractice
 * @since   2018-12-02
 */
class DB extends ServiceProvider
{
    /**
     * Database name.
     *
     * @var string
     * @since 2018-12-02
     */
    private $name;

    /**
     * Database user.
     *
     * @var string
     * @since 2018-12-02
     */
    private $user;

    /**
     * Database password.
     *
     * @var string
     * @since 2018-12-02
     */
    private $pass;

    /**
     * Database host.
     *
     * @var string
     * @since 2018-12-02
     */
    private $host;

    /**
     * @var
     * @since 2018-12-02
     */
    private $dsn;

    /**
     * @var \PDO
     * @since 2018-12-02
     */
    private $connection;

    /**
     * DB constructor.
     * @param Container $container
     * @author Jeremy Ward <jeremy@jmichaelward.com>
     * @since 2018-12-02
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->name = getenv('DBNAME');
        $this->user = getenv('DBUSER');
        $this->pass = getenv('DBPASS');
        $this->host = getenv('DBHOST');
    }

    /**
     * @author Jeremy Ward <jeremy@jmichaelward.com>
     * @since 2018-12-02
     * @return void
     */
    public function run()
    {
        $this->setDsn();
        $this->connect();
    }

    /**
     * @author Jeremy Ward <jeremy@jmichaelward.com>
     * @since 2018-12-02
     * @return void
     */
    private function setDsn()
    {
        $this->dsn = "mysql:dbname={$this->name};host={$this->host};";
    }

    /**
     * @author Jeremy Ward <jeremy@jmichaelward.com>
     * @since 2018-12-02
     * @return void
     */
    private function connect()
    {
        $this->connection = new \PDO($this->dsn, $this->user, $this->pass);
    }

    /**
     * @param string $query_string
     * @author Jeremy Ward <jeremy@jmichaelward.com>
     * @since 2018-12-02
     * @return array
     */
    public function query(string $query_string)
    {
        $query = $this->connection->prepare($query_string);
        $query->execute();

        return $query->fetchAll();
    }
}
