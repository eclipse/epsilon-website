<?
require_once('../../../epsilon.php');
function redirect() {
	$serverName = $_SERVER['SERVER_NAME'];
	$protocol = "https";
	if ($serverName == "eclipse.org") {
		//FIX if server == eclipse.org it doesn't work - for some reason
		$serverName = "www.eclipse.org";
	}
	if ($_SERVER['SERVER_PORT'] != 80) {
		// Useful if we're working locally on the website, with a custom port number
		$serverName = "$serverName:" . $_SERVER['SERVER_PORT'];
		$protocol = "http";
	}
	$requestUrl = $_SERVER["REQUEST_URI"];
	$requestUrl = trim($requestUrl,"/");
	$generatorId = substr($requestUrl, strrpos($requestUrl,"/")+1);
	$redirectUrl = $protocol.'://'.$serverName.Epsilon::getRelativeLocation('')."/apps/data-generator/generator.php?generator=".$generatorId;

	// in case there are spaces in the URL (probably only on local servers)
	$redirectUrl = str_replace(" ","%20",$redirectUrl);

	echo file_get_contents($redirectUrl);

}
?>
