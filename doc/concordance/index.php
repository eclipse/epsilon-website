<?php
	require_once('../../template.php');
	require_once('../tools.php');
	h('Concordance');
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Concordance</h1>

		<div class="row">
			<div class="span8">
				<img src="http://dev.eclipse.org/huge_icons/categories/applications-development.png" alt="" class="pull-right">
				<p>Concordance is a tool that monitors selected projects of the workspace and maintains an index of cross-resource EMF references. Concordance can then use this index to automatically reconcile references when models are moved, and report broken references when models are updated/deleted.</p>
		<p>Concordance is the newest part of Epsilon and its API is still volatile. We plan to have a first stable version of the API accompanied by exemplar tools in early 2010. Check back soon or drop by the <a href="../../forum">forum</a> for more details.</p>
			</div>
		</div>

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		
		<?= toolsSideItem('concordance') ?>
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>