<?php
/**
 * Created by PhpStorm.
 * User: pmorozov
 * Date: 28.05.2018
 * Time: 19:07
 */

namespace Params;

use Logger\Interfaces\Logger;

class Cli_Params {

	/**
	 * @var Logger
	 */
	private $_logger;

	/**
	 * @var array
	 */
	private $_argv;

	public function __construct(Logger $logger, array $argv)
	{
		$this->_logger = $logger;
		$this->_argv = $argv;
	}

	/**
	 * Получить первый параметр
	 *
	 * @return string|null
	 */
	public function get_first()
	{
		getopt(NULL, [], $opts);
		$options = array_slice($this->_argv, $opts);

		if (empty($options)) {
			$this->_logger->log('Empty options list');

			return NULL;
		}

		return reset($options);
	}

}