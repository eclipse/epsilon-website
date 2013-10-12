<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Epsilon Wizard Language');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Epsilon Wizard Language</h1>

		<div class="row">
			<div class="span8">
				<p>EWL is a language tailored to interactive in-place model transformations on user-selected model elements (unlike <a href="../etl">ETL</a> which operates in a batch mode). EWL is particularly useful for automating recurring model editing tasks (e.g. refactoring, applying patterns or constructing subtrees consisting of similar elements). EWL is integrated with EMF/GMF and as such, wizards can be executed from within EMF and GMF editors</p>
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Execute wizards within EMF and GMF editors
					<li>Define guards in wizards
					<li>Undo/redo the effects of wizards on the model
					<li><a href="https://bugs.eclipse.org/bugs/show_bug.cgi?id=358199">Access the domain and the notation models at the same time</a> (<a href="http://dev.eclipse.org/svnroot/modeling/org.eclipse.epsilon/trunk/examples/org.eclipse.epsilon.eugenia.examples.flowchart.extensions/flowchart.ewl">example</a>)
				</ul>
			</div>
		</div>

		<?=eolFeatures()?>

		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="../../cinema/#GMFWizards2">Screencast: Specifying and executing wizards in the UML2 class diagram editor</a>
					<li><a href="../ems07gmf-ewl.pdf">Article: Bridging the Epsilon Wizard Language and the Eclipse Graphical Modeling Framework</a>
					<li><a href="http://epsilonblog.wordpress.com/2008/01/18/model-refactoring-in-gmf-based-editors-with-ewl/">Article: Model Refactoring in GMF editors</a>
					<li><a href="http://epsilonblog.wordpress.com/2008/03/16/model-refactoring-in-emf-editors/">Article: Model Refactoring in EMF editors</a>
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>Chapter 7 of the <a href="../book">Epsilon book</a> provides a complete reference of the syntax and semantics of EWL.</p>
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