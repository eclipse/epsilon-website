<?

include_once ('publications/PublicationsManager.php');

function toolsSideItem($tool="epsilon") {
	
	$parentPath = Epsilon::getParentPath();
	
	$html = PublicationsManager::getPublicationSideItem($tool);
	ob_start();
	sB('Languages');
	?>
	<ul>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/eol')?>">Epsilon Object Language</a>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/etl')?>">Epsilon Transformation Language</a>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/evl')?>">Epsilon Validation Language</a>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/egl')?>">Epsilon Generation Language</a>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/egx')?>">Epsilon EGL Coordination Language</a>	
	<li><a href="<?=Epsilon::getRelativeLocation('doc/ewl')?>">Epsilon Wizard Language</a>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/ecl')?>">Epsilon Comparison Language</a>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/eml')?>">Epsilon Merging Language</a>
    <li><a href="<?=Epsilon::getRelativeLocation('doc/epl')?>">Epsilon Pattern Language</a>
    <li><a href="<?=Epsilon::getRelativeLocation('doc/emg')?>">Epsilon Model Genration Language</a>	
	<li><a href="<?=Epsilon::getRelativeLocation('doc/flock')?>">Epsilon Flock</a>
	</ul>
	<? sE(); ?>
	
	<? sB('Tools'); ?>
	<ul>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/eugenia')?>">EuGENia</a>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/exeed')?>">Exeed</a>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/modelink')?>">ModeLink</a>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/workflow')?>">Workflow</a>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/hutn')?>">Human Usable Textual Notation</a>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/concordance')?>">Concordance</a>
	<li><a href="<?=Epsilon::getRelativeLocation('doc/eunit')?>">EUnit</a>
	</ul>
	<? sE(); ?>
	
	<?
	$html .= ob_get_contents();
	ob_end_clean();
	
	return $html;
}

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
		<div class="row" style="position:relative; top:-10px">
			<div class="span8">
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
			</div>
		</div>
FEATURES;
if ($title=="Features inherited from EOL") {}
else { $html = "<h3>$title</h3>".$html;}
return $html;
}
?>
