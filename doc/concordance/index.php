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

		</div>
		<div class="row">
			
			<div class="span8">
				<div class="alert alert-error alert-block">
					<b>Warning</b>: Concordance is no longer actively maintained and will be archived in the near future. Please consider using <a href="https://www.eclipse.org/hawk/">Eclipse Hawk</a> instead.
				</div>
				<p>Concordance is a tool that monitors selected projects of the workspace and maintains an index of cross-resource EMF references. Concordance can then use this index to automatically reconcile references when models are moved, and report broken references when models are updated/deleted.
				For a detailed presentation of Concordance, please refer to <a href="http://link.springer.com/chapter/10.1007%2F978-3-642-13595-8_20">this paper</a>.</p>
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