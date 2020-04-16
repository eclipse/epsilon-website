<?
header('Content-Type: text/xml');
$url = "https://bugs.eclipse.org/bugs/buglist.cgi?component=Core&product=Epsilon&query_format=advanced&resolution=---&title=Bug%20List&ctype=atom";
$xml = simplexml_load_file($url);
foreach($xml->entry as $entry) {
	$entry->summary = "";
}
echo $xml->asXML();
?>