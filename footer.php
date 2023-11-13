			<footer id="main-footer">
				<?php get_sidebar( 'footer' ); ?>
				<?php
				if ( has_nav_menu( 'footer-menu' ) ) : ?>

				<div id="footer-nav">
					<div class="container">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'depth'          => '1',
								'menu_class'     => 'bottom-nav',
								'container'      => '',
								'fallback_cb'    => '',
							) );
						?>
					</div>
				</div>

				<?php endif; ?>

				<div id="footer-bottom">
					<div class="container clearfix">
					</div>
				</div>
			</footer>
		</div>
	</div>

	<?php wp_footer(); ?>
</body>
</html>
