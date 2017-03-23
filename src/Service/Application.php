<?php
/**
 * Evolve / php-api-client (https://evolve123.com)
 *
 * @link https://gitlab.polderknowledge.nl/evolve/php-api-client for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Evolve (https://evolve123.com)
 * @license https://gitlab.polderknowledge.nl/evolve/php-api-client/blob/master/LICENSE.md MIT
 */

namespace Evolve123\ApiClient\Service;

use Evolve123\ApiClient\Response\Application as ApplicationResponse;
use Zend\Paginator\Paginator;

final class Application extends AbstractService
{
    /**
     * @return Paginator
     */
    public function fetchAll()
    {
        return $this->requestPaginator('/application', 'application', ApplicationResponse::class);
    }

    /**
     * @return Application|null
     */
    public function fetch($id)
    {
        return $this->requestItem('/application/' . $id, ApplicationResponse::class);
    }
}
