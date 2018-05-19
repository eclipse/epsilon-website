<?php
	require_once('../template.php');
	// Create a parser and parse the examples.xml document.
	$screencasts = simplexml_load_file("cinema.xml")->screencast;
	$test = array();
	h(null, array('
		<style>
			.thumb-pic {
	    	    position: relative;
		  	}

			.span4 .thumb-pic span {
				position: absolute;
				margin: auto;
				width: 75px;
				height: 73px;
				bottom: 20px;
				right: 20px;
				background: url(\'../epsilon/img/play.png\');
				display: block;
				border-radius: 14px;
			}

			.span4 .thumb-pic span:hover {
				box-shadow: 5px 5px 2px #888;
			}

			.thumb-pic a {
				position: absolute;
				bottom: -8px;
				right: 5px;
			}

			.caption p {
				text-align: justify;
			}

			.screencast {
				width: 860px;
				margin: -330px 0 0 -430px;
			}

			.modal-body {
				max-height: none;
			}
		</style>
	'));
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Screencasts</h1>

		<div class="row">
			<div class="span8">
				<img class="pull-right" src="https://dev.eclipse.org/huge_icons/mimetypes/x-office-presentation.png" alt="">
				<p>This page contains several screencasts demonstrating different tools and languages in Epsilon. To watch the screencasts you must have a <a href="http://get.adobe.com/flashplayer/">Flash player</a> installed and enabled in your browser. All screencasts have been captured using <a href="http://www.debugmode.com/wink">Wink</a>.</p>
			</div>
		</div>
		
		<? 
		$i = 0;

		foreach ($screencasts as $screencast) {
		$test[] = array(
			'name' => (string) $screencast['name'],
			'title' => (string) $screencast['title'],
			'width' => (integer) $screencast['width'],
			'height' => (integer) $screencast['height'],
			'description' => trim(str_replace(array("\n","\r","\t"),'',(string) $screencast->description))
		);

		if($i%2 < 1) { // start a new row ?>
		<div class="row">
			<div class="span8">
				<ul class="thumbnails">
		<? } ?>
					<li class="span4">
		              <div class="thumbnail">
		                <div class="thumb-pic" id="<?= $screencast["name"] ?>">
		                  <img src="<?=$screencast["name"]?>.jpg" alt="">
		                  <a href="#" data-index="<?=$i?>" class="btn btn-primary btn-large">
		                    <i class="icon-play-circle icon-white"></i> Watch
		                  </a>
		                </div>
		                <div class="caption">
		                  <h5 title="<?=$screencast['title']?>"><?=$screencast["title"]?></h5>
		                  <p title="<?=trim($screencast->description)?>"><?=summary($screencast->description, 146)?></p>
		                </div>
		              </div>
		            </li>
		            <? 
		        	if($i%2 > 0) { // end a row ?>
				</ul>
			</div>
		</div>
		<? }
		$i++;
		}
		if($i%2 > 0) { // means we still need to close the last row! ?>
				</ul>
			</div>
		</div>
		<? } ?>

	</div>
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
	<? sB('Overview', true); ?>
		<ul>
		<? foreach ($screencasts as $screencast) { ?>
				<li><a href="#<?=$screencast["name"]?>"><?=$screencast["title"]?></a></li>
			<? } ?>
		</ul>
	<? sE(); ?>
	</div>
	<!-- end sidebar -->
</div>

<div class="modal hide" id="videoModal">
	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal">×</button>
	  <h3>Modal header</h3>
	</div>
	<div class="modal-body">
	  <div id="video">
	  	
	  </div>
	  <p>Description</p>
	</div>
	<!--
	<div class="modal-footer">
	  <a href="#" class="btn" data-dismiss="modal">Close</a>
	  <a href="#" class="btn btn-primary">Save changes</a>
	</div>
	-->
</div>

<script>
var descriptions = 
<?php
echo json_encode($test); ?>
</script>
<?
$script = "
<script>
$('div.thumbnail a').on('click', function(e) {

  var modal = $('#videoModal');
  // set correct title and description
  var index = $(this).data('index');
  modal.find('.modal-header h3').text(descriptions[index].title);
  modal.find('.modal-body p').html(descriptions[index].description);
  $('#video').html('<embed src=\"' + descriptions[index].name + '.swf\" />')
  .find('embed').css({
  	'width' : descriptions[index]['width'] + 'px',
  	'height' : descriptions[index]['height'] + 'px'
  });

  // show the modal
  modal.modal('toggle');

  // scroll to the top of the modal body
  var modalBody = modal.find('.modal-body');
  modalBody.scrollTop(0);
  
  var wHeight = $(window).innerHeight();
  modalBody.css('max-height', function() {
  	return (wHeight - ( modal.outerHeight() - modal.innerHeight() ) - $('.modal-header').outerHeight()*2) + 'px';
  });

  modal.css({
  	'width' : (descriptions[index]['width'] + parseInt(modalBody.css('padding-left'))*3) + 5 + 'px',
  	'margin-top': function () { 
       return -($(this).height() / 2); 
   	},
  	'margin-left': function () { 
       return -($(this).width() / 2); 
   	}
  });

  
  // disable the link
  e.preventDefault();
});
</script>
";
	f(array($script));
?>