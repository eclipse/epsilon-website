<?
$url = "https://bugs.eclipse.org/bugs/buglist.cgi?list_id=19418181&product=epsilon&query_format=advanced&title=Bug%20List&ctype=atom";
$xml = simplexml_load_file($url);
print_r($xml);
?>