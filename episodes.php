<?php include('header.php'); 

$ep_sql1 = "select * from episodes where comic_id = '".$_GET['cid']."' and  active = '1'  order by id desc";
$ep_results1 = $db -> result($ep_sql1);

$sl_sql = "select comic_big_image,comic_name from comics where id='".$_GET['cid']."'";
$sl_results = $db -> single($sl_sql);

$where = "&cid=".$_GET['cid']."";

            $nr = count($ep_results1); 
			if($nr > 0) {
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
                 $centerPages .= '<li> <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i.$where . '" class="page-numbers">' . $i . '</a> </li>';
            }  
	     
		 
	}
$paginationDisplay = ""; 
if ($lastPage >= 1){
   
    //$paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
    // If we are not on page 1 we can place the Back button
    if ($pn > 1) {
        
        $paginationDisplay1 =  '<li>   <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $prev.$where . '" class="page-numbers"> <i class="fa fa-angle-left"></i></a> </li> ';
    }else{
	 $paginationDisplay1 =  '<li>  <i class="fa fa-angle-left"></i></li> ';
	}
	
	if ($pn < $lastPage) {
        
        $paginationDisplay2 =  '<li>  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $lastPage.$where . '" class="page-numbers"> <i class="fa fa-angle-right"></i></a> </li>';
    }else {
		 $paginationDisplay2 =  '<li> <i class="fa fa-angle-right"></i></li>';
	}
    // Lay in the clickable numbers display here between the Back and Next links
    $paginationDisplay .= '<div class="container text-center"><ul class="page-numbers">' .$paginationDisplay1. $centerPages .$paginationDisplay2. '</ul></div>';
    // If we are not on the very last page we can place the Next button
   
}
$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage;
 $ep_sql = "select * from episodes where comic_id = '".$_GET['cid']."' and  active = '1'  order by id desc $limit";
$ep_results = $db -> result($ep_sql);
			}
			//print_R($_SERVER);
?>

		<!-- MAIN CONTENT
		================================================== -->		
		<main class="cd-main-content">
			<div ><div>
			<!-- TOP SECTION
			================================================== -->
			<section class="page-section white-section sp-top-bottom100" style="background:url('images/<?php echo $_GET['cid'].'/'.$sl_results['comic_big_image']; ?>') !important; height:700px !important;">
				<div class="container">	
		
					
				</div>
				
					<div style="float:left;"></div>
				
			</section>
			<?php if(count($ep_results1) > 0 ) { ?>	
		<section class="page-section white-section sp-top-bottom100">
				<div class="container">
					<div class="two-thirds column hs1 fontalt4 sm-bottom40"><h3>Comic Name: <?php echo $sl_results['comic_name'];?></h3></div>
					<div class="one-third column hs1 fontalt4 sm-bottom40" style="float:right; text-align: right;">
					<i class="fa fa-facebook" onclick="fbs_click();" ></i>
					<i class="fa fa-twitter" onclick="twt_click();" style="margin-left:10px;"></i>
					<i class="fa fa-instagram" style="margin-left:10px;" ></i>
					<i class="fa fa-shareit" style="margin-left:10px;" ></i>
					</div>
				</div>
				<div class="container">	
		
					<div class="two columns">						
						<h3 class="hs1 fontalt4 lp2 sm-bottom20">Episode Image</h3>
					</div>
					<div class="eight columns">						
						<h3 class="hs1 fontalt4 lp2 sm-bottom20">Episode Name</h3>
					</div>
					<div class="two columns">						
						<h3 class="hs1 fontalt4 lp2 sm-bottom20">Date</h3>
					</div>
					<div class="two columns">						
						<h3 class="hs1 fontalt4 lp2 sm-bottom20">Likes</h3>
					</div>
					<div class="two columns">						
						<h3 class="hs1 fontalt4 lp2 sm-bottom20">Action</h3>
					</div>
				</div>
					<?php foreach($ep_results as $ep_result) { 
					
					 $timestamp=$ep_result['created'];

?>
					<div class="container">	
					<div class="two columns">						
						
						<img src="images/<?php echo $ep_result['comic_id'].'/'.$ep_result['id'].'/'.$ep_result['episode_image']; ?>" alt="" height="50px" width="50px"/>
					</div>
					<div class="eight columns">						
						<a href="panels.php?epid=<?php echo $ep_result['id']; ?>&cid=<?php echo $ep_result['comic_id']; ?>"><?php echo $ep_result['episode_name']; ?></a>
					</div>
					<div class="two columns">						
					<?php  echo gmdate("Y-m-d", $timestamp); ?>
					</div>
					<div class="two columns">						
					<?php echo $ep_result['likes']; ?>
					</div>
					<div class="two columns">						
					<a href="panels.php?epid=<?php echo $ep_result['id']; ?>&cid=<?php echo $ep_result['comic_id']; ?>">View</a>
					</div>
					</div>
					<?php } ?>
					
					
				
			</section>
			<!-- pagination section -->	
		<section class="page-section white-section sp-bottom100">
				
				<?php echo $paginationDisplay; 
//die();?>
			</section>
			<?php } else { ?>
			<section class="page-section white-section sp-top-bottom100">
				<div class="container text-center">
					<div class=" hs1 fontalt4 sm-bottom40 side-line">No Records</div>
				</div>
				</section>
			<?php } ?>
		<script>	
	function fbs_click() {
		
	var url      = window.location.href; 
	
	window.open('http://www.facebook.com/sharer.php?u='+url,'_blank');
    return false;
	}
	
	function twt_click() {

	var url      = window.location.href;
	
    window.open('https://twitter.com/intent/tweet?url='+url,'_blank');
    return false;
	}
	</script>
	
<?php include('footer.php'); ?>