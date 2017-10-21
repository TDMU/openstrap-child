<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="bodychild">
	<!-- Wrap all page content here -->  
	<div id="wrap">	
	
	<?php 
		$site_logo = of_get_option('site_logo');
		$header =  get_header_textcolor();	
		$header_background = of_get_option('header_background');
		
		//check and get if any header image set from WP Settings
		$wp_header_image = get_header_image();		
		if(empty($header_background) && !empty($wp_header_image)):
			$header_background = get_header_image();
		endif;
		
		$header_contact_phone = of_get_option('header_contact_phone');
		$header_contact_mail = of_get_option('header_contact_mail');
		
		$display_nav_search = of_get_option('display_nav_search');
	?>	
	<?php if ( $header !== "blank" ) : ?>
		<header class="site-header" role="banner">
		<div id="header-top">
			<div class="container">
				<div class="pull-left header-contact" id="header-top-container">
                
                        <div class="row">
                            <div class="col-lg-12 col-md-12 hidden-xs hidden-sm">
                                    <?php function langFlag ($lang){

                                        $url=$_SERVER["REQUEST_URI"];
                                        $findlang   = '/';
                                        $pos = strpos($url, $findlang,1);
                                        if ($pos === false) {
                                            //echo "Строка '$findme' не найдена в строке '$mystring'";
                                            if($lang=="ua"){
                                                $langUrl= $url;
                                            }
                                            elseif($lang=="en")
                                            {
                                                $langUrl="/en/";   //"http://old.tdmu.edu.ua/eng/general/index.php";   //"/en/";
                                            }
                                            else {
                                                $langUrl= $url.$lang."/";
                                            }
                                        } else {
                                            //echo "Строка '$findme' найдена в строке '$mystring'";
                                            //echo " в позиции $pos";

                                            if($lang=="ua"){

                                                $url=substr_replace($url, '', 0, $pos);
                                                $langUrl=$url;
                                            }
                                            elseif($lang=="en")
                                            {
                                                $langUrl="/en/";   //"http://old.tdmu.edu.ua/eng/general/index.php";   //"/en/";
                                            }
                                            else {
                                                $len=strlen($url);
                                                $url=substr_replace($url, $lang."/",  1, $pos);
                                                $langUrl=$url;
                                            }


                                            //echo $langUrl;
                                        }
                                        return $langUrl;
                                    }?>
                                <span class="no_translate">
                                    <a class="langFlag" href="<?php bloginfo('url'); echo langFlag ("ua"); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ua.png" alt="" class="img-responsive" /></a>
                                    <a class="langFlag" href="<?php echo langFlag ("en"); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/en.png" alt="" class="img-responsive" /></a>
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-12 hidden-md hidden-lg">
                                <span class="no_translate">
                                    <a class="langFlag" href="<?php bloginfo('url'); echo langFlag ("ua"); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ua.png" alt="" class="img-responsive" /></a>
                                    <a class="langFlag" href="<?php echo langFlag ("en"); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/en.png" alt="" class="img-responsive" /></a>
                                </span>
                            </div>
                        </div>
                        
				<?php if(!empty($header_contact_phone)):?>
					<span><i class="icon-phone"></i> <?php echo $header_contact_phone;?></span>
				<?php endif;?>
				<?php if(!empty($header_contact_mail)):?>
					<span><i class="icon-envelope-alt"></i> <a href="mailto:<?php echo $header_contact_mail;?>"><?php echo $header_contact_mail;?></a></span>
				<?php endif;?>				
				</div>
				<div class="pull-right"  id="header-top-container">
					<div class="pull-right">
						<div class="pull-left">
						<?php 
							wp_nav_menu( array( 'theme_location' => 'secondary', 
												'menu_class' => 'list-inline', 
												'depth' =>1, 
												'container' => false, 
												'fallback_cb' => false ) ); 
						?>
						</div>
						<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :?>
						<div class="woocommerce-header-cart pull-right">						
							<?php global $woocommerce; ?>
							<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>">
								<?php if ($woocommerce->cart->cart_contents_count == 0){
										printf( '<i class="icon-shopping-cart"></i>', get_stylesheet_directory_uri());
									}else{
										printf( '<i class="icon-shopping-cart"></i>', get_stylesheet_directory_uri());
									}
								?>  
							</a>
							<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" >
							Your Cart : <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'openstrap'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
						</div>
						<?php endif;?>
						
					</div>		
				</div>
			</div>			
		</div>	

		<div class="header-body">		
			<div class="container">
				 <div class="row logo-row">
				  <div class="col-sm-2 col-md-2 hidden-xs">
					<?php if ( $site_logo != '' ) : ?>
					<a href="<?php echo esc_url( home_url( '/' )); ?>"><img src="<?php echo esc_url($site_logo); ?>" alt="<?php bloginfo('description'); ?>" class="img-responsive" /></a>
					<?php elseif($site_logo == '' || !isset($site_logo)): ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<small><?php bloginfo( 'description' ); ?></small>
					<?php endif; ?>					
				  </div>

                 <div class="hidden-md hidden-lg col-xs-12 col-sm-6">
                    <h1 class="site-title-little">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> 
                            <?php //bloginfo( 'name' ); ?>
                            ТЕРНОПІЛЬСЬКИЙ ДЕРЖАВНИЙ МЕДИЧНИЙ УНІВЕРСИТЕТ <div>імені І.Я. Горбачевського</div>
                        </a>
                    </h1>
                    <small><?php //bloginfo( 'description' ); ?></small>
                 </div>
                  <div class="col-md-7 col-lg-7 hidden-xs hidden-sm">
					<h1 class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                            <?php //bloginfo( 'name' ); ?>
                            ТЕРНОПІЛЬСЬКИЙ ДЕРЖАВНИЙ МЕДИЧНИЙ УНІВЕРСИТЕТ <div>імені І.Я. Горбачевського</div>
                        </a>
                    </h1>
					<small><?php //bloginfo( 'description' ); ?></small>
				  </div>

				  <div class="col-md-8 hidden-xs">
					<div class="pull-right">
						<?php if ( is_active_sidebar( 'openstrap_header_right' ) ) : ?>
							<?php dynamic_sidebar( 'openstrap_header_right' ); ?>	
						<?php endif; ?>	
					</div>
				  </div>
				</div>
			</div>	
		</div>
	
	</header>
	<?php endif; ?>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <!--
          <a class="navbar-brand visible-xs" href="<?php echo esc_url (home_url( '/' )); ?>"><i class="icon-home"></i></a>
		  -->
		<?php if(isset($display_nav_search) && $display_nav_search==true): ?> 
		<div class="navbar-search-sm pull-right visible-sm visible-xs">

				<form class="navbar-search navbar-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" name="s" id="s" class="search-fields" placeholder="<?php esc_attr_e( 'Search', 'openstrap' ); ?>" name="s">
				</form>

		</div>		
		<?php endif; ?>
		
        </div>
        <div class="navbar-collapse collapse">
		<?php wp_nav_menu( array( 
							'theme_location' => 'primary', 
							'menu_class' => 'nav navbar-nav pull-left', 
							'depth' =>4,
							'container' => false, 
							'fallback_cb' => false, 
							'walker' => new openstrap_theme_navigation() ) ); ?>	
		
		<?php if(isset($display_nav_search) && $display_nav_search==true): ?> 	
		<ul class="nav navbar-nav navbar-right visible-md visible-lg pull-right">
			<li>
				<form class="navbar-search navbar-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" name="s" id="s" class="search-fields" placeholder="<?php esc_attr_e( 'Search', 'openstrap' ); ?>" name="s">
				</form>
			</li>
		</ul>
		<?php endif; ?>		
							
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container" id="main-container">
    
    <div class="col-md-12" >
    <?php
        if ( is_front_page() )
        echo do_shortcode('[crellyslider alias="main_page_slider"]');
    ?>
    </div>
    <p>

	<div class="row" id="main-row">

