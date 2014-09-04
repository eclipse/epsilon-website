<?php
	require_once('../template.php');
	$developers = simplexml_load_file("developers.xml")->developer;	
	h();
?>

<style>
.grayscale {
    filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 10+, Firefox on Android */
    filter: gray; /* IE6-9 */
    -webkit-filter: grayscale(100%); /* Chrome 19+, Safari 6+, Safari 6+ iOS */
}
</style>

<div class="row">
	<!-- main part -->
	<div class="span12">
		<h1 class="page-header">Who is behind Epsilon?</h1>

		<div class="row">
			<div class="span12">

				<div class="tabbable" style="margin-bottom: 0px;">
				  <ul class="nav nav-tabs">
				  	<li class="active"><a href="#developers" data-toggle="tab"><h4>Developers</h4></a></li>
				    <li><a href="#professionalsupport" data-toggle="tab"><h4>Professional Support</h4></a></li>
				   	<!--li><a href="#sponsors" data-toggle="tab"><h4>Sponsors</h4></a></li-->
				   </ul>
				    <div class="tab-content">
				    	<div id="developers" class="tab-pane active">
				    	<?foreach($developers as $developer){?>
				    	<div class="span11" style="margin-bottom:20px">
				    		<img class="grayscale1" src="photos/<?=$developer["photo"]?>.jpg" 
				    			style="margin-bottom:20px;margin-top:8px;float:left;margin-right:20px;border-radius:6px;height:155px;width:155px"/>
				    		<h3 style="margin-top:0px"><?=$developer["name"]?></h3>
				    		<?=$developer?>
				    	</div>
				    	<?}?>
						</div>
  						<!--div id="sponsors" class="tab-pane">
  						</div-->
    					<div id="professionalsupport" class="tab-pane">
    						While we are proud of the level of support we provide to users of Epsilon through the <a href="../forum/">project's forum</a>, on some occasions, organisations
    						can benefit from more dedicated and focused in-house or remote support. In such cases, we can deliver bespoke on-site training programs and seminars, as well as professional development 
    						and support services (e.g. integration with modelling tools that are not natively supported by Epsilon, debugging and optimisation of Epsilon programs/workflows).
    						We have a long track record of working <a href="../users/">with industry</a>, so please get in touch and we will be more than happy to discuss your needs.
  						</div>						
  					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?f();?>