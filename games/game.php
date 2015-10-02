<?php
	require_once('../template.php');
	require_once('../util.php');
	require_once('util.php');

	$gameId = isset($_REQUEST['game']) ? strip_tags($_REQUEST['game']) : "";
	$cheat = isset($_REQUEST['cheat']) ? strip_tags($_REQUEST['cheat']) : "false";

	$game = simplexml_load_file($gameId."/game.xml");

	$levelId = isset($_REQUEST['level']) ? strip_tags($_REQUEST['level']) : 1;
	$answer = isset($_REQUEST['answer']) ? strip_tags($_REQUEST['answer']) : "";
	$wrongAnswer = false;
	$correctAnswer = "";
	$levelCount = count($game->level);

	if ($levelId > 1) {
		$levelId = min($levelId, $levelCount+1);
		$previousLevel = $game->level[$levelId - 2];
		$correctAnswer = trim($previousLevel->answer);
		if (strcmp($correctAnswer,$answer)!=0 && strcmp($cheat,"true")!=0) {
			$wrongAnswer = true;
			$levelId = $levelId-1;
		}
	}

	$metamodel = $game["metamodel"]."?version=".$game["version"];
	$model = $game["model"]."?version=".$game["version"];
	$emfatic = $game["emfatic"];

	$level = $game->level[$levelId-1];

	h();
?>
<div class="row" id="iewarning">
	<div class="span12">
	<div class="alert alert-info" style1="font-weight:normal; background-color: rgb(214,238,247); color: rgb(24,136,173); border-color: rgb(181,233,241)">
		Like any decent web application, this game does not work on Internet Explorer.
    </div>
    </div>
</div>
<script>
if (navigator.userAgent.indexOf("MSIE") == -1) {
	document.getElementById("iewarning").style.display = 'none';
}
</script>
<div class="row">
	<!-- main part -->
	<?if ($levelId <= $levelCount){?>

	<div class="span7">
		<legend><?=$game["name"]?></legend>
		<p><?=$game->description?></p>
	</div>
	<div class="span5">
		<form action="/epsilon/games/game.php" method="get">
  			<fieldset>
  				<?if ($levelId < $levelCount){?>
  				<legend>Level <?=$levelId?> of <?=$levelCount?></legend>
  				<?}else{?>
  				<legend>Final level</legend>
  				<?}?>

  				<p>
  					<?=$level->description?>
  				</p>
				<label><b><?=$level->question?></b></label>
				<div class="control-group">
					<div class="controls">
	  				<div class="input-append">
	  					<input type="hidden" name="level" value="<?=$levelId+1?>"/>
						<input type="hidden" name="game" value="<?=$gameId?>"/>
						<input class="span4" name="answer" type="text" placeholder="Find the answer using EOL and type it here.">
					 	<button class="btn" type="submit">Go!</button>
				 	</div>
				 	<?if ($wrongAnswer){?>
				 	<div class="alert alert-error">Wrong answer. Please try again.</div>
				 	<?}?>
				 	</div>
			 	</div>
			</fieldset>
		</form>
	</div>
	</div>
	<div class="row">
			<div class="span7">
				<div class="tabbable" style="margin-bottom: 0px;">
					<ul class="nav nav-tabs">
					    <li class="active"><a href="#editor" data-toggle="tab"><h4>Model Explorer</h4></a></li>
					    <li><a href="#solution" data-toggle="tab"><h4>Solution</h4></a></li>
					</ul>
				</div>
				<div class="tab-content">
  					<div id="editor" class="tab-pane active">
						<iframe src="https://epsiloncloud.appspot.com/embedded.jsp?source=<?=urlencode(str_replace("\t", "  ", trim($level->hint)))?>&button=search&compact=1&metamodel=<?=urlencode($metamodel)?>&model=<?=urlencode($model)?>" frameborder="0" scrolling="no" style="height:600px;width:100%"></iframe>
					</div>
					<div id="solution" class="tab-pane">
						<div class="alert alert-info">
						Copy and paste the solution below into the Model Explorer and click on the magnifying glass to reveal the answer.
						</div>
						<pre class="prettyprint lang-eol"><?=str_replace("\t", "  ", trim(htmlentities($level->solution)))?></pre>
					</div>
				</div>
			</div>

			<div class="span5">
				<div class="tabbable" style="margin-bottom: 0px;">
					<ul class="nav nav-tabs">
					    <li class="active"><a href="#metamodel" data-toggle="tab"><h4>Metamodel</h4></a></li>
					</ul>
				</div>
				<div class="tab-content">
	  				<div id="metamodel" class="tab-pane active">
	  				<?
	  					$content = readEmfaticContent($emfatic, $levelId, $levelCount);
					?>
					<pre class="prettyprint lang-emf"><?=$content?></pre>
	  				</div>
				</div>
			</div>

		<?}else{?>
		<div class="span12">
		<h1>Well done!</h1>
		You can now download the <a href="<?=$metamodel?>">metamodel</a> and the <a href="<?=$model?>">model</a> of
		<?=$game["name"]?> and practice more with EOL <a href="/epsilon/download">offline</a>!
		</div>
		<?}?>
</div>

<?f(array(
		'<script>
			prettyPrint();
		</script>'
	));?>
