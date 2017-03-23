<?php
/**
 * Evolve / php-api-client (https://evolve123.com)
 *
 * @link https://gitlab.polderknowledge.nl/evolve/php-api-client for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Evolve (https://evolve123.com)
 * @license https://gitlab.polderknowledge.nl/evolve/php-api-client/blob/master/LICENSE.md MIT
 */

namespace Evolve123\ApiClient;

use Evolve123\ApiClient\HttpAdapter\Guzzle;
use Evolve123\ApiClient\Middleware\AcceptHeader;
use Evolve123\ApiClient\Middleware\OAuth2;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\HandlerStack;
use InvalidArgumentException;

final class ClientFactory
{
    public static function create(array $options)
    {
        $client = static::createHttpClient($options);

        return new Client(new Guzzle($client), $options);
    }

    private static function createHttpClient(array $options)
    {
        if (!array_key_exists('base_uri', $options)) {
            throw new InvalidArgumentException('Missing the "base_uri" configuration option.');
        }

        $stack = HandlerStack::create();
        $stack->push(static::createOAuthMiddleware($options));
        $stack->push(new AcceptHeader());

        return new GuzzleHttpClient([
            'handler' => $stack,
            'base_uri' => $options['base_uri'],
        ]);
    }

    private static function createOAuthMiddleware(array $options)
    {
        if (!array_key_exists('oauth', $options)) {
            throw new InvalidArgumentException('Missing the "oauth" configuration option.');
        }

        if (!array_key_exists('access_token', $options['oauth'])) {
            throw new InvalidArgumentException('Missing the "access_token" configuration option for oauth.');
        }

        if (array_key_exists('token_type', $options['oauth'])) {
            $tokenType = $options['oauth']['token_type'];
        } else {
            $tokenType = 'Bearer';
        }

        return new OAuth2($options['oauth']['access_token'], $tokenType);
    }
}
