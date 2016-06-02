<?php
/**
 * Chronolabs REST Screening Selector API
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Chronolabs Cooperative http://labs.coop
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         screening
 * @since           1.0.2
 * @author          Simon Roberts <meshy@labs.coop>
 * @version         $Id: functions.php 1000 2013-06-07 01:20:22Z mynamesnot $
 * @subpackage		api
 * @description		Screening API Service REST
 * @link			https://screening.labs.coop Screening API Service Operates from this URL
 * @filesource
 */

	session_start();
	//error_reporting(0);
	ini_set('display_errors', true);
	ini_set('error_log', dirname(__FILE__) . '/errors.txt');
	ini_set('log_errors', true);
	include dirname(__FILE__) . '/functions.php';
	
	global $solve;
	$solve = '';
	for($r=0;$r<mt_rand(5,9);$r++)
		$solve .= chr(mt_rand(ord('-'), ord('z')));
	 
	define('MAXIMUM_QUERIES', 13);
	ini_set('memory_limit', '256M');

	if (!in_array(whitelistGetIP(true), whitelistGetIPAddy())) {
		if (isset($_SESSION['reset']) && $_SESSION['reset']<microtime(true))
			$_SESSION['hits'] = 0;
		if ($_SESSION['hits']<=MAXIMUM_QUERIES) {
			if (!isset($_SESSION['hits']) || $_SESSION['hits'] = 0)
				$_SESSION['reset'] = microtime(true) + 3600;
			$_SESSION['hits']++;
		} else {
			header("HTTP/1.0 404 Not Found");
			exit;
		}
	}
	
	include dirname(__FILE__).'/functions.php';
	if (isset($_REQUEST['md5']) && isset($_SESSION['solve']))
		if (md5($_REQUEST['md5']) == md5($_SESSION['solve'])) {
			if (isset($_REQUEST['ip'])&&(isset($_REQUEST['mode'])&&$_REQUEST['mode']=='ip')) {
				$output = file(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'whitelist.txt');
				if (!in_array(trim($_REQUEST['ip']), $output)) {
					unlink(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'whitelist.txt');
					$output[] = trim($_REQUEST['ip']);
					$file = fopen(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'whitelist.txt', 'w+');
					fwrite ($file, implode("\n", $output), strlen(implode("\n", $output)));
					fclose($file);
					$GLOBALS['written'] = $_REQUEST['mode'];
					$GLOBALS['value'] = trim($_REQUEST['ip']);
				}
			} elseif (isset($_REQUEST['netbios'])&&(isset($_REQUEST['mode'])&&$_REQUEST['mode']=='netbios')) {
				$output = file(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'whitelist-domains.txt');
				if (!in_array(trim($_REQUEST['netbios']), $output)) {
					unlink(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'whitelist-domains.txt');
					$output[] = trim($_REQUEST['ip']);
					$file = fopen(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'whitelist-domains.txt', 'w+');
					fwrite ($file, implode("\n", $output), strlen(implode("\n", $output)));
					fclose($file);
					$GLOBALS['written'] = $_REQUEST['mode'];
					$GLOBALS['value'] = trim($_REQUEST['netbios']);
				}
			}
		}

	$_SESSION['solve'] = $solve;
	
	//http_response_code(400);
	include dirname(__FILE__).'/help.php';


	
?>
		