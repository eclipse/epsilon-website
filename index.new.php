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
	$pageTitle 		= "Epsilon Home page";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	
	# Add page-specific Nav bars here
	# Format is Link text, link URL (can be http://www.someothersite.com/), target (_self, _blank), level (1, 2 or 3)
	# $Nav->addNavSeparator("My Page Links", 	"downloads.php");
	# $Nav->addCustomNav("My Link", "mypage.php", "_self", 3);
	# $Nav->addCustomNav("Google", "http://www.google.com/", "_blank", 3);

	# End: page-specific settings
	#
	
	include('../news/scripts/news.php');
	$epsilonnews = get_epsilonnews(10);
		
	# Paste your HTML content between the EOHTML markers!	
	$html = <<<EOHTML
	
	<link rel="stylesheet" type="text/css" href="slideshow/css/slideshow.css" media="screen" />
	<script type="text/javascript" src="slideshow/js/mootools.js"></script>
	<script type="text/javascript" src="slideshow/js/slideshow.js"></script>
	
	<script type="text/javascript">		
	//<![CDATA[
	  window.addEvent('domready', function(){
	    var data = {
	      		'slideshow/images/EOL.png': { caption: 'Query and modify your models with EOL' }, 
	      		'slideshow/images/RegistryView.png': { caption: 'Explore the registered EMF EPackages' }, 
				'slideshow/images/Exeed.png': { caption: 'Customize icons and labels in the reflective EMF editor' }, 
				'slideshow/images/HUTN.png': { caption: 'Compose your models with the OMG HUTN' }, 
				'slideshow/images/Eugenia.png': { caption: 'Generate a GMF editor from your ECore metamodel with EuGENia' },
				'slideshow/images/EVL.png': { caption: 'Write constraints for your ECore metamodel with EVL' },
				'slideshow/images/EVL-GMF.png': { caption: '... and see the errors/warnings in your GMF editor' },
				'slideshow/images/EWL.png': { caption: 'Write wizards for your metamodel with EWL' },
				'slideshow/images/InvokeWizard.png': { caption: '... invoke them in your GMF editor' },
				'slideshow/images/InvokedWizard.png': { caption: '... and see the results live in your editor' },
	      		'slideshow/images/EGL.png': { caption: 'Generate text from your models with EGL' },
	      		'slideshow/images/ETL.png': { caption: 'Transform your models with ETL' },
				'slideshow/images/ECL.png': { caption: 'Compare your models with ECL' },
				'slideshow/images/EML.png': { caption: 'Merge your models with EML' },
				'slideshow/images/Native.png': { caption: 'Call Java code from all Epsilon languages' },
				'slideshow/images/ANT.png': { caption: 'Create complex workflows using the Epsilon ANT tasks' }
	    };
	    var myShow = new Slideshow('show', data, {resize: 'length', captions: true, controller: true, height: 320, thumbnails: false, width: 510, delay:4000});
	  });
	//]]>
	</script>	
	
	<!-- Middle part -->
	<div id="midcolumn">
		<table width="100%">
			<tr>
				<td width="80%">
					<h1>$pageTitle</h1>
					<h3>Welcome</h3>
				      <p>
						Epsilon is a metamodel-agnostic component that supports model navigation, 
						creation, and modification operations <!--a href="about.new.php">(more...)</a-->.
				      </p>
		  		</td>
				<td align="right">
					<img align="right" src="resources/epsilonlogo.png" valign="top" alt="Epsilon Logo" />
				</td>
			</tr>
		</table>
		
		<div class="homeitem3col">
		
			<h3>What can you do with Epsilon?</h3>
			<table width="100%">
			<tr><td colspan=2>
			<br>
			<div style="position:relative;left:-50px" id="show" class="slideshow"></div>
			</td></tr>
			</table>
		</div>

		<hr class="clearer">
		
		<div class="homeitem">
			<h3>Quick Navigator</h3>
			<ul>
			
				<li>
					<table width="100%">
						<tr>
							<td width="80%" valign="bottom">
								<b><a href="download.php">Download</a></b>
		  					</td>
							<td align="right">
								<a href="download.php"><img align="right" src="../resources/images/download.gif" valign="top"/></a>
							</td>
						</tr>
					</table>
				</li>
			

				
				<li>
					<table width="100%">
						<tr>
							<td width="80%" valign="bottom">
								<b><a href="doc/">Documentation</a></b>
		  					</td>
							<td align="right">
								<a href="doc/"><img align="right" src="../resources/images/reference.gif" valign="top"/></a>
							</td>
						</tr>
					</table>
				</li>

				<li>
					<table width="100%">
						<tr>
							<td width="80%" valign="bottom">
								<div>
									<b><a href="cinema/">Cinema (Flash demos)</a></b>
								</div>
		  					</td>
							<td align="right">
								<a href="cinema/"><img align="right" src="images/cinema.gif" valign="top"/></a>
							</td>
						</tr>
					</table>
				</li>
				
				<li>
					<table width="100%">
						<tr>
							<td width="80%" valign="bottom">
								<div>
									<b><a href="doc/examples.php">Examples</a></b>
								</div>
		  					</td>
							<td align="right">
								<a href="doc/examples.php"><img align="right" src="../resources/images/reference.gif" valign="top"/></a>
							</td>
						</tr>
					</table>
				</li>
				
				<li>
					<table width="100%">
						<tr>
							<td width="80%" valign="bottom">
								<div>
									<b><a href="http://epsilonblog.wordpress.com">Blog</a></b><img align="left" src="../resources/images/new.gif" valign="top"/>
								</div>
		  					</td>
							<td align="right">
								<a href="http://epsilonblog.wordpress.com"><img align="right" src="images/wordpress.png" valign="top"/></a>
							</td>
						</tr>
					</table>
				</li>

				<li>
					<table width="100%">
						<tr>
							<td width="80%" valign="top">
								<b><a href="news://news.eclipse.org/eclipse.epsilon">Newsgroup</a></b>,
					            <a href="http://www.eclipse.org/search/search.cgi">Search</a>,
					            <a href="http://www.eclipse.org/newsportal/thread.php?group=eclipse.epsilon">Web Interface</a> <br><br>
		  					</td>
							<td align="right">
								<a href="news://news.eclipse.org/eclipse.epsilon"><img align="right" src="../resources/images/news.gif" valign="top"/></a>
							</td>
						</tr>
					</table>
				</li>
				
				<li>
					<table width="100%">
						<tr>
							<td width="80%" valign="bottom">
								<div>
									<b><a href="https://bugs.eclipse.org/bugs/buglist.cgi?product=gmt&component=Epsilon&cmdtype=doit&order=Reuse+same+sort+as+last+time">Bugs</a></b>,
									<a href="https://bugs.eclipse.org/bugs/enter_bug.cgi?product=GMT&component=Epsilon">Report a bug</a>
								</div>
		  					</td>
							<td align="right">
								<a href="https://bugs.eclipse.org/bugs/buglist.cgi?product=gmt&component=Epsilon&cmdtype=doit&order=Reuse+same+sort+as+last+time"><img align="right" src="../resources/images/bugzilla.gif" valign="top"/></a>
							</td>
						</tr>
					</table>
				</li>
				
				
				<li>
					<table width="100%">
						<tr>
							<td width="80%" valign="bottom">
								<b><a href="http://dev.eclipse.org/viewsvn/index.cgi/?root=Modeling_EPSILON">SVN</a></b>
		  					</td>
							<td align="right">
								<a href="http://dev.eclipse.org/viewsvn/index.cgi/?root=Modeling_EPSILON"><img align="right" src="../resources/images/cvs.gif" valign="top"/></a>
							</td>
						</tr>
					</table>
				</li>
				<!--
				<li>
					<table width="100%">
						<tr>
							<td width="80%" valign="bottom">
								<b><a href="contributors.php">Contributors</a></b>
		  					</td>
							<td align="right">
								<a href="contributors.php"><img align="right" src="images/contributors.png" valign="top"/></a>
							</td>
						</tr>
					</table>
				</li>
				-->
				<li>
					<table width="100%">
						<tr>
							<td width="100%" valign="bottom">
								<a href="http://www4.clustrmaps.com/user/50849c1d"><img src="http://www4.clustrmaps.com/stats/maps-no_clusters/www.eclipse.org-gmt-epsilon-thumb.jpg" />
								</a>							
							</td>
						</tr>
					</table>
				</li>
				<!--
				<li>
					<table width="100%">
						<tr>
							<td width="80%" valign="bottom">
								<b><a href="previews.php">Previews</a></b>
		  					</td>
							<td align="right">
								<a href="previews.php"><img align="right" src="images/comingup.png" valign="top"/></a>
							</td>
						</tr>
					</table>
				</li>
				-->							
			</ul>
		</div>
		
		<div class="homeitem">
			$epsilonnews
		</div>
		<hr class="clearer" />
	</div>
	

	
	<!-- Right Part -->
	<div id="rightcolumn">
		
		<div class="sideitem">
			<h6>Incubation</h6>
			<div align="center"><a href="/projects/what-is-incubation.php"><img align="center" src="/images/egg-incubation.png" border="0" alt="Incubation" /></a></div>
 		</div>
		
		<div class="sideitem">
			<h6>Getting Started</h6>
			<ul>
				<li><a href="about.new.php">Project description</a></li>
				<li><a href="doc/">Documentation</a></li>
			</ul>
		</div>									

	</div>

	<!-- Start of StatCounter Code -->
	<script type="text/javascript" language="javascript">
	var sc_project=2185757; 
	var sc_invisible=1; 
	var sc_partition=5; 
	var sc_security="2d5ff082"; 
	</script>
	
	<script type="text/javascript" language="javascript" src="http://www.statcounter.com/counter/counter.js"></script><noscript><a href="http://www.statcounter.com/" target="_blank"><img  src="http://c6.statcounter.com/counter.php?sc_project=2185757&java=0&security=2d5ff082&invisible=1" alt="free web hit counter" border="0"></a> </noscript>
	<!-- End of StatCounter Code -->

	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
	</script>
	<script type="text/javascript">
	_uacct = "UA-1498421-2";
	urchinTracker();
	</script>

EOHTML;


	# Generate the web page
	$App->AddExtraHtmlHeader("<link rel='alternate' type='application/rss+xml' title='Epsilon News' href='news/epsilonNewsArchive.rss'>");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
