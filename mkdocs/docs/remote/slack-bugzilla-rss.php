<?
header('Content-Type: text/xml');
$url = "https://bugs.eclipse.org/bugs/buglist.cgi?bug_severity=blocker&bug_severity=critical&bug_severity=major&bug_severity=normal&bug_severity=minor&bug_severity=trivial&bug_status=UNCONFIRMED&bug_status=NEW&bug_status=ASSIGNED&bug_status=REOPENED&bug_status=RESOLVED&list_id=19426194&product=epsilon&query_format=advanced&title=Bug%20List&ctype=atom";
$xml = simplexml_load_file($url);
foreach($xml->entry as $entry) {
	$entry->summary = "";
}
echo $xml->asXML();
?>