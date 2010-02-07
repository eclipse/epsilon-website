<?
chdir('..');
chdir('..');
chdir('..');
//chdir('..');
include_once('news/news.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>iUI Music Demo</title>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<link rel="apple-touch-icon" href="iui/iui-logo-touch-icon.png" />
<meta name="apple-touch-fullscreen" content="YES" />
<style type="text/css" media="screen">@import "iui/iui.css";</style>
<script type="application/x-javascript" src="iui/iui.js"></script>
</head>

<body>
    <div class="toolbar">
        <h1 id="pageTitle">Epsilon Forum</h1>
        <a id="backButton" class="button" href="#"></a>
		<a id="otherButton" class="button" href="#"></a>
    </div>
		
		
	<?=r2i("e.epsilon", "http://www.eclipse.org/forums/rdf.php?mode=m&l=1&basic=1&frm=22&n=10")?>



</body>
</html>
