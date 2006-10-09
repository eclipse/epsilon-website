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
	$pageTitle 		= "About Epsilon";
	$pageKeywords	= "";
	$pageAuthor		= "Freddy Allilaire";
	
	# End: page-specific settings
	#
		
	# Paste your HTML content between the EOHTML markers!	
	$html = <<<EOHTML

	<!-- Main part -->
	<div id="midcolumn">
		<h1>$pageTitle</h1>

		<h3>Scope of the Epsilon subproject</h3>
		<img alt="Epsilon Logo" src="resources/epsilonlogo.png" valign="top" style="padding-left: 10px;" align="right">
        <p align="justify">
      		The Epsilon component aims at building a framework for supporting the construction of domain-specific languages and tools for model 
      		management tasks, i.e., model merging, model comparison, inter- and intra-model consistency checking, text generation, etc. It will 
      		provide a metamodel-agnostic approach that supports model management tasks for any kind of metamodel and model instances.
      	</p>
      	<hr class="clearer" />
      	
		<p>
		The Epsilon component will provide the basis for building integrated domain-specific model management languages and tools:
		<ul>
			<li>an executable language for model navigation and modification, called the Epsilon Object Language</li>
			<li>an extensible virtual machine for execution of EOL programs</li>
			<li>directions and documentation to explain how to use the language and virtual machine for building integrated task-specific languages</li>
			<li>a suite of integrated, task-specific languages, with tool support, for model management. These language and tools are all based on EOL 
			and share common facilities and tools, and currently consist of: the Epsilon Merging Language (EML) for model merging, i.e., integrating 
			two or more models of arbitrary metamodels into a consistent, coherent single model; Epsilon Transformation Language (ETL) for transforming 
			models (re-used in EML); Epsilon Comparison Language (ECL), for comparing models of arbitrary metamodels (re-used in EML)</li>
		</ul>
		</p>
		<p>
			We emphasise that the Epsilon component consists of not only the core language, EOL, and its tools, but also the integrated task-specific 
			languages, which support each other. For example, the transformation and comparison languages are both used within EML.
		</p>
		<p>
		The Epsilon component will focus on supporting those aspects needed in the context of general model management, including:
		<ul>
			<li>A metamodel-independent mechanism for navigating models and identifying model elements of interest. This mechanism will be executable and 
			declarative, and where possible will be closely aligned with the Object Constraint Language (OCL) standard.</li>
			<li>A metamodel-independent means for modifying models and model elements, in order to help support update and deletion tasks for model management.</li>
			<li>A metamodel-independent mechanism for creating and reading models.</li>
			<li>Fundamental operations for loading and serialising models.</li>
			<li>Ease of use: An easy-to-use interface</li>
      	</ul>
      	</p>
      	<hr class="clearer" />

		<h3>Epsilon code availability / initial contribution</h3>
		<p>
		At this time, code has been developed that supports parsing, checking, editing, and execution of the Epsilon Object Language, which supports
		model navigation and modification. Currently, these are deployed as separate Eclipse plug-in components, which run within Eclipse. The parser
		and run-time may also be used independently of Eclipse.
		</p>
		<p>
		The following code is ready for submission to an Eclipse Epsilon component:
		<ul>
			<li>A parser and virtual machine for the model navigation and modification language (the Epsilon Object Language).</li>
			<li>The Epsilon Merging Language, for specifying merging rules, along with a virtual machine for executing rules.</li>
			<li>The Epsilon Transformation Language, for specifying transformation rules, along with a virtual machine for executing rules.</li>
			<li>The Epsilon Comparison Language, for specifying comparison rules, along with a virtual machine for executing rules.</li>
		</p>
		<p>
		An initial user guide, installation guide and examples will also be made available. An online tutorial will also be provided for getting started.
		</p>
      	<hr class="clearer" />

		<h3>Epsilon Architecture Overview</h3>

		<p>
		The informal architecture of the Epsilon platform is depicted below.
		</p>
		<p>
		<div align="center"><img src="resources/epsilonArchitecture.png" /></div>
		</p>

		<p>
		The core of the platform is the Epsilon Object Language (EOL) which provides a metamodel agnostic layer for navigating, querying, 
		and modifying models. EOL reuses part of the OCL language but does not completely conform to the OCL 2.0 standard. New, domain-specific 
		languages (e.g., ETL, EML, a MOF 2.0 Action Semantics language, ...) are defined on top of EOL and reuse its facilities for navigating and 
		modifying models.
		</p>
		
		<p>Initial support has been provided for MOF (MDR) models, EMF models, and XML models, but additional models will be investigated.</p>
		
		<p>The Epsilon Merging Language (EML) is a recent addition to the Epsilon component. The overall design of the EML language, and its tool
		support, is illustrated below.</p>

		<p>
		<div align="center">
			<a href="resources/emlLanguage.png">
				<img src="resources/emlLanguage.png" width="100%" height="100%" />
			</a>
		</div>
		</p>
		
 		<p>The EML engine applies to an EML specification, defined in terms of a number of rules. These rules make use of EOL for comparison and model 
 		navigation. The context in which rules are executed is also supplied via EOL.</p>

		<p>Screenshots of the EML editor and the EML launch configuration are provided below.</p>

		<p>
		<div align="center">
			<a href="resources/emlToolScreenshot.png">
				<img src="resources/emlToolScreenshot.png" width="100%" height="100%" />
			</a>
		</div>
		</p>

		<p>The Epsilon binaries are available for download; please see the descriptions at 
		<a href="http://www.cs.york.ac.uk/~dkolovos/epsilon">http://www.cs.york.ac.uk/~dkolovos/epsilon</a></p>

		<h3>Epsilon community</h3>
		<p>Epsilon was developed in a community at the University of York, UK, supported and tested by the European Integrated Project MODELWARE 
		(IST Project 511731). We will continue development of Epsilon in the context of MODELWARE�s successor project, MODELPLEX, which started 
		September 2006. MODELPLEX will provide the necessary time and resources to ensure a continuity of development in the subproject.</p>
		<p>We will encourage user communities to use the technology and contribute to improvement through feedback. We will also encourage user 
		and external developers to contribute examples, reusable transformations, and code.</p>
		<p>We aim to involve users and developers through publicity in publications, conferences, and presentations. We are also using Epsilon in 
		lecturing at the University of York in courses in model-driven development and language design, and will make our teaching material available 
		to lecturers and instructors worldwide.
		</p>
      	<hr class="clearer" />
      	
	</div>

EOHTML;


	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
