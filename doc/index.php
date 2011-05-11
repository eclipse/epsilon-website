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
		<p>At the core of Epsilon is the <a href="eol">Epsilon Object Language (EOL)</a>, an imperative model-oriented language that combines the procedural style of Javascript with the powerful model querying capabilities of OCL.</p>
		
		<h4>Task-Specific Languages</h4>
		
		<p>Epsilon also provides several task-specific languages, which use EOL as an expression language. Each task-specific language provides constructs and syntax that are tailored to the specific task. The task-specific languages provided by Epsilon are:</p>
		
		<ul>
		
		<li><a href="etl">Epsilon Transformation Language (ETL)</a>: A rule-based model-to-model transformation language that supports transforming many input to many output models, rule inheritance,  lazy and greedy rules, and the ability to query and modify both input and output models.
		
		<li><a href="evl">Epsilon Validation Language (EVL)</a>: A model validation language that supports both intra and inter-model consistency checking, constraint dependency management and specifying fixes that	users can invoke to repair identified inconsistencies. EVL is integrated with EMF/GMF and as such, EVL constraints can be evaluated from within EMF/GMF editors and generate error markers for failed constraints.
		
		<li><a href="egl">Epsilon Generation Language (EGL)</a>: A template-based model-to-text language for generating code, documentation and other textual artefacts from models. EGL supports content-destination decoupling, protected regions for mixing generated with hand-written code and template coordination.
		
		<li><a href="ewl">Epsilon Wizard Language (EWL)</a>: A language tailored to interactive in-place model transformations on model elements selected by the user. EWL is integrated with EMF/GMF and as such, wizards can be executed from within EMF and GMF editors.
		
		<li><a href="ecl">Epsilon Comparison Language (ECL)</a>: A rule-based language for discovering  correspondences (matches) between elements of models of diverse metamodels.
		
		<li><a href="eml">Epsilon Merging Language (EML)</a>: A rule-based language for merging models of diverse metamodels, after first identifying their correspondences with <a href="ECL">ECL</a> (or otherwise).
		
		<li><a href="flock">Epsilon Flock</a>: A rule-based transformation language for updating models in response to metamodel changes.</li> 
		
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
		
		<li><a href="hutn">Human Usable Textual Notation</a>: An implementation of the OMG standard for representing models in a human understandable format. HUTN allows models to be
	    written using a text editor in a C-like syntax.</li>
		
		<li><a href="concordance">Concordance</a>: Concordance is a tool that monitors selected projects of the workspace and maintains an index of cross-resource EMF references. Concordance can then use this index to automatically reconcile references when models are moved, and report broken references when models are updated/deleted. 

		<li><a href="eunit">EUnit</a>: EUnit is a unit testing framework specialized on testing model management tasks, such as model-to-model transformations, model-to-text transformations or model validation. It is based on Epsilon, but it can be used for model technologies external to Epsilon. Tests are written by combining an EOL script and an <a href="workflow">ANT</a> buildfile.</li>		
		</ul>
		
		<h4>Resources</h4>
		<ul>
			<li><a href="http://epsilonblog.wordpress.com/2007/11/15/positioning-epsilon-in-the-mdd-landscape/">Article: Positioning Epsilon in the MDD landscape</a>
			<li><a href="http://epsilonblog.wordpress.com/2007/11/11/a-brief-history-of-epsilon/">Article: A brief history of Epsilon</a>
		</ul>
		
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
