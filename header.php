<?php include('api/Database.php');
$db = new Database();
 ?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]>
<!--><html class="no-js" lang="en"><!--<![endif]-->
<head>

	<!-- Page header
	================================================== -->
	<meta charset="utf-8">	
	<meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content=""/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Page Title
	================================================== -->
	<title>Comisstrip</title>
	
	<!-- CSS
	================================================== -->
	
	<!--A dead simple, responsive boilerplate-->
	<link rel="stylesheet" href="css/base.css"/>
	<link rel="stylesheet" href="css/skeleton.css"/>	
	
	<!--Icon font-->
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="fonts/Icon-font-7/pe-icon-7-stroke.css" />
	<link rel="stylesheet" href="fonts/etlinefont/etlinefont.css" />
	
	<!--Owl carousel-->
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	
	<!--Content Animation-->
	<!--<link rel="stylesheet" href="css/animsition.min.css"/>-->
	
	<!--venobox lightbox-->
	<!--<link rel="stylesheet" href="css/magnific-popup.css"/>
	
	<!--Common Style-->
	<link rel="stylesheet" href="css/index-carousel-slider2.css"/>
	
	<!--venobox lightbox-->
	<!--<link rel="stylesheet" href="css/magnific-popup.css"/>
	
	<!--Common Style-->
	<link rel="stylesheet" href="css/style.css"/>
	
	<!-- Favicons
	================================================== -->
	
	<link rel="shortcut icon" href="favicon.png">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">
		
</head>
<body>	
<?php 
//print_R($_SERVER); 
if (strpos($_SERVER['SCRIPT_NAME'], 'panels.php') !== false) {
    echo '<div class="scroll-to-bottom"><i class="fa fa-angle-down"></i></div>';
}

?>
	
	<div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
	
		<!-- Navigation panel
		================================================== -->		
		<nav class="main-nav white stick">
			<div class="container relative clearfix">
			
				<!-- Logo -->
				<div class="header-logo-wrap">
					<a href="index.php" class="logo">
						<img src="images/logo.png" height="27" alt="" />
					</a>
				</div>
				
				<div class="search-head">
							<form role="form" class="form-inline form" method="get" action="search.php">
								<div class="search-wrap clearfix">
								<input placeholder="Search..." class="form-control search-field" type="text" name="search">
									<button title="Start Search" type="submit" class="search-button animate">
										<i class="fa fa-search"></i>
									</button>
									
								</div>
							</form>
						</div>		

			</div>
		</nav>
		<!-- End Navigation panel -->
		 
		<!-- MAIN CONTENT