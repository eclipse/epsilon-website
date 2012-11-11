<?
function readEmfaticContent($url, $level, $levelCount) {
	$content = '';
	if ($fp = fopen($url, 'r')) {
   		// keep reading until there's nothing left 
   		while ($line = fread($fp, 1024)) {
      		$content .= preg_replace('/[\t]/', '  ', trim($line));
   		}
   		
   		$lines = explode("\n", $content);
   		
   		$filteredContent = "";
   		foreach ($lines as $line) {
   			$includeLine = true;
      		for ($i=1;$i<=$levelCount+1;$i++) {
				$levelTag = "//level".$i;
      			if (endswith(trim($line), $levelTag)) {
      				if ($i >= $level+1) {
      					$includeLine = false;
      				}
      				$line = substr($line, 0, strlen($line) - strlen($levelTag) - 1);
      			}
      			if (endswith(trim($line), "//hide")) {
      				$includeLine = false;
      			}
      		}
      		if ($includeLine) {
      			$filteredContent .= $line."\n";
      		}
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