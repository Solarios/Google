<?php

namespace Solarios\Google\Authenticators;

abstract class AbstractAuthenticator
{
    /**
     * The client to perform the authentication on.
     *
     * @var \Google_Client|null
     */
    protected $client;

    /**
     * Set the client to perform the authentication on.
     *
     * @param \Google_Client $client
     *
     * @return \Solarios\Google\Authenticators\AuthenticatorInterface
     */
    public function with(\Google_Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
