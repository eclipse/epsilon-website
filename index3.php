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
	$epsilonnews = get_epsilonnews(6);
		
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
				'slideshow/images/HUTN.png': { caption: 'Construct your models with the OMG HUTN' }, 
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

	<script type="text/javascript">		
	//<![CDATA[
	  window.addEvent('domready', function(){
	    var data2 = { 
	      		'users/Modelplex.png' : {},
	      		'users/York.png' : {},
	      		'users/Nasa.png' : {},
	      		'users/Surrey.png' : {},
	      		'users/Telefonica.png' : {},
	      		'users/Upv.png' : {},
	      		'users/Ssei.png' : {},
	      		'users/Lancaster.png' : {},
	      		'users/Modelware.png' : {},
	      		'users/WesternGeco.png' : {},
	      		'users/Concordia.png' : {},
	      		'users/Tud.png' : {}
	      		
	    };
	    var myShow2 = new Slideshow('users', data2, {captions: false, controller: false, height: 106, thumbnails: false, width: 160, delay:2000});
	  });
	//]]>
	</script>
		
	<!-- Middle part -->
	<div id="midcolumn" style="width:75%">
		<table width="100%">
			<tr>
				<td width="80%">
					<h1>$pageTitle</h1>
					<!--h3>Welcome</h3-->
				      <p>
						Epsilon is a metamodel-agnostic component that supports model navigation, 
						creation, and modification operations<!--a href="about.new.php">(more...)</a-->.
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
								<b><a href="doc/">Documentation</a></b>, 
								<b><a href="http://epsilonlabs.wiki.sourceforge.net/Book/">Book</a></b>
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
									<b><a href="cinema/">Cinema (Screencasts)</a></b>
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
									<b><a href="http://epsilonblog.wordpress.com">Blog</a></b>
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
					            <a href="http://www.eclipse.org/newsportal/thread.php?group=eclipse.epsilon">Web Interface</a>, 
					            <a href="http://wiki.eclipse.org/index.php/Webmaster_FAQ#How_do_I_access_the_Eclipse_newsgroups.3F">How do I access the newsgroup?</a> <br><br>
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
	<div id="rightcolumn" style="width:20%">
		
		<div class="sideitem">
			<h6>Incubation</h6>
			<div align="center"><a href="/projects/what-is-incubation.php"><img align="center" src="/images/egg-incubation.png" border="0" alt="Incubation" /></a></div>
 		</div>
		
		<div class="sideitem">
			<h6>Getting Started</h6>
			<ul>
				<li><a href="cinema">Watch the screencasts</a></li>
				<li><a href="download.php"><b>Download</b></a></li>
				<li><a href="http://epsilonlabs.wiki.sourceforge.net/Book/">Read the book</a></li>
				<li><a href="http://epsilonblog.wordpress.com">Follow the blog</a></li>
				<li><a href="news://news.eclipse.org/eclipse.epsilon">Drop by the newsgroup</a> <a href="http://wiki.eclipse.org/index.php/Webmaster_FAQ#How_do_I_access_the_Eclipse_newsgroups.3F">(how?)</a></li>
			</ul>
		</div>									
		
		<div class="sideitem">
			<h6>Used in...</h6>
			<center>
			<div id="users" class="slideshow" style="width:100%; height:100%"></div>
			<a href="users/disclaimer.php">more...</a>
			<!--
			<br>
			<a href="http://www.ohloh.net/stack_entries/new?project_id=8615&ref=sample"><img src="images/iuseit.png"/></a>
			<br>
			<br>
			<hr style="border:1px solid #CCCCCC">
			<a href="http://www.eclipseplugincentral.com/Web_Links-index-req-ratelink-lid-842.html">Rate @ EclipsePluginCentral</a>
			<br>
			<br>
			<form method="post" action="http://www.eclipseplugincentral.com/Web_Links.html">
			<table align="center" border="0" cellspacing="0" cellpadding="0">
			<tr><td>
			<table border="0" cellspacing="0" cellpadding="0" align="center">
			<tr><td valign="top">
			<select name="rating">
			<option>--</option>
			<option selected>10</option>
			<option>9</option>
			<option>8</option>
			<option>7</option>
			<option>6</option>
			<option>5</option>
			<option>4</option>
			<option>3</option>
			<option>2</option>
			<option>1</option>
			</select>
			</td><td valign="top">
			<input type="hidden" name="ratinglid" value="842">
			<input type="hidden" name="ratinguser" value="outside">
			<input type="hidden" name="req" value="addrating">
			<input type="submit" value="Vote">
			</td></tr></table>
			</td></tr></table>
			</form>
			<br>
			-->
			</center>
		</div>	
		
		<div class="sideitem">
			<h6>Visitors</h6>
			<center>
			<a href="http://www4.clustrmaps.com/user/50849c1d">
				<img src="http://www4.clustrmaps.com/stats/maps-no_clusters/www.eclipse.org-gmt-epsilon-thumb.jpg" />
			</a>
			</center>
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
