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
	include_once("dom4php/XmlParser.php");
	$parser   = new XmlParser($encoding = 'ISO-8859-1'); # encoding is optional
	$document = $parser->parse(file_get_contents("faqs.xml"));
	$faqs = $document->getElementsByTagName("faq");
	$random_faq = rand(0,count($faqs)-1);
	$faq = $faqs[$random_faq];
	$faq_title = $faq->getOneChild("title")->childNodes[0]->data;
	$faq_answer = $faq->getOneChild("answer")->childNodes[0]->data;
	
	$parser   = new XmlParser($encoding = 'ISO-8859-1'); # encoding is optional
	$document = $parser->parse(file_get_contents("http://dev.eclipse.org/newslists/news.eclipse.epsilon/maillist.rss"));
	$guid = $document->getOneChild("rss")->getOneChild("channel")->getOneChild("item")->getOneChild("guid")->childNodes[0]->data;
	
	$messages = (int) substr($guid, 65, strlen($guid) - 69) + 2;
	
	ob_start();
	?>
	

	<script type="text/javascript" src="slideshow/js/mootools.js"></script>
	<script type="text/javascript" src="slideshow/js/slideshow.js"></script>
	
	<script type="text/javascript">		
	//<![CDATA[
	  window.addEvent('domready', function(){
	    var data = {
						'slideshow/images/Eugenia.png': { caption: 'Generate a GMF editor from your ECore metamodel with EuGENia', href: 'cinema'},
				'slideshow/images/EVL.png': { caption: 'Write constraints for your ECore metamodel with EVL', href: 'cinema' },
				'slideshow/images/EVL-GMF.png': { caption: '... and see the errors/warnings in your GMF editor', href: 'cinema' },
				'slideshow/images/EWL.png': { caption: 'Write wizards for your metamodel with EWL', href: 'cinema' },
				'slideshow/images/InvokeWizard.png': { caption: '... invoke them in your GMF editor', href: 'cinema' },
				'slideshow/images/InvokedWizard.png': { caption: '... and see the results live in your editor', href: 'cinema' },
	      		'slideshow/images/EOL.png': { caption: 'Query and modify your models with EOL', href: 'cinema' }, 
	      		'slideshow/images/Native.png': { caption: 'Call Java code from all Epsilon languages', href: 'cinema' },
				'slideshow/images/RegistryView.png': { caption: 'Explore the registered EMF EPackages', href: 'cinema' }, 
				'slideshow/images/Exeed.png': { caption: 'Customize icons and labels in the reflective EMF editor', href: 'cinema' }, 
				'slideshow/images/HUTN.png': { caption: 'Construct your models with the OMG HUTN', href: 'cinema' }, 
				'slideshow/images/EGL.png': { caption: 'Generate text from your models with EGL', href: 'cinema' },
	      		'slideshow/images/ETL.png': { caption: 'Transform your models with ETL', href: 'cinema' },
				'slideshow/images/ECL.png': { caption: 'Compare your models with ECL', href: 'cinema' },
				'slideshow/images/EML.png': { caption: 'Merge your models with EML', href: 'cinema' },
				'slideshow/images/ANT.png': { caption: 'Create complex workflows using the Epsilon ANT tasks', href: 'cinema' }
	    };
	    var myShow = new Slideshow('show', data, {captions: true, controller: false, height:281, width:495, thumbnails: false, delay:4000});
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
		<h1><?=$pageTitle?></h1>
					<!--h3>Welcome</h3-->
	    <img style="float:right" src="resources/epsilonlogo.png" alt="Epsilon Logo" />
			<p>Epsilon is a metamodel-agnostic component that supports programmatic creation, navigation, 
			and modification of EMF models<br> <a href="examples">(see a quick example...)</a></p>
	     

		
		<div class="homeitem">
			<h2>What can you do with Epsilon?</h2>
			<div id="show" class="slideshow" style="width:495px">
				
			</div>
		</div>
		
		<div class="homeitem">
			<?=r2h("Recent articles in the blog", "blogrss.xml", array(' '))?>
		</div>
		
		<div class="homeitem">
			<?=r2h("Recent newsgroup activity", "http://dev.eclipse.org/newslists/news.eclipse.epsilon/maillist.rss", array('epsilon'))?>
		</div>
		
		<?
		//include('blognews.static.php');
		?>
		
	</div>
	

	
	<!-- Right Part -->
	<div id="rightcolumn">


		
		<div class="sideitem">
			<h6 nostyle="background-color:#36354F;color:white">Getting Started</h6>
			<ol>
				<li><a href="cinema">Watch the screencasts</a></li>
				<li><a href="examples">Go through the examples</a></li>
				<li><a href="live">Run EOL in your browser</a><font style="color:red"><b><i> (new!)</i></b></font>
				<li><a href="download.php"><b>Download</b></a></li>
				<li><a href="http://epsilonlabs.svn.sourceforge.net/svnroot/epsilonlabs/org.eclipse.epsilon.book/EpsilonBook.pdf">Get the book</a></li>
				<li><a href="http://epsilonblog.wordpress.com">Visit the blog</a></li>
				<li><a href="news://news.eclipse.org/eclipse.epsilon">Get help in the newsgroup</a>
				<ul>
					<li><a href="http://www.eclipse.org/newsportal/thread.php?group=eclipse.epsilon">Browse <?=$messages?> previous posts</a>
					<li><a href="http://wiki.eclipse.org/index.php/Webmaster_FAQ#How_do_I_access_the_Eclipse_newsgroups.3F">Find out how to connect</a>
				</ul>
				</li>
				<li><a href="spreadtheword.php">Spread the word</a><font style="color:red"><b><i> (new!)</i></b></font>
			</ol>
		</div>
		
		<div class="sideitem">
			<h6>Get The Book</h6>
			<div align="center"><a href="http://epsilonlabs.svn.sourceforge.net/svnroot/epsilonlabs/org.eclipse.epsilon.book/EpsilonBook.pdf"><img align="center" src="images/book.png" border="0" alt="Incubation" /></a></div>
 		</div>
	
		<div class="sideitem">
			<h6>Frequently Asked Question</h6>
			<ul>
				<a href="faq.php#<?=$faq_title?>"><?=$random_faq+1?>. <?=$faq_title?></a>
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
			<h6>Visitors</h6>
			<center>
			<a href="http://www4.clustrmaps.com/user/50849c1d">
				<img src="http://www4.clustrmaps.com/stats/maps-no_clusters/www.eclipse.org-gmt-epsilon-thumb.jpg" />
			</a>
			</center>
		</div>
		
		<div class="sideitem">
			<?=r2h("Updates", "http://www.eclipse.org/gmt/epsilon/news/epsilonNewsArchive.rss", array('Version'), 6)?>
		</div>
		
	</div>

<?
	include('stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link rel='alternate' type='application/rss+xml' title='Epsilon News' href='news/epsilonNewsArchive.rss'>");
	$App->AddExtraHtmlHeader("<link rel='stylesheet' type='text/css' href='slideshow/css/slideshow.css' media='screen' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
