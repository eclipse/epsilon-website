	<hr>

      <footer style="padding-top:20px">
        <ul class="nav nav-pills">
        <li><a href="/epsilon">Home</a>
        <li><a href="http://www.eclipse.org/legal/privacy.php">Privacy Policy</a>
        <li><a href="http://www.eclipse.org/legal/termsofuse.php">Terms of Use</a>
        <li><a href="http://www.eclipse.org/legal/copyright.php">Copyright Agent</a>
        <li><a href="http://www.eclipse.org/legal/">Legal</a>
        <li><a href="http://www.eclipse.org/org/foundation/contact.php">Contact us</a>
        <li><a> Copyright &copy; 2012 The Eclipse Foundation.</a>
        </ul>       
      </footer>


    </div> <!-- /container -->
    
    <script src="<?php echo Epsilon::getRelativeLocation('js/jquery.js'); ?>"></script>
    <script src="<?php echo Epsilon::getRelativeLocation('js/bootstrap.js'); ?>"></script>
    <script src="<?php echo Epsilon::getRelativeLocation('js/google-code-prettify/prettify.js'); ?>"></script>
    <script src="<?php echo Epsilon::getRelativeLocation('js/google-code-prettify/lang-emfatic.js'); ?>"></script>
    <script src="<?php echo Epsilon::getRelativeLocation('js/google-code-prettify/lang-epsilon.js'); ?>"></script>
    
    <!-- Start of StatCounter Code -->
	<script type="text/javascript" language="javascript">
	var sc_project=2185757; 
	var sc_invisible=1; 
	var sc_partition=5; 
	var sc_security="2d5ff082"; 
	</script>
	
	<script type="text/javascript" language="javascript" src="http://www.statcounter.com/counter/counter.js"></script><noscript><a href="http://www.statcounter.com/" target="_blank"><img  src="http://c6.statcounter.com/counter.php?sc_project=2185757&java=0&security=2d5ff082&invisible=1" alt="free web hit counter" border="0"></a> </noscript>
	<!-- End of StatCounter Code -->

    <script type="text/javascript">
      // Temporary workaround for Bootstrap issue 2975 until we migrate to 2.2.2
      $('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
    </script>
	
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-910670-2']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-1498421-2']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
		
    <?php echo $tplScripts; ?>
</body>
</html>