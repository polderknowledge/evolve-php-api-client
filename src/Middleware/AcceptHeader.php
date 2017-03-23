<?php
/**
 * Evolve / php-api-client (https://evolve123.com)
 *
 * @link https://gitlab.polderknowledge.nl/evolve/php-api-client for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Evolve (https://evolve123.com)
 * @license https://gitlab.polderknowledge.nl/evolve/php-api-client/blob/master/LICENSE.md MIT
 */

namespace Evolve123\ApiClient\Middleware;

use Psr\Http\Message\RequestInterface;

final class AcceptHeader
{
    public function __invoke(callable $handler)
    {
        return function ($request, array $options) use ($handler) {
            $request = $this->onBefore($request);

            return $handler($request, $options);
        };
    }

    private function onBefore(RequestInterface $request)
    {
        return $request->withHeader('Accept', 'application/vnd.evolve-training.v1+json');
    }
}
