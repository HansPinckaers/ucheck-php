<?
ini_set('display_errors', 0);

function base64url_encode($data) { 
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

function base64url_decode($data) { 
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
} 

$user = $_GET['user'];

if(file_exists("../geheim/iphone.php"))
{
	include("../geheim/iphone.php");
	
	$pwd = $cryptastic->decrypt($_GET['pass'], $key, true);
} else {
	$pwd =  base64url_decode($_GET['pass']);
}
	
	
echo $json = file_get_contents("http://109.72.92.55:3000/inschrijvingen/$user/$pwd/");

// Turn off all error reporting
try {
include('Galvanize.php');
$GA = new Galvanize('UA-4063156-9');
$GA->trackPageView();
} catch (Exception $e) {}
?>