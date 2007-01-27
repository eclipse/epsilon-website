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
	$epsilonnews = get_epsilonnews(5);
		
	# Paste your HTML content between the EOHTML markers!	
	$html = <<<EOHTML

	<!-- Middle part -->
	<div id="midcolumn">
		<table width="100%">
			<tr>
				<td width="80%">
					<h1>$pageTitle</h1>
					<h3>Welcome</h3>
				      <p align="JUSTIFY">
						Epsilon is a metamodel-agnostic component for supporting model navigation, creation, and modification operations.<?="..."?>

<!--				      	The Epsilon component aims at building a framework for supporting the construction of domain-specific languages and tools for 
				      	model management tasks, i.e., model merging, model comparison, inter- and intra-model consistency checking, text generation, 
				      	etc. It will provide a metamodel-agnostic approach that supports model management tasks for any kind of metamodel and model 
				      	instances.
-->
				      	<br /><br /><a href="about.php">more about Epsilon &raquo;</a>
				      </p>
		  		</td>
				<td align="right">
					<img align="right" src="resources/epsilonlogo.png" valign="top" alt="Epsilon Logo" />
				</td>
			</tr>
		</table>
		
		<hr/>
		
		<div class="homeitem">
			<h3>Quick Navigator</h3>
			<ul>
				<li>
					<table width="100%">
						<tr>
							<td width="80%" valign="bottom">
								<b><a href="news://news.eclipse.org/eclipse.modeling.gmt">Newsgroup</a></b>,
					            <a href="http://www.eclipse.org/search/search.cgi">Search</a>,
					            <a href="http://www.eclipse.org/newsportal/thread.php?group=eclipse.modeling.gmt">Web Interface</a>
		  					</td>
							<td align="right">
								<a href="news://news.eclipse.org/eclipse.modeling.gmt"><img align="right" src="../resources/images/news.gif" valign="top"/></a>
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
								<span><b><a href="doc/examples.php">Examples</a></b><img align="left" src="../resources/images/new.gif" valign="top"/></span>
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
								<b><a href="http://dev.eclipse.org/viewcvs/index.cgi/org.eclipse.gmt/epsilon/?root=Technology_Project">CVS</a></b>
		  					</td>
							<td align="right">
								<a href="http://dev.eclipse.org/viewcvs/index.cgi/org.eclipse.gmt/epsilon/?root=Technology_Project"><img align="right" src="../resources/images/cvs.gif" valign="top"/></a>
							</td>
						</tr>
					</table>
				</li>

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
			<h6>Getting Started</h6>
			<ul>
				<li><a href="about.php">Project description</a></li>
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

EOHTML;


	# Generate the web page
	$App->AddExtraHtmlHeader("<link rel='alternate' type='application/rss+xml' title='Epsilon News' href='news/epsilonNewsArchive.rss'>");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
