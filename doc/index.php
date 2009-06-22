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
	$pageTitle 		= "Documentation";
	$pageKeywords	= "";
	$pageAuthor		= "Freddy Allilaire";
	include ('../common.php');
	include ('tools.php');
	ob_start();
	?>

<!-- Main part -->
	<div id="midcolumn">
		<h1><?=$pageTitle?></h1>
		
		<img style="float:right;padding:10px" src="http://dev.eclipse.org/huge_icons/apps/accessories-text-editor.png"/>
		
		<p>Epsilon provides a family of metamodel-agnostic languages for creating, querying and modifying  EMF (<a href="emc">and other types of</a>) models in various ways.</p> 
		<p>At the core of Epsilon is the <a href="eol">Epsilon Object Language (EOL)</a>, an imperative model-oriented language that combines the procedural style of Javascript with the powerful model querying capabilities of OCL. Epsilon also provides several task-specific languages, which use EOL as an expression language. Each task-specific language provides constructs and syntax that are tailored to the specific task.</p> 
		
		<p>The task-specific languages provided by Epsilon are:</p>
		
		<ul>
		
		<li><a href="etl">Epsilon Transformation Language (ETL)</a>: A rule-based model-to-model transformation language that supports transforming many input to many output models, rule inheritacne,  lazy and greedy rules, and the ability to query and modify both input and output models.
		
		<li><a href="evl">Epsilon Validation Language (EVL)</a>: A model validation language that supports both intra and inter-model consistency checking, constraint dependency management and specifying fixes that	users can invoke to repair identified inconsistencies. EVL is integrated with EMF/GMF and as such, EVL constraints can be evaluated from within EMF/GMF editors and generate error markers for failed constraints.
		
		<li><a href="egl">Epsilon Generation Language (EGL)</a>: A template-based model-to-text language for generating code, documentation and other textual artefacts from models. EGL supports content-destination decoupling, protected regions for mixing generated with hand-written code and template coordination.
		
		<li><a href="ewl">Epsilon Wizard Language (EWL)</a>: A language tailored to interactive in-place model transformations on model elements seleted by the user. EWL is integrated with EMF/GMF and as such, wizards can be executed from within EMF and GMF editors.
		
		<li><a href="ecl">Epsilon Comparison Language (ECL)</a>: A rule-based language for discovering  correspondences (matches) between elements of models of diverse metamodels.
		
		<li><a href="eml">Epsilon Merging Language (EML)</a>: A rule-based language for merging models of diverse metamodels, after first identifying their correspondences with <a href="ECL">ECL</a> (or otherwise).
		
		</ul>
		
		<h4>Tools</h4>
		
		<img style="float:right" src="http://dev.eclipse.org/huge_icons/categories/preferences-system.png"/>
		<p>Apart from the languages above, Epsilon also contains several smaller tools and utilities.</p>
		
		<ul>
		
		<li><a href="eugenia">EuGENia</a>: EuGENia is a front-end for GMF. Its aim is to speed up
		the process of developing a GMF editor and lower the entrance barrier for new developers.
		To this end, EuGENia enables developers to generate a fully-functional GMF editor only by specifying
		a few high-level annotations in the Ecore metamodel.
		
		<li><a href="exeed">Exeed</a>: Exeed is an enhanced version of the built-in EMF reflective
		tree-based editor that enables developers to customize the labels and icons of model elements
		simply by attaching a few simple annotations to the respective EClasses in the Ecore metamodel.
		Exeed also supports setting the values of references using drag-and-drop instead of using the
		combo boxes in the properties view.
		
		<li><a href="modelink">ModeLink</a>: ModeLink is an editor consisting of 2-3 side-by-side EMF
		tree-based editors, and is very convenient for establishing (weaving) links 
		between different models using drag-and-drop.
		
		<li><a href="workflow">Workflow</a>: Epsilon provides a set of ANT tasks to enable developers
		assemble complex workflows that involve both MDE and non-MDE tasks. 
		
		<li><a href="concordance">Concordance</a>: Concordance is a tool that monitors selected projects and maintains and index of cross-resource EMF references. Concordance can automatically reconceile relative paths in references when models are moved and report broken references when models are updated/deleted. 
		
		</ul>
		
		<h4>Resources</h4>
		<ul>
			<li><a href="http://epsilonblog.wordpress.com/2007/11/15/positioning-epsilon-in-the-mdd-landscape/">Article: Positioning Epsilon in the MDD landscape</a>
			<li><a href="http://epsilonblog.wordpress.com/2007/11/11/a-brief-history-of-epsilon/">Article: A brief history of Epsilon</a>
		</ul>
		
		<!--li><a href="concordance">Concordance</a>: Concordance is a toolkit that records and maintains
		cross-model references in a consistent state when EMF models are moved in the workspace. -->
		
		<!--
		
		<h3>Installing Epsilon</h3>
		
		<p>
			Please see the <a href="../download.php">downloads</a> page for instructions on how to install Epsilon.
		</p>
		
		<h3>Technical Documents</h3>
		
		<p> 
			<a href="http://epsilonlabs.wiki.sourceforge.net/EuGENia">EuGENia</a>: A tutorial for the 
			EuGENia tool which can be used to develop GMF-based editors with minimal effort. A screencast
			demonstrating EuGENia is available <a href="../cinema/Eugenia.htm">here</a>.
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
		
		-->
	</div>

	<div id="rightcolumn">
	<?=toolsSideItem()?>
	</div>
<?
	include('../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
