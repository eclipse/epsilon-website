<?
$s = "[[svn:eclipse.org/foo.php]]";
$s = substr($s, 6);
$s = substr($s, 0, strlen($s) - 2);
echo $s;
?>