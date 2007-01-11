<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'

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
	$pageTitle 		= "Epsilon Documentation";
	$pageKeywords	= "";
	$pageAuthor		= "Freddy Allilaire";
	
	# Paste your HTML content between the EOHTML markers!	
	$html = <<<EOHTML

<!-- Main part -->
	<div id="midcolumn">
		<table width="100%">
			<tr>
				<td width="50%">
					<h1>$pageTitle</h1>
				</td>
				<td align="right">
					<img alt="Epsilon Logo" src="../resources/epsilonlogo.png" valign="top" />
				</td>
			</tr>
		</table>

		<h3>Documentation</h3>
		
		<p>
			<b>Languages documentation</b> In Epsilon, documentation has been implemented as a 
			plugin of the Eclipse Help system. Thus, documentation about the languages is available
			from within Eclipse
		</p>
		
		<p>
			<a href="PluginInstallation.pdf">Installing the Epsilon Plug-ins</a>: Provides instructions for
			installing the Epsilon plug-ins
		</p>
		
		<p>
			<a href="EpsilonCVS.pdf">Accessing the source code of Epsilon from CVS</a>: Provides instructions for setting up a local
			copy of the source code of Epsilon on your machine using Eclipse 3.2
		</p>
		
		<p>
			<a href="Epsilon-Project-Description.doc">Epsilon Project Plan</a>: Project plan of Epsilon component
		</p>
      	<hr class="clearer" />

		<h3>Publications on Epsilon</h3
			<p>
				Dimitrios S. Kolovos, Richard F. Paige and Fiona A.C. Polack. <a href="http://www.eclipsecon.org/summiteurope2006/presentations/ESE2006-EclipseModelingSymposium9_DevelopmentToolsforEpsilon.pdf">
				Epsilon Development Tools for Eclipse</a>, Eclipse
				Modeling Symposium, Eclipse Summit Europe 2006, Esslingen, Germany, 2006
			</p>
			<p>
				Dimitrios S. Kolovos, Richard F. Paige, and Fiona A.C. Polack. <a href="http://dx.doi.org/10.1007/11787044_11">The Epsilon Object Language (EOL)</a>,
				in Proc. European Conference in Model Driven Architecture (EC-MDA) 2006, Bilbao, Spain, July 2006.
			</p>
			<p>
				Dimitrios S. Kolovos, Richard F. Paige, and Fiona A.C. Polack. <a href="http://www-users.cs.york.ac.uk/~dkolovos/publications/models06-eml.pdf">Merging Models with the Epsilon Merging Language (EML)</a>,
				in Proc. ACM/IEEE 9th International Conference on Model Driven Engineering Languages and Systems (Models/UML 2006), Genova, Italy, October 2006.
			</p>
			<p>
				Dimitrios S. Kolovos, Richard F. Paige, and Fiona A.C. Polack. <a href="http://modelbased.net/ecmda-traceability/images/papers/2_dkolovos.traceability06.camera-ready.pdf">On-Demand Merging of Traceability Links with Models</a>,
				in Proc. 2nd EC-MDA Workshop on Traceability, Bilbao, Spain, July 2006.
			</p>
			<p>
				Dimitrios S. Kolovos, Richard F. Paige, and Fiona A.C. Polack. <a href="http://doi.acm.org/10.1145/1138304.1138308">Model Comparison: a Foundation
				for Model Composition and Model Transformation Testing</a>,
				in Proc. First International Workshop on Global Integrated Model
				Management (G@MMA) 2006, IEEE/ACM ICSE'06, Shanghai, China, May 2006.
			</p>
			<p>
				Dimitrios S. Kolovos, Richard F. Paige, and Fiona A.C. Polack.
				<a href="http://st.inf.tu-dresden.de/OCLApps2006/topic/acceptedPapers/06_Kolovos_InstanceLevel.pdf">Towards Using OCL for Instance-Level Queries in Domain Specific Languages</a>, 
				to appear in Proc. OCLApps 2006: OCL for (Meta-)Models in Multiple 
				Application Domains, Models/UML 2006, Genova, Italy, October 2006. 
			</p>
      		<hr class="clearer" />
	</div>

EOHTML;


	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
