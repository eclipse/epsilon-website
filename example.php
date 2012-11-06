<?php
	require_once('../template.php');
	h();
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Page header</h1>

		<!-- first row of content -->
		<div class="row">
			<div class="span8">
				Content goes here
			</div>
		</div>
		<!-- end first row of content -->

		<!-- row of content with a picture -->
		<div class="row">
			<div class="span8">
				<img class="pull-right" src="" alt="">
				Content goes here
			</div>
		</div>
		<!-- end row of content with a picture -->

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		<!-- first element -->
		<div class="row">
			<div class="span4">
				<div class="well">
					<h6>Sidebar header</h6>
					Sidebar content
				</div>
			</div>
		</div>
		<!-- end first element -->

	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>