<?
function countElements($elements, $name) {
	$i = 0;
	foreach ($elements as $element) {
		if ($element->getName() == $name) {
			$i++;
		}
	}
	return $i;
}

function readUrlContent($url) {
	$content = '';
	if ($fp = fopen($url, 'r')) {
   		// keep reading until there's nothing left 
   		while ($line = fread($fp, 1024)) {
      		$content .= preg_replace('/[\t]/', '  ', trim($line));
   		}
   		$content = htmlentities(trim($content));
	} else {
	   $content = "Unavailable"; 	
	}
	return $content;
}

function getFileExtension($fileName) {
	return pathinfo($fileName, PATHINFO_EXTENSION);
}

?>