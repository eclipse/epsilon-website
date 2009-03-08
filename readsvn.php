<?
	$url = "http://dev.eclipse.org/svnroot/modeling/org.eclipse.gmt.epsilon/trunk/examples/org.eclipse.epsilon.examples.ewl.uml/wizards/uml.ewl";
	if ($fp = fopen($url, 'r')) {
   // keep reading until there's nothing left 
   while ($line = fread($fp, 1024)) {
      $content .= $line;
   }
	} else {
	   $content = "Unavailable"; 	
	}
?>

<?=$content?>