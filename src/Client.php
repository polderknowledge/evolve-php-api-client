<?php
/**
 * Evolve / php-api-client (https://evolve123.com)
 *
 * @link https://gitlab.polderknowledge.nl/evolve/php-api-client for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Evolve (https://evolve123.com)
 * @license https://gitlab.polderknowledge.nl/evolve/php-api-client/blob/master/LICENSE.md MIT
 */

namespace Evolve123\ApiClient;

use Evolve123\ApiClient\HttpAdapter\AdapterInterface;
use Evolve123\ApiClient\Response\Application as ApplicationResponse;
use Evolve123\ApiClient\Service\Application;
use Evolve123\ApiClient\Service\ApplicationTraining;
use Evolve123\ApiClient\Service\TrainingSession;

final class Client
{
    /**
     * @var AdapterInterface
     */
    private $httpAdapter;

    /**
     * @var array
     */
    private $options;

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

    /**
     * @return Application
     */
    public function getApplicationService()
    {
        return new Application($this->httpAdapter, $this->options);
    }

    /**
     * @param ApplicationResponse $application The application to get the trainings for.
     * @return ApplicationTraining
     */
    public function getApplicationTrainingService(ApplicationResponse $application)
    {
        return new ApplicationTraining($application, $this->httpAdapter, $this->options);
    }

    public function getTrainingSessionService()
    {
        return new TrainingSession($this->httpAdapter, $this->options);
    }
}
