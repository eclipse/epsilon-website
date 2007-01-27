<?='Started#1...'?>
<?
$fp = fopen('http://dev.eclipse.org/viewcvs/indextech.cgi/org.eclipse.gmt/epsilon/examples/OO2DB/readme.txt','r');
//$fp = fopen('http://www.google.com','r');
$content = '';
//keep reading until there's nothing left
while ($line = fread($fp, 1024)) {
	$content .= $line;
?>
<?=$content?>
<?
}
$content = file_get_contents('http://www.google.com/');
?>
<?=$content?>
<?='Finished...'?>
