<?php
/**
 * Created by PhpStorm.
 * User: JOREXZOFLANK
 * Date: 6/7/15
 * Time: 11:01 PM
 */

define("DS", DIRECTORY_SEPARATOR);

/* THE BASE URL */

$base_url = "";

define("IS_SECURE", ((isset($_SERVER['HTTPS'])) && $_SERVER['HTTPS'] == "on")? true : false );

$base_url = "http" . ((IS_SECURE) ? "s" : "") . "://". $_SERVER['HTTP_HOST'];

$project_folder = str_ireplace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$base_url .= $project_folder;

$base_uri = $_SERVER["DOCUMENT_ROOT"] . DS . $project_folder;

define("BASE_URL", $base_url);

/**
 *System RAW PATH TO LOCAL DIR E.g C:WWW/
 */
define("BASE_URI", $base_uri);

var_dump(BASE_URL);

require_once("SampleController.php");

$sample = new Controller\SampleController();

$sample->index();