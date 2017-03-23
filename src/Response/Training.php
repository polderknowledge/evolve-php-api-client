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

final class Training
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var DateTimeInterface
     */
    private $createdOn;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $shortDescription;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $referenceCode;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var DateTimeInterface|null
     */
    private $activeFrom;

    /**
     * @var DateTimeInterface|null
     */
    private $activeTill;

    /**
     * @var integer|null
     */
    private $hoursToComplete;

    /**
     * @var integer|null
     */
    private $defaultSecondsToCompleteQuestion;

    /**
     * @var boolean
     */
    private $canResume;

    /**
     * @var integer|null
     */
    private $scoreToPass;

    /**
     * @var integer|null
     */
    private $maximumErrorCount;

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
     * @return Training
     */
    public static function fromJson(array $data)
    {
        $result = new self();

        $result->id = $data['id'];
        $result->createdOn = DateTimeImmutable::createFromFormat(DateTime::ISO8601, $data['created_on']);
        $result->name = $data['name'];
        $result->shortDescription = $data['short_description'];
        $result->description = $data['description'];
        $result->referenceCode = $data['reference_code'];
        $result->active = $data['active'];

        if ($data['active_from']) {
            $result->activeFrom = DateTimeImmutable::createFromFormat(DateTime::ISO8601, $data['active_from']);
        }

        if ($data['active_till']) {
            $result->activeTill = DateTimeImmutable::createFromFormat(DateTime::ISO8601, $data['active_till']);
        }

        $result->hoursToComplete = $data['hours_to_complete'];
        $result->defaultSecondsToCompleteQuestion = $data['default_seconds_to_complete_question'];
        $result->canResume = $data['can_resume'];
        $result->scoreToPass = $data['score_to_pass'];
        $result->maximumErrorCount = $data['maximum_error_count'];

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
     * @return DateTimeInterface
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return null|string
     */
    public function getReferenceCode()
    {
        return $this->referenceCode;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getActiveFrom()
    {
        return $this->activeFrom;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getActiveTill()
    {
        return $this->activeTill;
    }

    /**
     * @return int|null
     */
    public function getHoursToComplete()
    {
        return $this->hoursToComplete;
    }

    /**
     * @return int|null
     */
    public function getDefaultSecondsToCompleteQuestion()
    {
        return $this->defaultSecondsToCompleteQuestion;
    }

    /**
     * @return bool
     */
    public function isCanResume()
    {
        return $this->canResume;
    }

    /**
     * @return int|null
     */
    public function getScoreToPass()
    {
        return $this->scoreToPass;
    }

    /**
     * @return int|null
     */
    public function getMaximumErrorCount()
    {
        return $this->maximumErrorCount;
    }
}
