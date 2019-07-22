<?php include('header.php'); 


$cm_sql1 = "select * from comics where comic_name like '%".$_GET['search']."%'";
$cm_results1 = $db -> result($cm_sql1);
echo $where ="&search=".$_GET['search']."";
                   $nr = count($cm_results1); 
     if (isset($_GET['pn'])){ 
    $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); 
    } else {
    $pn = 1;
}
$itemsPerPage = 4;
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
                $centerPages .= '<li><span class="page-numbers current">' . $pn.'</span></li>';
            }else{                                    
                 $centerPages .= '<li> <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i .$where. '" class="page-numbers">' . $i . '</a> </li>';
            }  
	     
		 
	}
	$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage;
	$cm_sql = "select * from comics where comic_name like '%".$_GET['search']."%' order by id desc $limit";
$cm_results = $db -> result($cm_sql);
$paginationDisplay = ""; 
if ($lastPage != "1"){
   
    //$paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
    // If we are not on page 1 we can place the Back button
    if ($pn != 1) {
       
        $paginationDisplay1 =  '<li>   <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $pn .$where. '" class="page-numbers"> <i class="fa fa-angle-left"></i></a> </li> ';
    }
	
	 if ($pn != $lastPage) {
        
        $paginationDisplay2 =  '<li>  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $lastPage .$where. '" class="page-numbers"> <i class="fa fa-angle-right"></i></a> </li>';
    }
    // Lay in the clickable numbers display here between the Back and Next links
    $paginationDisplay .= '<div class="container text-center"><ul class="page-numbers">' .$paginationDisplay1. $centerPages .$paginationDisplay2. '</ul></div>';
    // If we are not on the very last page we can place the Next button
   
}




?>

		<main class="cd-main-content">
			
			
				
				<!-- SECTION WORK
				================================================== -->
				<?php if(count($cm_results) > 0 ) { ?>
		<section id="home-cont" class="page-section white-section sp-top100">	
				<div class="container text-center">
					<div class=" hs1 fontalt4 sm-bottom40 side-line">Search Results (<?php echo count($cm_results1) ;?>)</div>
				</div>		
				<div class="container">	
<?php foreach($cm_results as $sl_result) { ?>
<a href="episodes.php?cid=<?php echo $sl_result['id'];?>" />				
					<div class="four columns">						
						<h3 class="hs1 fontalt4 lp2 sm-bottom20"><?php echo $sl_result['comic_name']; ?></h3>
						<img src="images/<?php echo $sl_result['id'].'/'.$sl_result['comic_image']; ?>" alt=""/>
					</div>
					</a>
			<?php } ?>		
				</div>
			</section>	
	
	
		<!-- pagination section -->	
		<section class="page-section white-section sp-bottom100">
				
				<?php echo $paginationDisplay; 
//die();?>
			</section>
		<?php }	else { ?>
			<section class="page-section white-section sp-top-bottom100">
				<div class="container text-center">
					<div class=" hs1 fontalt4 sm-bottom40 side-line">No Records</div>
				</div>
				</section>
			<?php } ?>
<?php include('footer.php'); ?>