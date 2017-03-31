<?php
/**
 * Evolve / php-api-client (https://evolve123.com)
 *
 * @link https://gitlab.polderknowledge.nl/evolve/php-api-client for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Evolve (https://evolve123.com)
 * @license https://gitlab.polderknowledge.nl/evolve/php-api-client/blob/master/LICENSE.md MIT
 */

namespace Evolve123\ApiClient\State;

final class Answer
{
	/**
	 * @var string
	 */
	private $id;

	/**
	 * @var string|null
	 */
	private $value;

	/**
	 * Initializes a new instance of this class.
	 *
	 * @param string $id
	 * @param string|null $value
	 */
	public function __construct($id, $value = null)
	{
		$this->id = $id;
		$this->value = $value;
	}

	/**
	 * Gets the value of field "id".
	 *
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Gets the value of field "value".
	 *
	 * @return null|string
	 */
	public function getValue() {
		return $this->value;
	}
}
