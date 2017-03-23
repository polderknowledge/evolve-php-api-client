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

/** @var \Zend\Paginator\Paginator $paginator */
$applications = $client->getApplicationService()->fetchAll();
$applications->setCurrentPageNumber(1);
$applications->setItemCountPerPage(25);

/** @var \Evolve123\ApiClient\Response\Application $application */
foreach ($applications as $application) {
    var_dump($application);
}
