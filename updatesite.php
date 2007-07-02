<?
$f=fopen("updatestats.txt","a");
fwrite($f,gethostbyaddr($_SERVER["REMOTE_ADDR"]));
fwrite($f, " - ");
fwrite($f,date("l dS of F Y h:i:s A"));
fwrite($f,"\r\n");
fclose($f);
$url = "http://download.eclipse.org/technology/gmt/epsilon/org.epsilon.eclipse.updatesite/site.xml";
header ("Content-type: text/xml");
header ("Location: ".$url);
?>