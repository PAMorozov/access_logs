<?php
/**
 * Created by PhpStorm.
 * User: pmorozov
 * Date: 28.05.2018
 * Time: 18:02
 */

namespace Logger\Interfaces;

interface Logger
{
	/**
	 * Вывод в консоль
	 *
	 * @param string $text
	 */
	public function log($text);
}