<?php

namespace Solarios\Google;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * @method void clearHeaders()
 * @method void setHeaders(array $headers)
 * @method mixed getOption(string $name)
 * @method void setOption(string $name, mixed $value)
 * @method array getSupportedApiVersions()
 */
class GoogleManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Solarios\Google\GoogleFactory
     */
    protected $factory;

    /**
     * Create a new google manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository  $config
     * @param \Solarios\Google\GoogleFactory  $factory
     */
    public function __construct(Repository $config, GoogleFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array  $config
     *
     * @return \Google_Client
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'google';
    }

    /**
     * Get the factory instance.
     *
     * @return \Solarios\Google\GoogleFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * Get a connection instance.
     *
     * @param string $name
     *
     * @return object
     */
    public function connection($name = null)
    {
        $name = $name ?: $this->getDefaultConnection();

        if (!isset($this->connections[$name])) {
            $this->connections[$name] = $this->makeConnection($name);
        }

        return $this->connections[$name];
    }

    /**
     * Dynamically pass methods to the default connection.
     *
     * @param string $method
     * @param array $parameters
     *
     * @return mixed
     * @throws \Exception
     */
    public function __call($method, $parameters)
    {
        $service = 'Google_Service_' . ucfirst($method);

        if (class_exists($service)) {
            $class = new \ReflectionClass($service);

            return $class->newInstance($this->connection());
        }

        throw new \Exception($service);
    }
}
