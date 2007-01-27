<?='Started3...'?>
<?
//$fp = fopen('http://dev.eclipse.org/viewcvs/indextech.cgi/org.eclipse.gmt/epsilon/org.epsilon.eclipse.help/index.html','r');
$fp = fopen('http://www.google.com','r');
$content = '';
//keep reading until there's nothing left
while ($line = fread($fp, 1024)) {
	$content .= $line;
}
?>
<?=$content?>
}<?='Finished...'?>
