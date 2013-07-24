<?php
function pre($str)
{
	echo '<pre>';
	print_r($str);
	echo '</pre>';
}

function pred($str)
{
	pre($str);
	die();
}

function _t($alias)
{
	include APP_DIR.'/i18n/ru.php';

	return always_set($i18n, $alias, $alias);
}

function _url($url)
{
	return $url;
}

function always_set($array, $key, $default = null)
{
	return isset($array[$key]) ? $array[$key] : $default;
}

function is_location($url)
{
	$url = trim($url, '/');
	$url = explode('/', $url);

	return $url[0] == $_GET['controller'] && $url[1] == $_GET['action'];
}

function is_ajax()
{
	return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
		&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

function redirect($url)
{
	header('location: '.$url);
	exit();
}