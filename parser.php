<?php

/**
 * Created by PhpStorm.
 * User: pmorozov
 * Date: 28.05.2018
 * Time: 17:32
 */

use Logger\Logger;
use Analyzer\Logs_Analyzer;
use Params\Cli_Params;

require_once 'app/autoloader.php';

$logger = new Logger();
$params = new Cli_Params($logger, $argv);

// Считали параметры скрипта
$log_file = $params->get_first();
if (!file_exists($log_file)) {
	$logger->log('File not found');
	die();
}

// Распарсили лог
$log_data = (new Logs\Parser($logger))
	->load_data($log_file);

$analyzer = new Logs_Analyzer($log_data);

// Посчитали статистику
$statistics = (new Logs\Statistic($analyzer))
	->form_stat();

var_dump(json_encode($statistics));