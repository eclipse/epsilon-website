<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'

	#*****************************************************************************
	#
	# template.php
	#
	# Author: 		Freddy Allilaire
	# Date:			2006-05-29
	#
	# Description: Type your page comments here - these are not sent to the browser
	#
	#
	#****************************************************************************
	
	#
	# Begin: page-specific settings.  Change these. 
	$pageTitle 		= "Examples";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../common.php');
	include ('SyntaxHighlight.php');
	ob_start();
	
	# Create a parser and parse the examples.xml document.
	$examples = simplexml_load_file("examples.xml")->example;
	
	$currentExampleName = strip_tags($_REQUEST['example']);
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
	
?>
	
	
	<div id="midcolumn">
		<?include('../noscript.html')?>
		<h1>Example: <?=$example["title"]?></h1><br>
	<div id="TabbedPanels1" class="TabbedPanels">	
		<ul class="TabbedPanelsTabGroup" style="margin:0">	
			<?foreach ($example->file as $file){?>
			<li class="TabbedPanelsTab" style="list-style: none; margin:0;margin-right:1px;font-size:12px;padding:5px" tabindex="0">
				<?
				$path = $file["name"];
				$slashIndex = strrpos($path, '/');
				if ($slashIndex > -1) {
					$name = substr($path, $slashIndex + 1);
				}
				else {
					$name = $path;
				}
				?><?=$name?>
			</li>
			<?}?>
			<?foreach ($example->metamodel as $file){?>
			<li class="TabbedPanelsTab" style="list-style: none; margin:0;margin-right:1px;font-size:12px;padding:5px" tabindex="0"><?=$file["name"]?></li>
			<?}?>
			<li class="TabbedPanelsTab" style="list-style: none; margin:0;margin-right:1px;font-size:12px;padding:5px" tabindex="0">Get it!</li>
		</ul>
		<div class="TabbedPanelsContentGroup">
	    <?foreach ($example->file as $file){?>
			<div class="TabbedPanelsContent" style="font-family:Courier;height:520px;overflow:scroll">
			<?
				$url = Epsilon::getSVNExamplesLocation();
				$url = $url.$example["src"];
				$url = $url."/".$file["name"];
			?>
			<?if ($file["image"] == "true"){?>
				<img src="<?=$url?>"/>
			<?}else{?>
				<?	
					$content = '';
					if ($fp = fopen($url, 'r')) {
					 // keep reading until there's nothing left 
					 while ($line = fread($fp, 1024)) {
							$content .= $line;
					 }
					} else {
						 $content = "Unavailable"; 	
					}
				?>
				<?=highlight($content, getExtension($url))?>
			<?}?>
			</div>
			<?}?>
<?foreach ($example->metamodel as $file){?>
			<div class="TabbedPanelsContent" style="font-family:Courier;height:520px;overflow:scroll">
			<?
				$url = Epsilon::getSVNExamplesLocation();
				$url = $url."org.eclipse.epsilon.examples.metamodels";
				$url = $url."/".$file["name"];
				$content = '';
				if ($fp = fopen($url, 'r')) {
			   // keep reading until there's nothing left 
			   while ($line = fread($fp, 1024)) {
			      $content .= $line;
			   }
				} else {
				   $content = "Unavailable"; 	
				}
			?>
			<?=highlight($content, "emf")?>
			</div>
			<?}?>
			<div class="TabbedPanelsContent" style="height:520px; margin:5px">
			<p>
			There are two ways to get the code of this example:
			<ol>
				<li>download the following zip archive(s), extract them and import them as new Eclipse projects
					<ul>
						<li><a href="getit.php?example=<?=$example["src"]?>"><?=$example["src"]?>.zip</a>
						<?if ($example["standalone"] == "false"){?>
						<li><a href="getit.php?example=org.eclipse.epsilon.examples.metamodels">org.eclipse.epsilon.examples.metamodels.zip</a>
						<?}?>
						<?foreach ($example->project as $project){?>
						<li><a href="getit.php?example=<?=$project["src"]?>"><?=$project["src"]?>.zip</a>
						<?}?>
					</ul>					
				</li>
				<li><b>or</b> check out the code from the SVN
					<ul>
						<li> go to the <a href="../doc/articles/epsilon-source-svn/">SVN repository</a> 
						<li> navigate to <b>trunk/examples</b>
						<?if ($example["standalone"] == "false"){?>
						<li> check out the <b>org.eclipse.epsilon.examples.metamodels</b> project
						<?}?>
						<li> check out the <b><?=$example["src"]?></b> project
						<?foreach ($example->project as $project){?>
						<li> check out the <b><?=$project["src"]?></b> project
						<?}?>
					</ul>
				</li>
			</ol>
			<?if (!($example["runnable"] == "false")){?>
			<p>Once you have checked out/imported the code, to run the example you need to go through the following steps:
			<ol>
				<?if ($example["standalone"] == "false"){?>
				<li> register all .ecore metamodels in the <b>org.eclipse.epsilon.examples.metamodels</b> project (select all of them and then right click and select <b>Register EPackages</b>)
				<?}?>
				<li> register any .ecore metamodels in the <b><?=$example["src"]?></b> project
				<li> right click the .launch file in the <b><?=$example["src"]?></b> project
				<li>select <b>Run as...</b> and click the first item in the menu that pops up

			</ol>
			<?}?>
			</div>
	  </div>
	</div>
	</div>	

	<div id="rightcolumn">
	
	<div class="sideitem">
	<h6>What's this?</h6>
	<div class="modal">
	<p>
		<?=$example->description?>
	</p>
	</div>
	</div>
	
	<div class="sideitem">
	<h6>What are .emf files?</h6>
	<div class="modal">
	<p>
		.emf files are Ecore metamodels expressed using the <a href="../doc/articles/emfatic">Emfatic</a> textual syntax.
	</p>
	</div>
	</div>
	
	<div class="sideitem">
	<h6>More examples...</h6>
		<div class="modal">
		<ul>
		<?
			foreach ($examples as $example) {
		?>
		<li><a href="index.php?example=<?=$example["src"]?>"><?=$example["title"]?></a>
		<?}?>
		</ul>
		</div>
	</div>
	
	<div class="sideitem">
		<h6>Even more examples...</h6>
		<div class="modal">
		<p> More examples are available in the <a href="<?=Epsilon::getSVNExamplesLocation()?>">examples</a> folder of 
		the SVN repository.</p>
		</div>
	</div>
	
	</div>
	
	<script type="text/javascript">
	<!--
	var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
	//-->
	</script>
<?
	include('../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<script src='SpryTabbedPanels.js' type='text/javascript'></script>");
	$App->AddExtraHtmlHeader("<link href='SpryTabbedPanels.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>