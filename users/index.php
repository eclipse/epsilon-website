<?php
	require_once('../template.php');
	$projects = simplexml_load_file("../data/users.xml")->project;	
	h();
?>

<div class="row">
	<!-- main part -->
	<div class="span12">
		<h1 class="page-header">Who is using Epsilon?</h1>

		<div class="row">
			<div class="span12">

				<p>
					Below are <?=count($projects)?> open-source projects that are using languages and tools provided by Epsilon. 
					<!--Beyond open-source projects, we are also aware of several industrial projects that have successfuly used Epsilon
					but - as expected - little information about such projects can be made publicly available.--> If you'd like your project
					to appear here or you've spotted any outdated content, please <a href="mailto:epsilon.devs@gmail.com">let us know</a>.<br/><br/>
				</p>

				<div class="tabbable" style="margin-bottom: 0px;">
				  <ul class="nav nav-tabs">
				  	<li class="active"><a href="#projects" data-toggle="tab"><h4>Open-source projects</h4></a></li>
				   </ul>
				    <div class="tab-content">
				    	<div id="projects" class="tab-pane active">
						  <?$i=0;?>
						  <?foreach ($projects as $project){?>
						  <?if($i%2==0){?><div class="row" style="padding-bottom:20px"><?}?>
						  	<div class="span1">
						  		<img style="position:relative;top:10px;left:10px" src="../img/stylistica/star.png"> 
						  	</div>
						  	<div class="span5">
						  		<h5><a href="<?=$project->url?>"><?=$project["name"]?></a></h5><p><?=$project->description?></p>
						  	</div>
						  <?if($i%2==1){?></div><?}?>
						  <?$i++;?>
						  <?}?>
  						</div>
  					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?f();?>