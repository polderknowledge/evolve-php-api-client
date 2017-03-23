<?php
/**
 * Evolve / php-api-client (https://evolve123.com)
 *
 * @link https://gitlab.polderknowledge.nl/evolve/php-api-client for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Evolve (https://evolve123.com)
 * @license https://gitlab.polderknowledge.nl/evolve/php-api-client/blob/master/LICENSE.md MIT
 */

namespace Evolve123\ApiClient\Service;

use Evolve123\ApiClient\HttpAdapter\AdapterInterface;
use Evolve123\ApiClient\HttpAdapter\Exception\BadRequest;
use Psr\Http\Message\ResponseInterface;
use Zend\Paginator\Adapter\Callback;
use Zend\Paginator\Paginator;

abstract class AbstractService
{
    /**
     * @var AdapterInterface
     */
    protected $httpAdapter;

    /**
     * @var array
     */
    protected $options;

    /**
     * Initializes a new instance of this class.
     *
     * @param AdapterInterface $httpAdapter
     * @param array $options
     */
    public function __construct(AdapterInterface $httpAdapter, array $options)
    {
        $this->httpAdapter = $httpAdapter;
        $this->options = $options;
    }

    protected function requestItem($url, $class)
    {
        try {
            /** @var ResponseInterface $response */
            $response = $this->httpAdapter->request('GET', $url);
        } catch (BadRequest $exception) {
            if ($exception->getResponse()->getStatusCode() === 404) {
                return null;
            }
        }

        $json = \GuzzleHttp\json_decode($response->getBody(), true);

        return $class::fromJson($json);
    }

    protected function requestPaginator($url, $collection, $class)
    {
        $countCache = null;
        $countCallback = function () use (&$countCache, $url) {
            if ($countCache === null) {
                /** @var ResponseInterface $response */
                $response = $this->httpAdapter->request('GET', $url);

                $json = \GuzzleHttp\json_decode($response->getBody(), true);

                $countCache = $json['total_items'];
            }

            return $countCache;
        };

        $itemCallback = function ($offset, $itemCountPerPage) use (&$countCache, $collection, $class, $url) {
            $page = ceil($offset / $itemCountPerPage) + 1;
            $url .= '?page_size=' . $itemCountPerPage . '&page=' . $page;

            /** @var ResponseInterface $response */
            $response = $this->httpAdapter->request('GET', $url);

            $json = \GuzzleHttp\json_decode($response->getBody(), true);

            $result = [];

            foreach ($json['_embedded'][$collection] as $item) {
                $result[] = $class::fromJson($item);
            }

            return $result;
        };

        return new Paginator(new Callback($itemCallback, $countCallback));
    }
}
