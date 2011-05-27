<?
function redirect() {
	$serverName = $_SERVER['SERVER_NAME'];
	if ($serverName == "eclipse.org") {
		//FIX if server == eclipse.org it doesn't work - for some reason
		$serverName = "www.eclipse.org";
	}
	if ($_SERVER['SERVER_PORT'] != 80) {
		// Useful if we're working locally on the website, with a custom port number
		$serverName = "$serverName:" . $_SERVER['SERVER_PORT'];
	}
	$requestUrl = $_SERVER["REQUEST_URI"];
	$requestUrl = trim($requestUrl,"/");
	$articleId = substr($requestUrl, strrpos($requestUrl,"/")+1);
	$redirectUrl = "http://".$serverName."/gmt/epsilon/doc/articles/article.php?articleId=".$articleId;
	echo file_get_contents($redirectUrl);
	//echo "v6";
	//echo "<b>Under maintenance. Please check back soon</b>";
	//echo "<br>";
	//echo $redirectUrl;
	//echo "<br>";
	//echo "redirected";
}
?>
