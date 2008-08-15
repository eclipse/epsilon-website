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
			<img src="../../resources/images/new.gif"><a href="http://epsilonlabs.svn.sourceforge.net/svnroot/epsilonlabs/org.eclipse.epsilon.book/EpsilonBook.pdf" target="blank">Languages documentation</a>:
			We have launched an effort to put together a PDF e-book that provides a complete reference of all the individual languages
			provided by Epsilon. Like Epsilon, the book is also open-source. You can access the LaTeX sources using the instructions provided
			<a href="http://epsilonlabs.wiki.sourceforge.net/Subversion">here</a>. 
			Any feedback on omissions, errors or out-dated content is always highly appreciated!
		</p>
		
		<p>
			<a href="mdd-tif-epsilon.pdf" target="blank">A complete case study using Epsilon</a>:
			This article demonstrates how languages and tools from Epsilon have been used to implement
			the <a href="http://www.dsmforum.org/events/MDD-TIF07/InteractiveTVApps.pdf" target="blank">Interactive TV Applications</a> 
			case study proposed by the organizers of the Model-Driven Development Tools Implementers Forum 
			(<a href="http://www.dsmforum.org/events/MDD-TIF07/" target="blank">MDD-TIF 2007</a>).
			<i>(The complete source code and models/metamodels used in the case study will be soon available in the <a href="examples.php">examples section</a>.
			Until then, a temporary compressed archive can be found <a href="http://www-users.cs.york.ac.uk/~dkolovos/epsilon/mdd-tif/TVApps.zip">here</a>)</i>
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
			<a href="EpsilonProfilingTools.pdf">Profiling Tools Documentation</a>: Provides instructions for using
			Epsilon Profiling Tools to measure the performance of model management operations implemented using languages
			of the Epsilon component (EOL, EML, EVL, ETL etc.)
		</p>
		
		<p> 
			<a href="EpsilonTools.pdf">Epsilon <i>Tools</i> Documentation</a>: Provides instructions for defining and using
			Epsilon <i>Tools</i>. <i>Tools</i> are user-defined Java classes that can be used from programs in Epsilon languages,
			to implement functionality that the languages do not inherently support (e.g. sophisticated string comparison, database connectivity etc)
			
		</p>

		<p> 
			<img src="../../resources/images/new.gif"><a href="ems07gmf-ewl.pdf">GMF EWL Wizards</a>: Provides an overview of the GMF-EWL integrations
			that enables users to define custom wizards (i.e. macros/scripts) to automate common modelling tasks in the context of GMF-based editors.
			Important features include support for existing GMF-based editors without needing to re-generate or customize them in any way, support for user-input, 
			and for undoing/redoing the effects of a wizard on the edited model
		</p>
		
		<p> 
			<img src="../../resources/images/new.gif"><a href="http://dev.eclipse.org/viewcvs/indextech.cgi/org.eclipse.gmt/epsilon/examples/EglDoc/EglDoc.pdf">Generating documentation for Ecore metamodels</a>:
			 Provides instructions for using an EGL-based tool for generating Javadoc-like HTML documentation for Ecore metamodels. 
		</p>
		
		<p>
			<a href="Exeed"></a>
			<a href="Exeed.pdf">Exeed</a>: 
			Exeed is an extension of the built-in reflective EMF editor that enables customizing
			labels and icons without generating a dedicated tree-based editor for each
			.ecore metamodel
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
				<img src="../../resources/images/new.gif">
				Dimitrios S. Kolovos, Richard F. Paige, Fiona A.C. Polack. <a href="#">Aligning OCL with
				Domain-Specific Languages to Support Instance-Level Model Queries</a>
				to appear in Electronic Communications of the EASST, 2007
			</p>
			<p>
				<img src="../../resources/images/new.gif">
				Boris Gruschko, Dimitrios S. Kolovos, Richard F. Paige. 
				<a href="#">Towards Synchronizing Models with Evolving Metamodels</a>, to appear in
				Workshop on Model-Driven Software Evolution (MODSE 2007), 
				11th European Conference on Software Maintenance and Reengineering, Amsterdam, the Netherlands
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
