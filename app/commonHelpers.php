<?php
// My common functions

function maiuscolo($stringa)
{
	$accentate = array("à","è","é","ì","ò","ù");
	$sostituzioni = array("À","È","É","Ì","Ò","Ù");
	return strtoupper(str_replace($accentate,$sostituzioni,$stringa));
}

function formato($data, $formato='Y/m/d H:i')
{
	$date = DateTime::createFromFormat('Y-m-d H:i:s', $data);
	return $date->format('d/m/Y H:i');
}

?>