<?php
/**
 * Template Name: TSMU 3D Tours on Google Maps
 *
 * Page template for
 *
 * @package Openstrap
 * @since Opentrap_child
 */

get_header(); ?>

<?php $col =  openstrap_get_content_cols(); ?>

	<!-- Main Content -->	
	<div class="col-md-<?php echo $col;?>" role="content">
		<div id="primary" class="site-content">
			<div id="content" role="main">
				<!-- 3D tour content -->
				<h1>TSMU Campus 3D-tour</h1>
				<div>
					<h1 class="site-title" style="margin-bottom: 20px;"></h1>
					<div id="map-canvas" style="width: 100% !important; height: 600px !important;"></div>
					<div id="dialog-sw-canvas"></div>
				</div>
				<!-- End of 3D tour content -->
			</div><!-- #content -->
		</div><!-- #primary -->
	</div><!-- .col-md-<?php echo $col;?> -->
	<!-- End Main Content -->	
<?php get_sidebar(); ?>	
<?php get_footer(); ?>