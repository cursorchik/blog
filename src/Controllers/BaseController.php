<?php

namespace App\Controllers;

use BridgeSQL\BridgeSQL;
use Smarty\Smarty;

abstract class BaseController
{
	protected BridgeSQL $db;
	protected Smarty $smarty;

	public function __construct()
	{
		$this->db = require __DIR__ . '/../../database/config.php';

		dd($this->db->getDebugLog());

		$this->smarty = new Smarty();
		$this->smarty->setTemplateDir(__DIR__ . '/../../templates');
		$this->smarty->setConfigDir(__DIR__ . '/../../configs');
		$this->smarty->setCompileDir(__DIR__ . '/../../templates_c');
		$this->smarty->setCacheDir(__DIR__ . '/../../cache');
		$this->smarty->setEscapeHtml(true);
	}
}