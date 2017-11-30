<?php
	require_once('../template.php');
	require_once('tools.php');
	h('Documentation');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Documentation</h1>

		<div class="row">
			<div class="span8">
				<!--img class="pull-right" src="http://dev.eclipse.org/huge_icons/apps/accessories-text-editor.png" alt=""-->
				
				<p>Epsilon is a family of languages and tools for code generation, model-to-model transformation, model validation, comparison, migration and refactoring that work out-of-the-box with EMF <a href="emc">and other types of</a> of models.</p>

				<p>At the core of Epsilon is the <a href="eol">Epsilon Object Language (EOL)</a>, an imperative model-oriented language that combines the procedural style of Javascript with the powerful model querying capabilities of OCL.</p>
				<p></p>

				<?include "architecture.php";?>

				<!--img src="epsilon-architecture.png" style="padding-top:10px"/-->
			</div>

		</div>

		<h3>Task-Specific Languages</h3>
		<div class="row">
			<div class="span8">
				<p>Epsilon provides several task-specific languages, which use EOL as an expression language. Each task-specific language provides constructs and syntax that are tailored to the specific task. The task-specific languages provided by Epsilon are:</p>
		
				<ul>
					<li><a href="etl">Epsilon Transformation Language (ETL)</a>: A rule-based model-to-model transformation language that supports transforming many input to many output models, rule inheritance,  lazy and greedy rules, and the ability to query and modify both input and output models.
					<li><a href="evl">Epsilon Validation Language (EVL)</a>: A model validation language that supports both intra and inter-model consistency checking, constraint dependency management and specifying fixes that	users can invoke to repair identified inconsistencies. EVL is integrated with EMF/GMF and as such, EVL constraints can be evaluated from within EMF/GMF editors and generate error markers for failed constraints.
					<li><a href="egl">Epsilon Generation Language (EGL)</a>: A template-based model-to-text language for generating code, documentation and other textual artefacts from models. EGL supports content-destination decoupling, protected regions for mixing generated with hand-written code.
					<li><a href="egx">Epsilon EGL Coordination Language (EGX)</a>: A rule-based coordination language to execute specific EGL templates for a specific model element type, with the ability to guard rule execution and specify generation target location by type/element.
					<li><a href="ewl">Epsilon Wizard Language (EWL)</a>: A language tailored to interactive in-place model transformations on model elements selected by the user. EWL is integrated with EMF/GMF and as such, wizards can be executed from within EMF and GMF editors.
					<li><a href="ecl">Epsilon Comparison Language (ECL)</a>: A rule-based language for discovering  correspondences (matches) between elements of models of diverse metamodels.
					<li><a href="eml">Epsilon Merging Language (EML)</a>: A rule-based language for merging models of diverse metamodels, after first identifying their correspondences with <a href="ecl">ECL</a> (or otherwise).
                    <li><a href="epl">Epsilon Pattern Language (EPL)</a>: A pattern language for matching model elements based on element relations and characteristics.
					<li><a href="emg">Epsilon Model Generation Language (EMG)</a>: A language for semi-automated model generation.
					<li><a href="flock">Epsilon Flock</a>: A rule-based transformation language for updating models in response to metamodel changes.</li> 
				</ul>
			</div>
		</div>

		<h3>Tools</h3>
		<div class="row">
			<div class="span8">
				<!--img class="pull-right" src="http://dev.eclipse.org/huge_icons/categories/preferences-system.png" alt=""-->

				<p>In addition to the languages above, Epsilon also provides several tools and utilities for working with models.</p>
				<ul>
					<li>
						<a href="eugenia">EuGENia</a>: EuGENia is a front-end for GMF. Its aim is to speed up the process of developing a GMF editor and lower the entrance barrier for new developers. To this end, EuGENia enables developers to generate a fully-functional GMF editor only by specifying a few high-level annotations in the Ecore metamodel.
					</li>
					<li>
						<a href="exeed">Exeed</a>: Exeed is an enhanced version of the built-in EMF reflective tree-based editor that enables developers to customize the labels and icons of model elements simply by attaching a few simple annotations to the respective EClasses in the Ecore metamodel. Exeed also supports setting the values of references using drag-and-drop instead of using the combo boxes in the properties view.
					</li>
					<li>
						<a href="modelink">ModeLink</a>: ModeLink is an editor consisting of 2-3 side-by-side EMF tree-based editors, and is very convenient for establishing (weaving) links between different models using drag-and-drop.
					</li>
					<li>
						<a href="workflow">Workflow</a>: Epsilon provides a set of ANT tasks to enable developers assemble complex workflows that involve both MDE and non-MDE tasks.
					</li>
					<li>
						<a href="hutn">Human Usable Textual Notation</a>: An implementation of the OMG standard for representing models in a human understandable format. HUTN allows models to be written using a text editor in a C-like syntax.
					</li>
					<li>
						<a href="concordance">Concordance</a>: Concordance is a tool that monitors selected projects of the workspace and maintains an index of cross-resource EMF references. Concordance can then use this index to automatically reconcile references when models are moved, and report broken references when models are updated/deleted.
					</li>
					<li>
						<a href="eunit">EUnit</a>: EUnit is a unit testing framework specialized on testing model management tasks, such as model-to-model transformations, model-to-text transformations or model validation. It is based on Epsilon, but it can be used for model technologies external to Epsilon. Tests are written by combining an EOL script and an <a href="workflow">ANT</a> buildfile.
					</li>		
				</ul>
			</div>

		</div>

		<h3>Resources</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="http://epsilonblog.wordpress.com/2007/11/15/positioning-epsilon-in-the-mdd-landscape/">Article: Positioning Epsilon in the MDD landscape</a>
					<li><a href="http://epsilonblog.wordpress.com/2007/11/11/a-brief-history-of-epsilon/">Article: A brief history of Epsilon</a>
				</ul>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem() ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>
