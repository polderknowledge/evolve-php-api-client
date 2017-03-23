<?php
/**
 * Evolve / php-api-client (https://evolve123.com)
 *
 * @link https://gitlab.polderknowledge.nl/evolve/php-api-client for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Evolve (https://evolve123.com)
 * @license https://gitlab.polderknowledge.nl/evolve/php-api-client/blob/master/LICENSE.md MIT
 */

namespace Evolve123\ApiClient\Service;

use Evolve123\ApiClient\Exception\InvalidSubmission;
use Evolve123\ApiClient\HttpAdapter\Exception\BadRequest;
use Evolve123\ApiClient\Response\ActiveTrainingState;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

final class TrainingSession extends AbstractService
{
    /**
     * @param string $trainingId
     * @param string $userReference
     * @return string
     */
    public function startTraining($trainingId, $userReference)
    {
        $response = $this->httpAdapter->request('POST', '/training/active', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => \GuzzleHttp\json_encode([
                'training_id' => $trainingId,
                'user_id' => $userReference,
            ]),
        ]);

        $json = json_decode($response->getBody(), true);

        return $json['id'];
    }

    /**
     * @param string $trainingId
     * @return ActiveTrainingState
     */
    public function getCurrentState($trainingId)
    {
        $url = sprintf('/training/active/%s/state', $trainingId);

        $response = $this->httpAdapter->request('GET', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        $json = json_decode($response->getBody(), true);

        return ActiveTrainingState::fromJson($json);
    }

    /**
     * @param string $trainingId
     * @param string $stateId
     * @return ActiveTrainingState
     */
    public function submitState($trainingId, $stateId, array $answers = [])
    {
        $url = sprintf('/training/active/%s/submit', $trainingId);

        $data = [
            'id' => $stateId,
            'answer' => $answers,
        ];

        try {
            $response = $this->httpAdapter->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => \GuzzleHttp\json_encode($data),
            ]);
        } catch (BadRequest $e) {
            return $this->handleStateSubmissionError($e);
        }

        $json = json_decode($response->getBody(), true);

        return ActiveTrainingState::fromJson($json);
    }

    private function handleStateSubmissionError(BadRequest $exception)
    {
        /** @var ResponseInterface $response */
        $response = $exception->getResponse();

        if ($response->getStatusCode() === 422) {
            throw new InvalidSubmission('Invalid state submitted', 422, $exception);
        }

        return null;
    }
}
