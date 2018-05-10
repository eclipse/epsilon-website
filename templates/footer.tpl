
	<br/>

	<hr>
	
      <footer style="padding-top:20px">
        <ul class="nav nav-pills">
        <li><a href="http://www.eclipse.org/">Eclipse Foundation</a>
        <li><a href="http://www.eclipse.org/legal/privacy.php">Privacy Policy</a>
        <li><a href="http://www.eclipse.org/legal/termsofuse.php">Terms of Use</a>
        <li><a href="http://www.eclipse.org/legal/copyright.php">Copyright Agent</a>
        <li><a href="http://www.eclipse.org/legal/">Legal</a>
        <li><a href="http://www.eclipse.org/org/foundation/contact.php">Contact us</a>
        </ul>
      </footer>


    </div> <!-- /container -->

    <script src="<?php echo Epsilon::getRelativeLocation('js/jquery.js'); ?>"></script>
    <script src="<?php echo Epsilon::getRelativeLocation('js/bootstrap.js'); ?>"></script>
    <script src="<?php echo Epsilon::getRelativeLocation('js/google-code-prettify/prettify.js'); ?>"></script>
    <script src="<?php echo Epsilon::getRelativeLocation('js/google-code-prettify/lang-emfatic.js'); ?>"></script>
    <script src="<?php echo Epsilon::getRelativeLocation('js/google-code-prettify/lang-epsilon.js'); ?>"></script>

    <script type="text/javascript">
      // Temporary workaround for Bootstrap issue 2975 until we migrate to 2.2.2
      $('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
    </script>

    <?php echo $tplScripts; ?>
</body>
</html>
