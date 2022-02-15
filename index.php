<?php

function exceptions_error_handler($severity, $message, $filename, $lineno)
{
	throw new ErrorException($message, 0, $severity, $filename, $lineno);
}

set_error_handler('exceptions_error_handler',E_ALL & ~E_NOTICE & ~E_STRICT  & ~E_WARNING);

// the rest API part:
require_once('classes/TestAPIServer.php');

$TestAPIServer = new TestAPIServer();
$TestAPIServer->run();
