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

<div class="hero-unit">
	<div class="row">
		<div class="span5">
        <p style="text-align:left">Epsilon is a family of languages and tools
        for <a href="doc/egl">code generation</a>, <a href="doc/etl">model-to-model transformation</a>, <a href="doc/evl">model validation</a>, <a href="doc/ecl">comparison</a>,
        <a href="doc/flock">migration</a> and <a href="doc/ewl">refactoring</a> that work out of the box with <a href="http://www.eclipse.org/emf">EMF</a>, <a href="https://wiki.eclipse.org/MDT/UML2">UML</a>, <a href="doc/articles/simulink">Simulink</a>, <a href="doc/articles/plain-xml">XML</a> and <a href="doc/emc/">other types of</a> models.</p>
        <br/>
        <p>
         <!--a class="btn btn-large" href="games/murdercase">Learn through a game &raquo;</a-->
         <a class="btn btn-large" href="https://www.youtube.com/playlist?list=PLRwHao6Ue0YUecg7vEUQTrtySIWwrd_mI">Getting Started</a>
         <a class="btn btn-primary btn-large" href="download">Download &raquo;</a>
        </p>
		</div>

   <div class="span7" style="width:495px; position:relative; left:25px; top:-10px">
     <div id="showcase" class="carousel slide" data-interval="8000">
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
        <a class="carousel-control left" href="#showcase" data-slide="prev" style="font-family:'Ubuntu'">&lsaquo;</a>
        <a class="carousel-control right" href="#showcase" data-slide="next" style="font-family:'Ubuntu'">&rsaquo;</a>
      </div>
    </div>
  </div>
</div>

<!--span style="float:right;position:relative;top:20px"><script id='fbwyf51'>(function(i){var f,s=document.getElementById(i);f=document.createElement('iframe');f.src='//api.flattr.com/button/view/?uid=epsilonews&button=compact&url=http%3A%2F%2Fwww.eclipse.org%2Fepsilon';f.title='Flattr';f.height=20;f.width=110;f.style.borderWidth=0;s.parentNode.insertBefore(f,s);})('fbwyf51');</script></span-->
<div class="tabbable" style="margin-bottom: 0px;">
  <ul class="nav nav-tabs">
    <li><a href="#languages" data-toggle="tab"><h4>Languages</h4></a></li>
    <li><a href="#tools" data-toggle="tab"><h4>Tools</h4></a></li>
    <li class="active"><a href="#whyepsilon" data-toggle="tab"><h4>Why Epsilon?</h4></a></li>

    <!--
    <a style="position:relative;top:19px;left:521px" href="https://marketplace.eclipse.org/marketplace-client-intro?mpc_install=400" title="Drag and drop into a running Eclipse Indigo workspace to install Epsilon">
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
  <p style="text-align:right">* Icons by <a href="http://dryicons.com/">https://dryicons.com</a></p>
  </div>

</div>

<?php
	$scripts = array(
		'<script src="'.Epsilon::getRelativeLocation('js/individual/index.js').'"></script>'
	);
	f($scripts);
?>

<script type="text/javascript">
$(function() {
    $('.carousel').carousel();
});
</script>
