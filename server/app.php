<?php

define("ROOT", dirname($_SERVER["DOCUMENT_ROOT"]));

require_once ROOT . "/vendor/autoload.php";

use server\controller\Dispatcher;

// Controller実行
$dispatcher = new Dispatcher(ROOT);
$dispatcher->init();
