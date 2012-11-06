<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Human Usable Textual Notation');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Human Usable Textual Notation</h1>

		<div class="row">
			<div class="span8">
				<p>HUTN is an OMG standard for storing models in a human understandable format. In a sense it is a human-oriented alternative to XMI; it has a C-like style which uses curly braces instead of the verbose XML start and end-element tags. Epsilon provides an implementation of HUTN which has been realized using ETL for model-to-model transformation, EGL for generating model-to-model transformations, and EVL for checking the consistency of HUTN models.</p>
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Write models using a text editor
					<li>Generic-syntax: no need to specify parser
					<li>Error markers highlighting inconsistencies
					<li>Resilient to metamodel changes
					<li>Built-in HUTN->XMI and XMI->HUTN transformations
					<li>Automated builder (HUTN->XMI)
				</ul>
			</div>
		</div>

		<h3>Examples and Screencasts</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="../articles/hutn-basic/">Article: Using the Human-Usable Textual Notation (HUTN) in Epsilon</a>
					<li><a href="../../cinema/#HUTN">Screencast: The Human Usable Textual Notation (HUTN)</a>
					<li><a href="http://epsilonblog.wordpress.com/2008/01/16/using-hutn-for-t2m-transformation/">Article: Using HUTN for T2M transformation</a>
					<li><a href="http://epsilonblog.wordpress.com/2008/09/15/new-in-hutn-071/">Article: New in HUTN 0.7.1</a>
					<li><a href="http://epsilonblog.wordpress.com/2009/04/27/managing-inconsistent-models-with-hutn/">Article: Managing Inconsistent Models with HUTN</a>
				</ul>
			</div>
		</div>

		<h3>Reference</h3>
		<div class="row">
			<div class="span8">
				<p>The OMG provides a <a href="http://www.omg.org/technology/documents/formal/hutn.htm">complete specification</a> of the HUTN syntax.</p>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem('hutn') ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>