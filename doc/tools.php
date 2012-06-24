<?

include_once ('../Epsilon.php');
include_once ('publications/PublicationsManager.php');

function toolsSideItem($tool="epsilon") {
	
	$parentPath = Epsilon::getParentPath();
	
	$html = PublicationsManager::getPublicationSideItem($tool);
	
	$html .= "<div class='sideitem'>\r\n";
	$html .= "  <h6>Languages</h6>\r\n";
	$html .= "	<div class='modal'><ul>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/eol")."'>Epsilon Object Language</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/etl")."'>Epsilon Transformation Language</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/evl")."'>Epsilon Validation Language</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/egl")."'>Epsilon Generation Language</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/ewl")."'>Epsilon Wizard Language</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/ecl")."'>Epsilon Comparison Language</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/eml")."'>Epsilon Merging Language</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/flock")."'>Epsilon Flock</a>\r\n";
	$html .= "	</ul></div>\r\n";
	$html .= "</div>\r\n";
	
	$html .= "<div class='sideitem'>\r\n";
	$html .= "  <h6>Tools</h6>\r\n";
	$html .= "	<div class='modal'><ul>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/eugenia")."'>EuGENia</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/exeed")."'>Exeed</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/modelink")."'>ModeLink</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/workflow")."'>Workflow</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/hutn")."'>Human Usable Textual Notation</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/concordance")."'>Concordance</a>\r\n";
	$html .= "	<li><a href='".Epsilon::getRelativeLocation("doc/eunit")."'>EUnit</a>\r\n";
	$html .= "	</ul></div>\r\n";
	$html .= "</div>\r\n";
	
	//$html .= seeAlsoSideItem();
	
	return $html;
}
/*
function seeAlsoSideItem() { 
	$html .= <<<SEEALSO
	<div class="sideitem">
	<h6>See also...</h6>
	<div class='modal'>
	<ul>
		<li><a href='<?=Epsilon::getRelativeLocation("doc")?>'>Documentation</a>
		<li><a href='<?=Epsilon::getRelativeLocation("doc/articles")?>'>Articles</a>		
		<li><a href='<?=Epsilon::getRelativeLocation("cinema")?>'>Screencasts</a>
		<li><a href='<?=Epsilon::getRelativeLocation("examples")?>'>Examples</a>
		<li><a href='<?=Epsilon::getRelativeLocation("doc/book")?>'>Book</a>
		<li><a href='<?=Epsilon::getRelativeLocation("live")?>'>Live</a>
		<li><a href='<?=Epsilon::getRelativeLocation("faq")?>'>Frequently Asked Questions</a>
		<li><a href='<?=Epsilon::getRelativeLocation("forum")?>'>Forum</a>
		<li><a href='<?=Epsilon::getRelativeLocation("download")?>'>Download instructions</a>
	</ul>
	</div>
	</div>
SEEALSO;
	return $html;
}*/

function tipSideItem ($language) {
	$html = "<div class='sideitem'>\r\n";
	$html .= "  <h6>Reminder</h6>\r\n";
	$html .= <<<TIP
<p>
By extending EOL, $language supports all its features such as multiple model access, support for instantiating and calling methods of Java objects... 
</p>
TIP;
	$html .= "</div>\r\n";
	return $html;
}

function eolFeatures($title="Features inherited from EOL") {
$html = <<<FEATURES
		<h4>$title</h4>
		<ul>
			<li>Support for simultaneously accessing/modifying many models of (potentially) different metamodels
			<li>All the usual programming constructs (while and for loops, statement sequencing, variables etc.)
			<li>Support for those convenient first-order logic OCL operations (select, reject, collect etc.)
			<li><a href="http://epsilonblog.wordpress.com/2007/12/16/using-java-objects-in-eol/">Ability to create and call methods of Java objects</a>
			<li>Support for dynamically attaching operations to existing meta-classes and types at runtime
			<li><a href="http://epsilonblog.wordpress.com/2007/12/16/cached-operations-in-eol/">Support for cached operations</a>
			<li><a href="http://epsilonblog.wordpress.com/2008/01/30/extended-properties-in-eol/">Support for extended properties</a>
			<li>Support for user interaction
			<li>Ability to create reusable libraries of operations and import them from different Epsilon (not only EOL) modules 
		</ul>
FEATURES;
return $html;
}
?>