<?php
// My common functions

function maiuscolo($stringa)
{
	 $accentate = array("à","è","é","ì","ò","ù");
	 $sostituzioni = array("À","È","É","Ì","Ò","Ù");
	 return strtoupper(str_replace($accentate,$sostituzioni,$stringa));
}

?>