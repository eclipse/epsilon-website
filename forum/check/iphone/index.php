<?
//chdir('..');
//include_once('news/news.php');
?>
<!--?=//r2m("eclipse.epsilon", "http://www.eclipse.org/forums/rdf.php?mode=m&l=1&basic=1&frm=22&n=10", array(' '))?-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="index,follow" name="robots" />
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
<link href="pics/homescreen.png" rel="apple-touch-icon" />
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="javascript/functions.js" type="text/javascript"></script>
<title>Epsilon Forum - iPhone</title>
<meta content="iPod,iPhone,Webkit,iWebkit,Website,Create,mobile,Tutorial,free" name="Keywords" />
<meta content="Create the classical iphone list feeling with these lists. Add images to make bigger and nicer lists." name="description" />
</head>

<body class="list">

<div id="topbar">
	<div id="leftnav">
		<a href="index.html"><img alt="home" src="images/home.png" /></a></div>
	<div id="title">
		Epsilon Forum</div>
</div>
<div id="content">
	<ul class="autolist">
		<li class="title">Recent messages</li>
		<?for ($i=0;$i<10;$i++){?>
		<li class="withimage">
			<a class="menu" href="index.html">
				<!--img alt="test" src="http://dev.eclipse.org/huge_icons/apps/internet-mail.png"-->
				<span class="name">Re: Eugenia problems</span>
				<span class="comment">Dimitris Kolovos</span>
				<span class="arrow"></span>
			</a>
		</li>
		<?}?>
	</ul>
</div>
<div id="footer">
	<a href="http://iwebkit.net">Powered by iWebKit</a></div>
</body>
</html>
