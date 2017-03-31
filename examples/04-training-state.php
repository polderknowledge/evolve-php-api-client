<?php
/**
 * Evolve / php-api-client (https://evolve123.com)
 *
 * @link https://gitlab.polderknowledge.nl/evolve/php-api-client for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Evolve (https://evolve123.com)
 * @license https://gitlab.polderknowledge.nl/evolve/php-api-client/blob/master/LICENSE.md MIT
 */

require __DIR__ . '/../vendor/autoload.php';

$client = \Evolve123\ApiClient\ClientFactory::create([
    'base_uri' => 'http://apievolve123com_webserver_1.docker/',
    'oauth' => [
        'access_token' => 'd46ed8213579979b915b9b5916d5291fb405f484',
        'token_type' => 'Bearer',
    ],
]);

// The id that you received after starting a training.
$activeTrainingId = 'd90d7f40-4b19-45bb-a2e3-50e047479c21';

// Retrieve the current state:
$state = $client->getTrainingSessionService()->getCurrentState($activeTrainingId);

var_dump($state);

// Submit to the current state
try {
    $newState = $client->getTrainingSessionService()->submitState($trainingId, $state->getId(), [
    	new \Evolve123\ApiClient\State\Answer('12345'),
    	new \Evolve123\ApiClient\State\Answer('67890', 'Some value'),
    ]);

    var_dump($newState);
} catch (\Evolve123\ApiClient\Exception\InvalidSubmission $e) {
    // Handle exception, don't forget the previous exceptions.
    throw $e;
}
