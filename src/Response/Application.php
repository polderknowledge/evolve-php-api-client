<?php
/**
 * Evolve / php-api-client (https://evolve123.com)
 *
 * @link https://gitlab.polderknowledge.nl/evolve/php-api-client for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Evolve (https://evolve123.com)
 * @license https://gitlab.polderknowledge.nl/evolve/php-api-client/blob/master/LICENSE.md MIT
 */

namespace Evolve123\ApiClient\Response;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;

final class Application
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var DateTimeInterface
     */
    private $createdOn;

    /**
     * Initializes a new instance of this class.
     */
    private function __construct()
    {
    }

    /**
     * Builds the response from the given data array.
     *
     * @param array $data The data used to build the response.
     * @return Application
     */
    public static function fromJson(array $data)
    {
        $result = new self();

        $result->id = $data['id'];
        $result->name = $data['name'];
        $result->createdOn = DateTimeImmutable::createFromFormat(DateTime::ISO8601, $data['created_on']);

        return $result;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }
}
