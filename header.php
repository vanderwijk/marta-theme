<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="profile" href="http://gmpg.org/xfn/11" />

<!--
    ╭──────────────────────────────────────────╮
    │  ≡ WordPress website developed by        │
    ╞══════════════════════════════════════════╡
    │  Johan van der Wijk - The Web Works      │
    ├──────────────────────────────────────────┤
    │  https://thewebworks.nl                  │
    ╰──────────────────────────────────────────╯
-->

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-91329416-1', 'auto');
	ga('send', 'pageview');
</script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header class="header clearfix" data-spy="affix" data-offset-top="10">
		<div class="wrap">
			<button class="menu-toggle">&#9776; Menu</button>
			<nav class="nav">
				<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => '', 'items_wrap' => '<ul>%3$s</ul>' ) ); ?>
			</nav>
			<img class="feelgood" src="/wp-content/themes/marta/img/feelgood.jpg" alt="Feelgood Designs" />
		</div>
	</header>
	<div class="main clearfix">
