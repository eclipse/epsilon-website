<?php  																														
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	
$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'

	#*****************************************************************************
	#
	# template.php
	#
	# Author: 		Freddy Allilaire
	# Date:			2006-05-29
	#
	# Description: Type your page comments here - these are not sent to the browser
	#
	#
	#****************************************************************************
	
	#
	# Begin: page-specific settings.  Change these. 
	$pageTitle 		= "Live";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../common.php');
	ob_start();
?>

	<script>
		  var http = createRequestObject();

	    function createRequestObject() {
	    	var objAjax;
	    	var browser = navigator.appName;
	    	if(browser == "Microsoft Internet Explorer"){
	    		objAjax = new ActiveXObject("Microsoft.XMLHTTP");
	    	}else{
	    		objAjax = new XMLHttpRequest();
	    	}
	    	return objAjax;
	    }

	    function run(){
			
			var myFrame = document.getElementById("myframe");
			
			myFrame.src = "http://www.google.com";
			
			window.alert(myFrame.contentWindow.document.body.innerHTML);
			
			return;
	
				
			var url = "http://epsilon-live.appspot.com/tryepsilon";
		
				//window.open(url);
				http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	    	http.open("post", url, true);
	    	
	    	http.onreadystatechange = updateNewContent;
	    	http.send("source=" + encodeURIComponent(document.getElementById("source").value));
	    	return false;
	    }

	    function updateNewContent(){
	    	window.alert(http.readyState);
	    	if(http.readyState == 4){
	    		
	    		var response;
	    			
	    		if (http.status == "200") {
	    			response = http.responseText;			
	    		}
	    		else {
	    			response = "An unexpected error occurred. Sorry :(";
	    		}
					window.alert(response);
	    		document.getElementById("console").innerHTML = response;
	    		//document.getElementById("console_area").scrollTop = document.getElementById("console_area").scrollHeight;
	    	}
	    }
	</script>
	<div id="midcolumn">
		<h1><?=$pageTitle?></h1>
		
		In this page you can play with the Epsilon Object Language - the core language of Epsilon - from your browser, without needing to download or install anything. You can select one of the examples on the right (and modify it if you feel like) and press Run to execute it and see the results in the console below.
		
		<div>
		<div style="float:right"><input type="image" onClick="javascript:run()" src="../images/run.gif"></input></div>
		<h3>Source</h3>
		</div>
		<textarea id="source" style="height:200px;width:500px"></textarea>
		<h3>Console</h3>
		<textarea id="console" style="height:200px;width:500px" readonly></textarea>
		<iframe id="myframe" src="http://www.yahoo.com"></iframe>
		<hr class="clearer" />

	</div>

<?
	include('../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>