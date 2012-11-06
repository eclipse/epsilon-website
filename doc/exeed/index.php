<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Exeed');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Exeed</h1>

		<div class="row">
			<div class="span8">
				<p>Exeed is an enhanced version of the built-in EMF reflective tree-based editor that enables developers to customize the labels and icons of model elements simply by attaching a few simple annotations to the respective EClasses in the Ecore metamodel. Exeed also supports setting the values of references using drag-and-drop instead of using the combo boxes in the properties view. In combination with <a href="../modelink">ModeLink</a>, Exeed editors can be used to weave two models using a third <em>weaving model</em>.</p>
			</div>
		</div>

		<h3>Features</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li>Customize the appearance of nodes in the reflective tree editor without generating a dedicated editor</li>
					<li>Specify the label and icon of each node using <a href="../eol">EOL</a></li>
					<li>Labels and icons can reflect the status of an element (e.g. different icon depending on whether a property is true/false)</li>
				</ul>
			</div>
		</div>

		<h3>Resources</h3>
		<div class="row">
			<div class="span8">
				<ul>
					<li><a href="../articles/exeed-reference">Article: Exeed annotation reference</a>
					<li><a href="../articles/inspect-models-exeed">Tutorial: Inspecting EMF models with Exeed</a>
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