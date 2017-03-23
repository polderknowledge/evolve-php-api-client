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

final class ActiveTrainingState
{
    const NODE_TYPE_START = 'start';
    const NODE_TYPE_QUESTION = 'question';

    const QUESTION_STATE_ANSWER = 'answer';
    const QUESTION_STATE_FEEDBACK = 'feedback';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $nodeType;

    /**
     * @var string
     */
    private $questionState;

    /**
     * @var array
     */
    private $params;

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
     * @return ActiveTrainingState
     */
    public static function fromJson(array $data)
    {
        $result = new self();

        $result->id = $data['id'];
        $result->nodeType = $data['node_type'];
        $result->questionState = $data['state'];
        $result->params = array_key_exists('params', $data) ? $data['params'] : [];

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
    public function getNodeType()
    {
        return $this->nodeType;
    }

    /**
     * @return string
     */
    public function getQuestionState()
    {
        return $this->questionState;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
