<?php
/**
 * Created by PhpStorm.
 * User: pmorozov
 * Date: 28.05.2018
 * Time: 19:03
 */

namespace Logs;

use Logger\Logger;

class Parser implements Interfaces\Parser {

	/**
	 * @var Logger
	 */
	private $_logger;

	/**
	 * @var array
	 */
	private $_data;

	private static $_possible_regexp = [
		'/^([^ ]+) ([^ ]+) ([^ ]+) (\[[^\]]+\]) "(.*) (.*) (.*)" ([0-9\-]+) ([0-9\-]+) "(.*)" "(.*)"$/'
//		self::PATTERN_BASE,
//		self::PATTERN_ADDITIONAL,
	];

	/**
	 * @var array
	 */
	private static $_log_keys = [
		self::SOURCE,
		self::REMOTE_HOST,
		self::IDENTITY,
		self::REMOTE_USER,
		self::DATE,
		self::TIME,
		self::TIMEZONE,
		self::HTTP_METHOD,
		self::ENDPOINT,
		self::HTTP_VERSION,
		self::HTTP_CODE,
		self::BYTES_SENT,
		self::REFERER,
		self::USER_AGENT,
	];

	public function __construct(Logger $logger)
	{
		$this->_logger = $logger;
	}

	/**
	 * Загружает данные лога из файла
	 *
	 * @param string $log_path
	 * @return array
	 */
	public function load_data($log_path)
	{
		$this->_data = [];

		$log = file($log_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		foreach ($log as $log_line) {
			$this->parse($log_line);
		}

		return $this->_data;
	}

	/**
	 * Парсит строку лога
	 *
	 * @param string $log_line
	 */
	private function parse($log_line)
	{
		$matches = [];
		foreach (self::$_possible_regexp as $regexp) {
			preg_match($regexp, $log_line, $matches);
			if ($matches) {
				break;
			}
		}

		if (count($matches) === 0) {
			$this->_logger->log("The string does not match the patterns '{$log_line}'");

			return;
		}

		$this->_data[] = array_combine(self::$_log_keys, $matches);
	}

}