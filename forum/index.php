<?php
	require_once('../template.php');
	h();
?>
<div class="row">
	<!-- main part -->
	<div class="span8">
		<h1 class="page-header">Forum</h1>
		<h3>Epsilon Forum</h3>
		<div class="row">
			<div class="span8">
				<img class="pull-right" src="http://dev.eclipse.org/huge_icons/actions/mail-send-receive.png" alt="">
				<p>Epsilon has a <a href="http://www.eclipse.org/forums/index.php?t=thread&frm_id=22">dedicated forum</a> where you can report problems* and ask questions about the languages and tools it provides. Questions are typically answered within a few minutes, and <u>no post has ever gone unanswered</u>.</p>
			</div>
			
		</div>

		<div class="row">
			<div class="span8">
				<h3>Connecting using a newsgroup reader</h3>
				<p> 
					As an alternative to the <a href="http://www.eclipse.org/forums/index.php?t=thread&frm_id=22">web interface</a>, you can
					use a newsgroup reader (e.g. Thunderbird, Outlook Express) to monitor the forum.
					To do this, you need to first get a username and password by filling in 
					<a href="http://www.eclipse.org/newsgroups/register.php">this form</a> 
					(<i>this small inconvenience is necessary to prevent spam</i>).
				</p>
					
				<p>Once you have received your username and password you can connect to the newsgroup that underpins the forum by configuring 
					your newsgroup reader with the following details:
				</p>
				
				<ul>
					<li><b>Server:</b> news.eclipse.org
					<li><b>Newsgroup:</b> eclipse.epsilon
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="span8">
				<h3>Monitor the newsgroup for new questions/answers</h3>
				<p>You can use <a href="http://kolovos.wiki.sourceforge.net/Newsgroup+Watcher">Newsgroup Watcher</a> to monitor the forum and get instant notifications about new answers to your questions.</p>
				<p><i>* If on the other hand you've found everything to be working well, positive feedback is equally welcome ;)</i></p>
			</div>
		</div>
	</div>
	<!-- end main part -->

	<!-- sidebar -->
	<div class="span4">
		<!-- first element -->
		<? sB('Where is the newsgroup?'); ?>
					The <a href="http://www.eclipse.org/forums/index.php?t=thread&frm_id=22">forum</a> is just a web-based front-end for the existing NNTP newsgroup, so if you are already reading/posting to the newsgroup via a newsgroup reader, there's no need to change anything.
		<? sE(); ?>
		<!-- end first element -->

		<!-- third element -->
		<!--
		<? sB('Twitter'); ?>
					<ul id="twitter_update_list"></ul>
					<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
					<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/epsilonews.json?callback=twitterCallback2&amp;count=5"></script>
		<? sE(); ?>
		 -->
		<!-- end third element -->
		
	</div>
	<!-- end sidebar -->
</div>
<?php
	f();
?>