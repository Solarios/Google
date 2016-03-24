<?php

namespace Solarios\Google\Authenticators;

use InvalidArgumentException;

class ApplicationAuthenticator extends AbstractAuthenticator implements AuthenticatorInterface
{
    /**
     * Authenticate the client, and return it.
     *
     * @param string[]  $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Google_Client
     */
    public function authenticate(array $config)
    {
        if (!$this->client) {
            throw new InvalidArgumentException('The client instance was not given to the application authenticator.');
        }

        if (!array_key_exists('email', $config) || !array_key_exists('key', $config)) {
            throw new InvalidArgumentException('The application authenticator requires aen email and key.');
        }

        $credentials = new \Google_Auth_AssertionCredentials(
            $config['email'],
            $config['scopes'],
            file_get_contents($config['key']),
            'notasecret',
            'http://oauth.net/grant_type/jwt/1.0/bearer',
            $config['account']
        );

        $this->client->setAssertionCredentials($credentials);

        return $this->client;
    }
}
