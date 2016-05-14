<!doctype html>
<html>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title> Size Boutique | Tu tienda de moda en Barquisimeto</title>
		<?php wp_head(); ?>
		<link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_directory');?>/img/favicon.ico">
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','http://www.google-analytics.com/analytics.js','ga');
          ga('create', 'UA-65601089-3', 'auto');
          ga('send', 'pageview');
        </script>
	</head>
	<body style="overflow-X: hidden;">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="navbar-brand"><img src="<?php echo get_bloginfo('template_directory');?>/img/logo.png" class="img-responsive"></div>
                    </div>
                <div class="container">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php  wp_nav_menu(array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new Bootstrap_Walker_Nav_Menu() ) ); ?>
                    </div>
                </div>
        </nav>