<?php
	require_once('../template.php');
	require_once('../util.php');
	
	// Create a parser and parse the examples.xml document.
	$categories = simplexml_load_file("examples.xml")->category;
	
	// Collect all examples by visiting all leaf nodes
	$examples = array();
	foreach ($categories as $category) {
		foreach ($category->example as $example) {
			array_push($examples, $example); 
		}
	}	
	
	$currentExampleName = isset($_REQUEST['example']) ? strip_tags($_REQUEST['example']) : null;
	$example = null;
	$exampleIndex = 0;
	
	if ($currentExampleName) {
		$i = 0;
		foreach ($examples as $ex) {
			$i++;
			if ($ex["src"] == $currentExampleName) {
				$example = $ex;
				$exampleIndex = $i;
				break;
			}
		}
	}
	else {
		$example = $examples[0];
		$exampleIndex = 1;
	}
	h();
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Example: <?=$example["title"]?></h1>

		<!-- first row of content -->
		<div class="row">
			
			<div class="span8">
			<?if ($example["interim"] == "true"){?>
				<div class="alert alert-info alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					This example uses features which are only available in the <a href="../download">latest interim version</a> of Epsilon.
				</div>
			<?} else if ($example["interim"] == "false"){?>
				<div class="alert alert-info alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					This example uses features which are only available if you are running Epsilon from the latest version of its source code.
				</div>
			<?}?>
			</div>
		
			<div class="span8 tabbable">
				<ul class="nav nav-tabs">
  					<?php
  					$i = 1;
  					foreach ($example->file as $file){
  						$path = $file["name"];
						$slashIndex = strrpos($path, '/');
						if ($slashIndex > -1) {
							$name = substr($path, $slashIndex + 1);
						}
						else {
							$name = $path;
						}
  						if($i < 2) { ?>
  							<li class="active"><a href="#tab<?=$i?>" data-toggle="tab"><?=$name?></a></li>
  						<? } else {?>
  							<li><a href="#tab<?=$i?>" data-toggle="tab"><?=$name?></a></li>
  						<? }
  						$i++;
  					}
  					foreach ($example->metamodel as $file){
  						if($i < 2) { ?>
  							<li class="active"><a href="#tab<?=$i?>" data-toggle="tab"><?=$file["name"]?></a></li>
  						<? } else {?>
  							<li><a href="#tab<?=$i?>" data-toggle="tab"><?=$file["name"]?></a></li>
  						<? }
						$i++;
  					} ?>
  					<li><a href="#tab<?=$i?>" data-toggle="tab">Get it!</a></li>
				</ul>

				<div class="tab-content">
					<?php
						$i = 1;
						foreach ($example->file as $file){
							if($i < 2) { ?>
								<div class="tab-pane active" id="tab<?=$i?>">
							<? } else { ?>
								<div class="tab-pane" id="tab<?=$i?>">
							<? }
							$url = Epsilon::getSVNExamplesLocation();
							$url = $url.$example["src"];
							$url = $url."/".$file["name"];
							if ($file["image"] == "true"){ ?>
								<img src="<?=$url?>"/>
							<? } else {
								$content = readUrlContent($url);
							?>
							<pre class="prettyprint lang-<?=getFileExtension($file["name"])?>"><?=$content?></pre>
							<?}?>
						</div>
					<? $i++;} ?>
					<?foreach ($example->metamodel as $file){?>
					<? if($i < 2) { ?>
						<div class="tab-pane active" id="tab<?=$i?>">
					<? } else { ?>
						<div class="tab-pane" id="tab<?=$i?>">
					<? } ?>
					<?
						$url = Epsilon::getSVNExamplesLocation();
						$url = $url."org.eclipse.epsilon.examples.metamodels";
						$url = $url."/".$file["name"];
						$content = readUrlContent($url);
					?>
						<pre class="prettyprint lang-<?=getFileExtension($file["name"])?>"><?=$content?></pre>
					</div>
					<? $i++; }?>
					<div class="tab-pane" id="tab<?=$i?>">
						<p>
						   Clone Epsilon's Git repository:
							<ul>
								<li> navigate to <strong>trunk/examples</strong>
								<?if ($example["standalone"] == "false"){?>
								<li> import the <strong>org.eclipse.epsilon.examples.metamodels</strong> project
								<?}?>
								<li> import the <strong><?=$example["src"]?></strong> project
								<?foreach ($example->project as $project){?>
								<li> import the <strong><?=$project["src"]?></strong> project
								<?}?>
							</ul>
						</p>
						<?if (!($example["runnable"] == "false")){?>
						<p>Once you have checked out/imported the code, to run the example you need to go through the following steps:
						<ol>
							<?if ($example["standalone"] == "false"){?>
							<li> register all .ecore metamodels in the <strong>org.eclipse.epsilon.examples.metamodels</strong> project (select all of them and then right click and select <strong>Register EPackages</strong>)
							<?}?>
							<li> register any .ecore metamodels in the <strong><?=$example["src"]?></strong> project
							<li> right click the .launch file in the <strong><?=$example["src"]?></strong> project
							<li>select <strong>Run as...</strong> and click the first item in the menu that pops up

						</ol>
						</p>
						<?}?>
					</div>

				</div>
			</div>
		</div>
		<!-- end first row of content -->

	</div>	
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		<!-- first element -->
		<? sB('What\'s this?'); ?>
					<p><?=$example->description?></p>
		<? sE(); ?>
		<!-- end first element -->

		<? sB('What are .emf files?'); ?>
					<p>
						.emf files are Ecore metamodels expressed using the <a href="../doc/articles/emfatic">Emfatic</a> textual syntax.
					</p>
		<? sE(); ?>

		<? sB('More examples...'); ?>
					<? foreach ($categories as $category) { ?>
						<h5><?=$category["title"]?></h5>
						<ul>
						<? foreach ($category->example as $example) { ?>
							<li><a href="index.php?example=<?=$example["src"]?>"><?=$example["title"]?></a>
						<?}?>
						</ul>
					<? } ?>
		<? sE(); ?>

		<? sB('Even more examples...'); ?>
					<p> More examples are available in the <a href="<?=Epsilon::getSVNExamplesLocation()?>">examples</a> folder of the Git repository.</p>
		<? sE(); ?>

	</div>
	<!-- end sidebar -->
</div>
<?php
	f(array(
		'<script>
			prettyPrint();
		</script>'
	));
?>