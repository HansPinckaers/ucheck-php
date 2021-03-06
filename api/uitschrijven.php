<?
## Copyright (c) 2011 by Hans Pinckaers 
##
## This work is licensed under the Creative Commons 
## Attribution-NonCommercial-ShareAlike 3.0 Unported License. 
## To view a copy of this license, visit 
## http://creativecommons.org/licenses/by-nc-sa/3.0/ 
##
## ucheck-php: https://github.com/HansPinckaers/ucheck-php
## ucheck-node: https://github.com/HansPinckaers/ucheck-node
##

ini_set('display_errors', 0);

function base64url_encode($data) 
{ 
	return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

function base64url_decode($data) 
{	
	return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
}

$dangerous_characters = array(" ", '"', "'", "&", "/", "\\", "?", "#", ".");
$user = str_replace($dangerous_characters, '_', $_GET['user']);

$forbidden_characters = array(" ", '"', "'", "&", "/", "\\", "?", "#", ".");

if(file_exists("../geheim/iphone.php"))
{
	include("../geheim/iphone.php");

	$pwd = $geheim->decrypt($_GET['pass'], $key, true);
} 
else {
	$pwd = base64url_decode($_GET['pass']);
}

include "../raw/uitschrijven.php";


if(isset($all_matches[0]))
{
	echo strip_tags($all_matches[0][0]);
} else {
	echo 'Het is niet bekend of het goed gegaan is, vernieuw de pagina en controleer onder inschrijvingen of deze eronder staat.';
}

// https://ucheck.nl/uitschrijven.php?q=$1%2010,&year=12
?>


