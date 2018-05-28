<?php
/**
 * Created by PhpStorm.
 * User: pmorozov
 * Date: 28.05.2018
 * Time: 18:45
 */

namespace Logger;

class Logger implements Interfaces\Logger
{
	/**
	 * Вывод в консоль
	 *
	 * @param string $text
	 */
	public function log($text)
	{
		echo $text . "\n";
	}
}