<?php
	require_once('../template.php');
	$projects = simplexml_load_file("../data/open-source-users.xml")->project;	
	$companies = simplexml_load_file("../data/industry-users.xml")->company;
	$institutions = simplexml_load_file("../data/institutions.xml")->institution;
		
	h();
?>

<div class="row">
	<!-- main part -->
	<div class="span12">
		<h1 class="page-header">Who is using Epsilon?</h1>

		<div class="row">
			<div class="span12">

				<div class="tabbable" style="margin-bottom: 0px;">
				  <ul class="nav nav-tabs">
				  	<li><a href="#projects" data-toggle="tab"><h4>Open-source projects</h4></a></li>
				   	<li class="active"><a href="#industry" data-toggle="tab"><h4>Industry</h4></a></li>
				  	<li><a href="#teaching" data-toggle="tab"><h4>Teaching</h4></a></li>
				   </ul>
				    <div class="tab-content">
				    	<div id="projects" class="tab-pane">
					    	<p>
								Below are <?=count($projects)?> open-source projects that are using languages and tools provided by Epsilon. 
								If you'd like your project to appear here or you've spotted any outdated content, please <a href="mailto:epsilon.devs@gmail.com">let us know</a>.<br/><br/>
							</p>	
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
  						<div id="industry" class="tab-pane active">
  							<p> Below is a list of companies for which there are publicly-available indications of engagement with Epsilon (including bug reports, forum messages, blog posts, tweets and published articles*). 
  								If you'd like to report additional uses of Epsilon in industry or you've spotted any outdated content, please <a href="mailto:epsilon.devs@gmail.com">let us know</a>.
  							</p>

  							<?foreach($companies as $company){?>
  							<img src="logos/<?=$company["logo"]?>" style="padding:15px;"/>
  							<?}?>
  							<br/><br/>

  							* Based on the following sources:
							<?foreach($companies as $company) {?>
								<?
									$evidenceHtml = "";
									$evidenceItems = $company->evidence;
									for ($i=0; $i < count($evidenceItems); $i++) {
										$evidenceHtml .= "<a href='".$evidenceItems[$i]."'>".($i+1)."</a>";
										if ($i < count($evidenceItems) - 1) {
											$evidenceHtml .= ", ";
										}
									}
								?>
								<a href="<?=$company["url"]?>"><?=$company["name"]?></a> (<?=$evidenceHtml?>), 
							<?}?>
  						</div>
						<div id="teaching" class="tab-pane active">
  							<p> Below is a list of institutions that use one or more components of Epsilon (e.g. EGL, Eugenia) as part of their modelling/MDE courses*. 
  								If you'd like to report additional uses of Epsilon in taught courses or you've spotted any outdated content, please <a href="mailto:epsilon.devs@gmail.com">let us know</a>.
  							</p>

  							<?foreach($institutions as $institution){?>
  							<img src="logos/<?=$institution["logo"]?>" style="padding:15px;"/>
  							<?}?>
  							<br/><br/>

  							* Based on the following sources:
							<?foreach($institutions as $institution) {?>
								<?
									$evidenceHtml = "";
									$evidenceItems = $institution->evidence;
									for ($i=0; $i < count($evidenceItems); $i++) {
										$evidenceHtml .= "<a href='".$evidenceItems[$i]."'>".($i+1)."</a>";
										if ($i < count($evidenceItems) - 1) {
											$evidenceHtml .= ", ";
										}
									}
								?>
								<a href="<?=$institution["url"]?>"><?=$institution["name"]?></a> (<?=$evidenceHtml?>), 
							<?}?>
  						</div>  						
  					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?f();?>