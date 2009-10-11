<?
function redirect() {
	$serverName = $_SERVER['SERVER_NAME'];
	$requestUrl = $_SERVER["REQUEST_URI"];
	$requestUrl = trim($requestUrl,"/");
	$articleId = substr($requestUrl, strrpos($requestUrl,"/")+1);
	$redirectUrl = "http://".$_SERVER['SERVER_NAME']."/gmt/epsilon/doc/articles/article.php?articleId=".$articleId;
	echo file_get_contents($redirectUrl);
	echo "redirected";
}
?>
