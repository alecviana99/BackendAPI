<?php include('header.php'); 

/*echo $sl_sql = "select * from comics order by id desc limit 0,4";
$sl_results = $db -> result($sl_sql);
echo '<pre>';
print_R($sl_results);
echo '</pre>';*/
$cm_sql1 = "select * from comics";
$cm_results1 = $db -> result($cm_sql1);
 
 
                   $nr = count($cm_results1); 
     if (isset($_GET['pn'])){ 
    $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); 
    } else {
    $pn = 1;
}
$prev = $pn - 1;
$itemsPerPage = 10;
$lastPage = ceil($nr / $itemsPerPage);
if ($pn < 1) { 
    $pn = 1; 
} else if ($pn > $lastPage) { 
    $pn = $lastPage; 
}
$centerPages = "";
for($i=1;$i<=$lastPage;$i++)
	{  
	if($i == ($pn)){
                $centerPages .= '<li><span class="page-numbers current">' . $pn . '</span></li>';
            }else{                                    
                 $centerPages .= '<li> <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i . '" class="page-numbers">' . $i . '</a> </li>';
            }  
	     
		 
	}
$paginationDisplay = ""; 
if ($lastPage >= 1){
   
    //$paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
    // If we are not on page 1 we can place the Back button
    if ($pn > 1) {
        
        $paginationDisplay1 =  '<li>   <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $prev . '" class="page-numbers"> <i class="fa fa-angle-left"></i></a> </li> ';
    }else{
	
	 $paginationDisplay1 =  '<li><i class="fa fa-angle-left"></i></li> ';
	}
	
	 if ($pn < $lastPage) {
        
        $paginationDisplay2 =  '<li>  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $lastPage . '" class="page-numbers"> <i class="fa fa-angle-right"></i></a> </li>';
    }else{
	$paginationDisplay2 =  '<li><i class="fa fa-angle-right"></i></li>';
	}
    // Lay in the clickable numbers display here between the Back and Next links
    $paginationDisplay .= '<div class="container text-center"><ul class="page-numbers">' .$paginationDisplay1. $centerPages .$paginationDisplay2. '</ul></div>';
    // If we are not on the very last page we can place the Next button
   
}
$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage;
$cm_sql = "select * from comics order by id desc $limit";
$cm_results = $db -> result($cm_sql);

$sl_sql = "select * from comics ORDER BY created DESC limit 0,5";
$sl_results = $db -> result($sl_sql);

?>

		<main class="cd-main-content">
			
			<!-- HOME SECTION
			================================================== -->
			
			<?php if(count($sl_results) > 0 ) { ?>
				<section class="page-section grey-section sp-top10">
				<div class="container">
					
					<div id="owl-content-slider2" class="owl-content-slider owl-carousel text-center">
					<?php foreach($sl_results as $sl_result) { ?>
						<div class="item">
							
								<img src="images/<?php echo $sl_result['id'].'/'.$sl_result['comic_big_image']; ?>" alt="" style="height:700px !important"/>
							
						</div>
					<?php } ?>
						
					</div>
					
				</div>
			</section>
			<?php } ?>
			
			
			
			
				
				<!-- SECTION WORK
				================================================== -->
				<?php if(count($cm_results) > 0 ) { ?>
		<section id="home-cont" class="page-section white-section sp-top100">					
				<div class="container">	
<?php foreach($cm_results as $sl_result) { ?>
<a href="episodes.php?cid=<?php echo $sl_result['id'];?>" />				
					<div class="four columns">						
						<h3 class="hs1 fontalt4 lp2 sm-bottom20"><?php echo $sl_result['comic_name']; ?></h3>
						<img src="images/<?php echo $sl_result['id'].'/'.$sl_result['comic_image']; ?>" alt="" style="height:280px !important; width:280px !important;"/>
					</div>
					</a>
			<?php } ?>		
				</div>
			</section>	
<?php } ?>	
	
		<!-- pagination section -->	
		<section class="page-section white-section sp-bottom100">
				
				<?php echo $paginationDisplay; 
//die();?>
			</section>
<?php include('footer.php'); ?>