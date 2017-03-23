<?php
/**
 * Evolve / php-api-client (https://evolve123.com)
 *
 * @link https://gitlab.polderknowledge.nl/evolve/php-api-client for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Evolve (https://evolve123.com)
 * @license https://gitlab.polderknowledge.nl/evolve/php-api-client/blob/master/LICENSE.md MIT
 */

namespace Evolve123\ApiClient\HttpAdapter;

use Evolve123\ApiClient\HttpAdapter\Exception\BadRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

final class Guzzle implements AdapterInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Initializes a new instance of this class.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws BadRequest When the request fails.
     */
    public function request($method, $url, array $options = [])
    {
        try {
            $guzzleOptions = $this->buildOptions($options);

            switch ($method) {
                case 'GET':
                    $response = $this->client->get($url, $guzzleOptions);
                    break;

                case 'POST':
                    $response = $this->client->post($url, $guzzleOptions);
                    break;

                default:
                    throw new \InvalidArgumentException('Invalid HTTP method provided: ' . $method);
            }
        } catch (RequestException $e) {
            throw $this->createBadRequestException($e);
        }

        return $response;
    }

    private function buildOptions($options)
    {
        $result = [];

        if (array_key_exists('headers', $options)) {
            $result['headers'] = $options['headers'];
        }

        if (array_key_exists('body', $options)) {
            $result['body'] = $options['body'];
        }

        return $result;
    }

    private function createBadRequestException(RequestException $e)
    {
        return new BadRequest($e->getRequest(), $e->getResponse(), $e);
    }
}
