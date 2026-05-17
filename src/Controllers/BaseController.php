<?php

namespace App\Controllers;

use Smarty\Smarty;

abstract class BaseController
{
	protected Smarty $smarty;

	public function __construct()
	{
		$this->smarty = new Smarty();
		$this->smarty->setTemplateDir(__DIR__ . '/../../templates');
		$this->smarty->setConfigDir(__DIR__ . '/../../configs');
		$this->smarty->setCompileDir(__DIR__ . '/../../templates_c');
		$this->smarty->setCacheDir(__DIR__ . '/../../cache');
		$this->smarty->setEscapeHtml(true);
	}
}