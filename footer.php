	<div class="push"></div>
	</div><!-- close #mainContent-->
</div> <!-- close #pageWrapper -->
<footer>
	<div id="footerWrapper">
		<a href="http://steampowered.com">Powered by Steam&trade;</a>

		<p>Follow Us</p>
		<div class="addthis_toolbox addthis_32x32_style addthis_default_style">
		    <a class="addthis_button_facebook_follow" addthis:userid="steamphotoshare"></a>
		    <a class="addthis_button_twitter_follow" addthis:userid="iOSDota"></a>
		    <a class="addthis_button_tumblr_follow" addthis:userid="lernerb"></a>
		</div>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515731c3301753b5"></script>


		<a href="./sitemap.php">Sitemap</a>


		<?php 

		try {
		    echo 'User ' . ($openid->isValid ? $openid->identity . ' has ' : 'has not ') . 'logged in.';

		} catch(ErrorException $e) {
		    echo $e->getMessage();
		}?>
	</div>
</footer>
</body>
</html>