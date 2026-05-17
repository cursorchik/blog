<?php

namespace App\Controllers;

use Smarty\Smarty;
use Smarty\Exception;
use BridgeSQL\BridgeSQL;

abstract class BaseController
{
	protected BridgeSQL $db;

	public function __construct()
	{
		$this->db = require __DIR__ . '/../../database/config.php';
	}
}