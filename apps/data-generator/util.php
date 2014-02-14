<?
function readEmfaticContent($url) {
	$content = '';
	if ($fp = fopen($url, 'r')) {
   		// keep reading until there's nothing left 
   		while ($line = fread($fp, 1024)) {
      		$content .= preg_replace('/[\t]/', '  ', trim($line));
   		}
   		
   		$lines = explode("\n", $content);
   		
   		$filteredContent = "";
   		foreach ($lines as $line) {
      		$filteredContent .= $line."\n";
   		}
   		
   		$content = htmlentities(trim($filteredContent));
	} else {
	   $content = "Unavailable"; 	
	}
	return $content;
}

function startsWith($haystack, $needle)
{
    return !strncmp($haystack, $needle, strlen($needle));
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}
?>