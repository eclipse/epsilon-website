<?php

/*
 Include the epsilon class (allows for static calls)
 The assumption is that the main template and the Epsilon class file
 are always in the main Epsilon directory on the server.
 The Epsilon class can then be used in every template file.
*/
include_once('epsilon.php');

// set the path to the templates directory
$dirTemplate = 'templates/';

function h($title = '', $css = array()) {
	global $dirTemplate;

	$tplTitle = $title;
	// get the title
	if(strlen($tplTitle) < 1) {
		$tplTitle = getTitle();
	}

	// prepare styles
	$tpl_styles = '';
	if(is_array($css)) {
		foreach($css as $style) {
			$tpl_styles .= $style."\n";
		}
		// remove the last newline character
		$tpl_styles = substr($tpl_styles, 0, -1);
	}

	include_once($dirTemplate.'header.tpl'); // the menu is automatically included
}

function f($js = array()) {
	global $dirTemplate;

	$tplScripts = '';
	// prepare scripts
	if(is_array($js)) {
		foreach($js as $script) {
			$tplScripts .= $script."\n";
		}
		// remove the last newline character
		$tplScripts = substr($tplScripts, 0, -1);
	}

	include_once($dirTemplate.'footer.tpl');
}

/*
 This function infers the page title from the file path.
 Currently it takes the name of only the first directory
 inside the main one (e.g. epsilon/cinema becomes
 Epsilon - Cinema) but can easily be extended.
*/
function getTitle() {
	$main = Epsilon::getRelativeLocation('');
	$script = dirname($_SERVER['SCRIPT_NAME']);
	$title = substr($script, strlen($main));
	if(strlen($title) < 1) {
		$title = 'Epsilon';
	} else {
		$parts = explode('/', $title);
		$title = 'Epsilon - '.ucfirst($parts[1]);
	}
	return $title;
}

/*
 This function returns the HTML code to start a sidebar element.
 If you do not need a title, leave it blank or set it to null.
 By setting fixed to true the sidebar element will not scroll with
 the website.
*/
function sB($title = '', $fixed = false) { ?>
	<div class="row">
		<? if(!$fixed) { ?>
		<div class="span4">
		<? } else { ?>
		<div class="span4 affix">
		<? } ?>
			<div class="well">
				<? if(strlen($title) > 0) { ?>
					<h4><?= $title ?></h4>
				<? } ?>
<?php }

/*
 This function returns the HTML code to close a sidebar element.
*/
function sE() { ?>
			</div>
		</div>
	</div>
<?php }
?>
