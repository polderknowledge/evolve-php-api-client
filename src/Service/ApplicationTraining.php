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
use Evolve123\ApiClient\Response\Application as ApplicationResponse;
use Evolve123\ApiClient\Response\Training as TrainingResponse;
use Zend\Paginator\Paginator;

final class ApplicationTraining extends AbstractService
{
    private $application;

    public function __construct(ApplicationResponse $application, AdapterInterface $httpAdapter, array $options)
    {
        parent::__construct($httpAdapter, $options);

        $this->application = $application;
    }

    /**
     * @return Paginator
     */
    public function fetchAll()
    {
        $url = '/application/' . $this->application->getId() . '/training';

        return $this->requestPaginator($url, 'application_training', TrainingResponse::class);
    }

    /**
     * @return Application|null
     */
    public function fetch($id)
    {
        $url = '/application/' . $this->application->getId() . '/training/' . $id;

        return $this->requestItem($url, TrainingResponse::class);
    }
}
