<?php

namespace App\Models;

use BridgeSQL\BridgeSQL;

abstract class BaseModel
{
	/**
	 * @var BridgeSQL
	 */
	protected BridgeSQL $db;

	public function __construct()
	{
		$this->db = require __DIR__ . '/../../database/config.php';
	}
}