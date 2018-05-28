<?php
/**
 * Created by PhpStorm.
 * User: pmorozov
 * Date: 28.05.2018
 * Time: 19:05
 */

namespace Logs\Interfaces;

interface Parser {

	const PATTERN_BASE = '/^(\S+) (\S+) (\S+) \[([^:]+):(\d+:\d+:\d+) ([^\]]+)\] \"(\S+) (.*?) (\S+)\" (\S+) (\S+) "([^"]*)" "([^"]*)"$/';
	const PATTERN_ADDITIONAL = '/^(\S+)(\S+) (\S+) \[([^:]+):(\d+:\d+:\d+) ([^\]]+)\] \"(\S+) (.*?) (\S+)\" (\S+) (\S+) "([^"]*)" "([^"]*)"$/';

	const SOURCE = 'source';
	const REMOTE_HOST = 'remote_host';
	const IDENTITY = 'identity';
	const REMOTE_USER = 'remote_user';
	const DATE = 'date';
	const TIME = 'time';
	const TIMEZONE = 'timezone';
	const HTTP_METHOD = 'http_method';
	const ENDPOINT = 'endpoint';
	const HTTP_VERSION = 'http_version';
	const HTTP_CODE = 'http_code';
	const BYTES_SENT = 'bytes_sent';
	const REFERER = 'referer';
	const USER_AGENT = 'user_agent';

}