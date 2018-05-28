<?php

/**
 * Created by PhpStorm.
 * User: pmorozov
 * Date: 28.05.2018
 * Time: 19:39
 */

namespace Analyzer;

use Logs\Interfaces\Parser;

/**
 * В случае больших объемов лога лучше считывать не все данные из лога, а построчно и одновременно вести учет статистики
 *
 * Class Logs_Analyzer
 * @package Analyzer
 */
class Logs_Analyzer
{
	const REFERER_GOOGLE = 'google';
	const REFERER_BING = 'bing';
	const REFERER_BAIDU = 'baidu';
	const REFERER_YANDEX = 'yandex';

	/**
	 * @var array
	 */
	private $_data = [];

	/**
	 * Logs_Analyzer constructor.
	 * @param array $data
	 */
	public function __construct(array $data)
	{
		$this->_data = $data;
	}

	/**
	 * Получить количество запросов
	 *
	 * @return int
	 */
	public function get_count_requests()
	{
		$count_requests = count($this->_data);

		return $count_requests;
	}

	/**
	 * Получить количество уникальных url
	 *
	 * @return array
	 */
	public function get_unique_urls()
	{
		$urls = array_column($this->_data, Parser::ENDPOINT);
		$unique_urls = array_unique($urls);

		return count($unique_urls);
	}

	/**
	 * Получить объем трафика
	 *
	 * @return float|int
	 */
	public function get_sum_traffic()
	{
		$traffic = array_column($this->_data, Parser::BYTES_SENT);
		$sum = array_sum($traffic);

		return $sum;
	}

	/**
	 * Статистика HTTP кодов
	 *
	 * @return array
	 */
	public function get_status_codes()
	{
		$http_codes = [];
		foreach ($this->_data as $log_line) {
			$http_codes[$log_line[Parser::HTTP_CODE]]++;
		}

		return $http_codes;
	}

	/**
	 * Получить статистику по запросам из поисковиков
	 *
	 * @return array
	 */
	public function get_referers()
	{
		$referers = [
			self::REFERER_GOOGLE => 0,
			self::REFERER_BING   => 0,
			self::REFERER_BAIDU  => 0,
			self::REFERER_YANDEX => 0,
		];

		foreach ($this->_data as $log_line) {
			$referer = $log_line[Parser::REFERER];
			switch (TRUE) {
				case strpos($referer, 'google.com') !== FALSE:
					$referers[self::REFERER_GOOGLE]++;
					break;
				case strpos($referer, 'bing.com') !== FALSE:
					$referers[self::REFERER_BING]++;
					break;
				case strpos($referer, 'baidu.com') !== FALSE:
					$referers[self::REFERER_BAIDU]++;
					break;
				case strpos($referer, 'yandex.ru') !== FALSE:
					$referers[self::REFERER_YANDEX]++;
					break;
			}
		}

		return $referers;
	}
}
