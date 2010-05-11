<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'

	#*****************************************************************************
	#
	# template.php
	#
	# Author: 		Freddy Allilaire
	# Date:			2005-12-05
	#
	# Description: Type your page comments here - these are not sent to the browser
	#
	#
	#****************************************************************************
	
	#
	# Begin: page-specific settings.  Change these. 
	$pageTitle 		= "Epsilon";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('common.php');
	# Add page-specific Nav bars here
	# Format is Link text, link URL (can be http://www.someothersite.com/), target (_self, _blank), level (1, 2 or 3)
	# $Nav->addNavSeparator("My Page Links", 	"downloads.php");
	# $Nav->addCustomNav("My Link", "mypage.php", "_self", 3);
	# $Nav->addCustomNav("Google", "http://www.google.com/", "_blank", 3);

	# End: page-specific settings
	#
	
	include('../news/scripts/news.php');
	include('news/news.php');
	$epsilonnews = get_epsilonnews(6);
	
	#parse FAQs
	$faqs = simplexml_load_file("faq/faqs.xml")->faq;
	$random_faq = rand(0,count($faqs)-1);
	$faq = $faqs[$random_faq];
	$faq_id = $faq["id"];
	$faq_title = $faq->title;
	$faq_answer = $faq->answer;
	
	ob_start();
	?>
	

	<script type="text/javascript" src="slideshow/js/mootools.js"></script>
	<script type="text/javascript" src="slideshow/js/slideshow.js"></script>
	
	<script type="text/javascript">		
	//<![CDATA[
	  window.addEvent('domready', function(){
	    var data = {
						'slideshow/images/Eugenia.png': { caption: 'Generate a GMF editor from your Ecore metamodel with EuGENia', href: 'doc/eugenia'},
				'slideshow/images/EVL.png': { caption: 'Write constraints for your Ecore metamodel with EVL', href: 'doc/evl' },
				'slideshow/images/EVL-GMF.png': { caption: '... and see the errors/warnings in your GMF editor', href: 'doc/evl' },
				'slideshow/images/EWL.png': { caption: 'Write wizards for your metamodel with EWL', href: 'doc/ewl' },
				'slideshow/images/InvokeWizard.png': { caption: '... invoke them in your GMF editor', href: 'doc/ewl' },
				'slideshow/images/InvokedWizard.png': { caption: '... and see the results live in your editor', href: 'doc/ewl' },
	      		'slideshow/images/EOL.png': { caption: 'Query and modify your models with EOL', href: 'doc/eol' }, 
	      		'slideshow/images/Native.png': { caption: 'Call Java code from all Epsilon languages', href: 'doc/eol' },
				'slideshow/images/RegistryView.png': { caption: 'Explore the registered EMF EPackages', href: 'doc' }, 
				'slideshow/images/Exeed.png': { caption: 'Customize icons and labels in the reflective EMF editor', href: 'doc/exeed' }, 
				'slideshow/images/HUTN.png': { caption: 'Construct your models with the OMG HUTN', href: 'doc/hutn' }, 
				'slideshow/images/EGL.png': { caption: 'Generate text from your models with EGL', href: 'doc/egl' },
	      		'slideshow/images/ETL.png': { caption: 'Transform your models with ETL', href: 'doc/etl' },
				'slideshow/images/ECL.png': { caption: 'Compare your models with ECL', href: 'doc/ecl' },
				'slideshow/images/EML.png': { caption: 'Merge your models with EML', href: 'doc/eml' },
				'slideshow/images/ANT.png': { caption: 'Create complex workflows using the Epsilon ANT tasks', href: 'doc/worlkflow' }
	    };
	    var myShow = new Slideshow('show', data, {captions: true, controller: true, height:281, width:495, thumbnails: false, delay:6000});
	  });
	//]]>
	</script>	
	
	<!--
	<script type="text/javascript">		
	//<![CDATA[
	  window.addEvent('domready', function(){
	    var data2 = { 
	      		'users/Modelplex.png' : {},
	      		'users/Ample.png' : {},
	      		'users/York.png' : {}
	      		//'users/Nasa.png' : {},
	      		//'users/Surrey.png' : {},
	      		//'users/Telefonica.png' : {},
	      		//'users/Upv.png' : {},
	      		//'users/Us.png' : {},
	      		//'users/Ssei.png' : {},
	      		//'users/Lancaster.png' : {},
	      		//'users/WesternGeco.png' : {},
	      		//'users/Concordia.png' : {}
	      		//'users/Tud.png' : {}      		
	    };
	    var myShow2 = new Slideshow('users', data2, {captions: false, controller: false, height: 106, thumbnails: false, width: 160, delay:2000});
	  });
	//]]>
	</script>
	-->

	<!-- Middle part -->
	<div id="midcolumn">
		<?include('noscript.html')?>
		<!--h1><?=$pageTitle?></h1-->
					<!--h3>Welcome</h3-->
	    <img style="float:right" src="resources/epsilonlogo.big.png" alt="Epsilon Logo" /><p><b>Epsilon</b> is a family of consistent and interoperable task-specific programming languages which you can use to interact with your <a href="http://www.eclipse.org/emf">EMF</a> models to perform common Model Driven Engineering tasks such as <a href="doc/egl">code generation</a>, <a href="doc/etl">model-to-model transformation</a>, <a href="doc/evl">model validation</a>, <a href="doc/ecl">comparison</a>, <a href="doc/flock">migration</a>, <a href="doc/eml">merging</a> and <a href="doc/ewl">refactoring</a>.</p>
			<p>Epsilon also contains several tools and utilities that complement your EMF/GMF experience such as a wizard for generating GMF editors (<a href="doc/eugenia">EuGENia</a>), an implementation of the <a href="doc/hutn">Human Usable Textual Notation (HUTN)</a>, an <a href="doc/articles/epackage-registry-view/">EPackage registry view</a>, a customizable tree-based EMF model editor (<a href="doc/exeed">Exeed</a>), and a multi-view editor for establishing cross-model references (<a href="doc/modelink">Modelink</a>).</p>
	
	<!--Epsilon is a metamodel-agnostic component that supports programmatic creation, navigation, and modification of EMF models.-->
	
		<div class="homeitem">
			<h2>What can you do with Epsilon?</h2>
			<div id="show" class="slideshow" style="width:495px">
				
			</div>
		</div>
		
		<div class="homeitem">
			<!-- http://www.eclipse.org/forums/rdf.php?mode=m&l=1&basic=1&frm=22&n=10 -->
			<?=rdf2h("Recent forum posts", "http://www.eclipse.org/forums/rdf.php?mode=m&l=1&basic=1&frm=22&n=10", array(''), 3, 5, 500)?>
		</div>
		
		<div class="homeitem">
			<?=r2h("Recent articles in the blog", "remote/blogrss.xml", array(' '))?>
		</div>
		
		<?
		//include('blognews.static.php');
		?>
		
	</div>
	
	<!-- Right Part -->
	<div id="rightcolumn">

		<div class="sideitem">
			<center>
				<script type="text/javascript">
		          url_site = 'http://marketplace.eclipse.org/node/400'
		        </script>
		        <script src="http://marketplace.eclipse.org/sites/all/modules/drigg_external/js/button.js" type="text/javascript"></script>
			</center>
		</div>
		
		<div class="sideitem">
			<h6 style="background-color:#535776;color:white">Live</h6>
			<div class="modal">
			<ul>
				<li><a href="live">Try EOL in your browser</a> <i>(No need to download or install anything)</i>
			</ul>
			</div>
		</div>
		
		<div class="sideitem">
			<h6 nostyle="background-color:#36354F;color:white">Getting Started</h6>
			<div class="modal">
			<ol>
				<li><a href="doc">Learn more about Epsilon</a></li>
				<li><a href="cinema">Watch the screencasts</a></li>
				<li><a href="examples">Go through the examples</a></li>
				<li><a href="live">Try EOL in your browser</a>
				<li><a href="download"><b>Download</b></a></li>
				<li><a href="http://epsilonblog.wordpress.com">Visit the blog</a></li>
				<li><a href="forum">Get help in the forum</a>
				<li><a href="spreadtheword">Spread the word</a>
			</ol>
			</div>
		</div>
		
		<!--a href="http://www.twitter.com/epsilonews"><img src="resources/twitter2.png" style="position:relative;top:6px;left:45px"></img></a-->
		<!--
		<div class="sideitem">
			<h6>Get The Book</h6>
			<div align="center"><a href="doc/book"><img align="center" src="images/book2.png" border="0" alt="The Epsilon Book"/></a></div>
 		</div>
		-->
				        
		<div class="sideitem">
			<h6>Visitors</h6>
			<center>
			<a href="http://www4.clustrmaps.com/user/50849c1d">
				<img style="padding:5px;position:relative;left:7px" src="http://www4.clustrmaps.com/stats/maps-no_clusters/www.eclipse.org-gmt-epsilon-thumb.jpg" />
			</a>
			</center>
		</div>
				
		<div class="sideitem">
			<h6>Twitter (<a href="http://twitter.com/epsilonews" style="color:black">@epsilonews</a>)</h6>
			<div class="modal">
				<ul id="twitter_update_list"></ul>
			</div>
			<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
			<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/epsilonews.json?callback=twitterCallback2&amp;count=5"></script>
		</div>		
		

	
		<div class="sideitem">
			<h6>Frequently Asked Question</h6>
			<ul>
				<a href="faq/#<?=$faq_id?>"><?=$random_faq+1?>. <?=$faq_title?></a>
			</ul>
 		</div>
		
		<div class="sideitem">
			<h6>Incubation</h6>
			<div align="center"><a href="/projects/what-is-incubation.php"><img align="center" src="images/egg-incubation.png" border="0" alt="Incubation" /></a></div>
 		</div>
		
		<!--
		<div class="sideitem">
			<h6>Used in...</h6>
			<center>
			<div id="users" class="slideshow" style="width:100%; height:100%"></div>
			<a href="usedin.php">more...</a>
			</center>
		</div>	
		-->
		
		<div class="sideitem">
			<?=r2h("Updates", "news/epsilonNewsArchive.rss", array(' '), 6, 5, 2000)?>
		</div>
		
	</div>

<?
	include('stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link rel='stylesheet' type='text/css' href='slideshow/css/slideshow.css' media='screen' />");
	$App->AddExtraHtmlHeader("<link rel='alternate' type='application/rss+xml' title='Epsilon News' href='news/epsilonNewsArchive.rss'>");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
