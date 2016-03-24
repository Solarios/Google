<?php

namespace Solarios\Google\Authenticators;

interface AuthenticatorInterface
{
    /**
     * Set the client to perform the authentication on.
     *
     * @param \Google_Client  $client
     *
     * @return \Solarios\Google\Authenticators\AuthenticatorInterface
     */
    public function with(\Google_Client $client);

    /**
     * Authenticate the client, and return it.
     *
     * @param string[]  $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Google_Client
     */
    public function authenticate(array $config);
}
