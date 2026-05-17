<?php

function dd(mixed $value) : void
{
	echo '<pre>';
	var_export($value);
	echo '<pre/>';
}