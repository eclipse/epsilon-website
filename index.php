<?php
  require_once('template.php');
  require_once('util.php');
  
  //parse FAQs
  $components = simplexml_load_file("data/components.xml")->children();
  $reasons = simplexml_load_file("data/whyepsilon.xml")->children();
  $faqs = simplexml_load_file("faq/faqs.xml")->faq;

  
  $random_faq = rand(0,count($faqs)-1);
  $faq = $faqs[$random_faq];
  $faq_id = $faq["id"];
  $faq_title = $faq->title;
  $faq_answer = $faq->answer;

	$styles = array(
					'<style>
						#epsilonSlideshow {
					        width: 495px;
					  	}
					</style>'
	);

	h('', $styles);
?>

<div class="row">
	<div class="span12">
	<div class="alert alert-info" style1="font-weight:normal; background-color: rgb(214,238,247); color: rgb(24,136,173); border-color: rgb(181,233,241)">
		<b>Upcoming events</b><button type="button" class="close" data-dismiss="alert" style="font-size:16px">x</button>   
    <br/>
    &raquo; <a href="http://www.acme-workshop.org">Academics Tooling with Eclipse</a> ECMFA/ECOOP/ECSA workshop. Best paper prize (Google Nexus 7) sponsored by <a href="http://www.develop-group.de" style1="color: rgb(24,136,173)">develop group</a>.
		<br>
    &raquo; <a href="http://www.big-mde.eu">BigMDE</a> STAF/ICMT workshop on scalable Model Driven Engineering.
    </div>
    </div>
</div>

<div class="hero-unit" style="padding: 35px; padding-bottom:0px; background-color:rgb(232,232,232)">
	<div class="row">
		<div class="span3" style="width:325px">
        <p style="text-align:left"><b>Epsilon</b> is a family of languages and tools
        for <a href="doc/egl">code generation</a>, <a href="doc/etl">model-to-model transformation</a>, <a href="doc/evl">model validation</a>, <a href="doc/ecl">comparison</a>,
        <a href="doc/flock">migration</a> and <a href="doc/ewl">refactoring</a> that work out-of-the-box with <a href="http://www.eclipse.org/emf">EMF</a> and <a href="doc/emc/">other types of</a> models.</p>
        <p>
         <a class="btn btn-large" href="games/murdercase">Learn through a game &raquo;</a>
         <a class="btn btn-primary btn-large" href="download">Download &raquo;</a>
        </p>
		</div>

   <div class="span7" style="width:495px; position:relative; left:25px; top:-10px">
     <div id="showcase" class="carousel slide" data-interval="5000">
       <div class="carousel-inner" style="border:0px">
         <?
         $slideshow = simplexml_load_file("data/slideshow.xml")->children();
         $i=0;
         foreach ($slideshow->item as $item) { ?>
         <div class="<?=($i == 0 ? 'active ' : '')?>item">
           <a href="<?=$item['href']?>"><img src="<?=$item['img']?>" /></a>
           <?if ($i > 0){?>
           <div class="carousel-caption">
             <h4><?=$item['title']?></h4>
             <p><?=$item?></p>
           </div>
           <?}?>
         </div>
        <?
          $i++;
        } ?>
        </div>
        <a class="carousel-control left" href="#showcase" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#showcase" data-slide="next">&rsaquo;</a>
      </div>
    </div>
  </div>
</div>

<div class="tabbable" style="margin-bottom: 0px;">
  <ul class="nav nav-tabs">
    <li><a href="#languages" data-toggle="tab"><h4>Languages</h4></a></li>
    <li><a href="#tools" data-toggle="tab"><h4>Tools</h4></a></li>
    <li class="active"><a href="#whyepsilon" data-toggle="tab"><h4>Why Epsilon?</h4></a></li>
    <li><a href="#twitter" data-toggle="tab"><h4>@epsilonews</h4></a></li>
    <!--
    <a style="position:relative;top:19px;left:521px" href="http://marketplace.eclipse.org/marketplace-client-intro?mpc_install=400" title="Drag and drop into a running Eclipse Indigo workspace to install Epsilon">
	  <img src="/epsilon/img/installbutton.png"/>
    </a>
     -->
  </ul>
  
  <div class="tab-content">
  <?foreach (array("language", "tool") as $componentType) { $componentCount = countElements($components, $componentType);?>
    <div class="tab-pane <?if ($componentType=="language1"){ echo "active";}?>" id="<?=$componentType?>s">
    <?
      $i=0;
      foreach ($components as $component) { if ($component->getName() == $componentType) {
    ?>
    <? if ($i%3==0){?><div class="row" style="margin-top: 2em;"><?}?>
        <div class="span4">
          <a href="doc/<?=$component['id']?>"><img src="<?=$component['img']?>" style="position:relative;left:-3px"/></a>
          <a class="btn btn-primary btn-large" href="doc/<?=$component['id']?>" style="position:relative;top:-34px;left:245px;"><i class="icon-circle-arrow-right icon-white"></i></a>
          <div style="position:relative;top:-28px">
          <h5><?=$component["title"]?></h5>
          <p><?=$component?> <a href="doc/<?=$component['id']?>">(more...)</a></p>
          </div>
        </div>
    <?  if ($i%3==2 or $i==$componentCount-1){?></div><?}?>
    <?  $i++;?>
    <?}}?>
  	</div>
  <?}?>
  
  <div class="tab-pane active" id="whyepsilon">
  <?$i=0;?>
  <?foreach ($reasons as $reason){?>
  <?if($i%2==0){?><div class="row" style="padding-bottom:20px"><?}?>
  	<div class="span1">
  		<img style="position:relative;top:10px;left:10px" src="img/stylistica/<?=$reason["icon"]?>.png"> 
  	</div>
  	<div class="span5">
  		<h5><?=$reason["title"]?>.</h5><p><?=$reason?></p>
  	</div>
  <?if($i%2==1){?></div><?}?>
  <?$i++;?>
  <?}?>
  <p style="text-align:right">* Icons by <a href="http://dryicons.com">http://dryicons.com</a></p>
  </div>

    
  <div class="tab-pane" id="twitter">
  <a class="twitter-timeline" href="https://twitter.com/epsilonews" data-widget-id="308297319382654976">Tweets by @epsilonews</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
  </div>
</div>

<?php

	$scripts = array(
		'<script src="'.Epsilon::getRelativeLocation('js/individual/index.js').'"></script>',
    '<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>',
    '<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/epsilonews.json?callback=twitterCallback2&amp;count=5"></script>'
	);

	f($scripts);
	

?>

<script type="text/javascript">
$(function() {
    $('.carousel').carousel();
});
</script>