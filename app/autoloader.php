<?php
/**
 * Created by PhpStorm.
 * User: pmorozov
 * Date: 28.05.2018
 * Time: 18:06
 */

spl_autoload_register(function ($class) {
	$path = __DIR__ . '/' . str_replace('\\', '/', strtolower($class)) . '.php';
	if (file_exists($path)) {
		/** @noinspection PhpIncludeInspection */
		include $path;
	}
});