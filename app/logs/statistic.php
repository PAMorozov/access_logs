<?php
/**
 * Created by PhpStorm.
 * User: pmorozov
 * Date: 28.05.2018
 * Time: 18:39
 */

namespace Logs;

use Analyzer\Logs_Analyzer;

class Statistic
{
	/**
	 * @var Logs_Analyzer
	 */
	private $_analyzer;

	/**
	 * Statistic constructor.
	 * @param Logs_Analyzer $analyzer
	 */
	public function __construct(Logs_Analyzer $analyzer)
	{
		$this->_analyzer = $analyzer;
	}

	/**
	 * Формирование данных статистики
	 *
	 * @return array
	 */
	public function form_stat()
	{
		$stat = [
			'views'       => $this->_analyzer->get_count_requests(),
			'urls'        => $this->_analyzer->get_unique_urls(),
			'traffic'     => $this->_analyzer->get_sum_traffic(),
			'crawlers'    => $this->_analyzer->get_referers(),
			'statusCodes' => $this->_analyzer->get_status_codes(),
		];

		return $stat;
	}

}