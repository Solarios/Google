<?php

namespace Solarios\Google;

use Solarios\Google\Authenticators\AuthenticatorFactory;

class GoogleFactory
{
    /**
     * The authenticator factory instance.
     *
     * @var \Solarios\Google\Authenticators\AuthenticatorFactory
     */
    protected $auth;

    /**
     * The cache path.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new google factory instance.
     *
     * @param string  $path
     */
    public function __construct(AuthenticatorFactory $auth, $path)
    {
        $this->auth = $auth;
        $this->path = $path;
    }

    /**
     * Make a new google client.
     *
     * @param string[]  $config
     *
     * @return \Google_Client
     */
    public function make(array $config)
    {
        return $this->getClient($config);
    }

    /**
     * Get the main client.
     *
     * @param string[]  $config
     *
     * @return \Google_Client
     */
    protected function getClient(array $config)
    {
        return $this->auth->make(array_get($config, 'method'))->with(new \Google_Client)->authenticate($config);
    }
}
