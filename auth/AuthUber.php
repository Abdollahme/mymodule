<?php
require_once(dirname(__FILE__).'/../../../config/config.inc.php');
require_once(dirname(__FILE__).'/../../../init.php');
require_once(dirname(__FILE__).'/../mymodule.php');

$context = Context::getContext();

// Instance of module class
$module = new MyModule();
$module->uberConnexion();

