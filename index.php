<?php
require_once('log.php');

loggly_log(file_get_contents('php://input'), "trellotest");
