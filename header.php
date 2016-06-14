<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="shortcut icon" href="<?php bloginfo("url"); ?>/favicon.ico" type="image/x-icon">
	
		<style>

			body:before{
				background-color: #fff;
				content: "";
				opacity: 1;
				position: fixed;
				transition: opacity .25s ease-in-out;
				-moz-transition: opacity .25s ease-in-out;
				-webkit-transition: opacity .25s ease-in-out;
				transition: height 1s ease-in-out;
				-moz-transition: height 1s ease-in-out;
				-webkit-transition: height 1s ease-in-out;
				width: 100%; height: 800px;
				z-index: 9999999;
			}
		
			img{
				width: 100%;
			}

			.navbar-toggle{
				margin-bottom: 20px;
			}

			.menu-item{
				margin-bottom: 10px;
			}

			.crndg-scroll-btn{
				margin-bottom: 10px;
			}

			.logo{
				display: none;
				margin-top: 15px;
			}

		</style>

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<div class="container">

			<nav class="navbar navbar-default navbar-fixed-top">
			
				<div class="container-fluid">
			
					<div class="row">

						<a class="logo" href="<?php bloginfo("url"); ?>">
							<img alt="CRNDG" class="the-corndog" src="<?php bloginfo("template_url"); ?>/img/the-corndog.png">
<!-- 							<img alt="CRNDG" src="<?php bloginfo("template_url"); ?>/img/crndg-logo-538.png">
 -->						</a>

					</div>
			
				</div>
			
			</nav>
			
		</div>