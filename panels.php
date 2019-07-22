<?php include('header.php'); 

$ep_sql1 = "select episodes.*, panels.* from panels
				 left join episodes  on
				 episodes.id = panels.episode_id 
				 where comic_id = '".$_GET['cid']."' group by panels.episode_id ";
$ep_results1 = $db -> result($ep_sql1);



   $ep_sql3 = "select episodes.*, panels.* from panels 
		left join episodes  on episodes.id = panels.episode_id 
		where comic_id = '".$_GET['cid']."' group by panels.episode_id order by panels.episode_id asc";
	$ep_results3 = $db -> result($ep_sql3);	
	//print_R($ep_results3);
		foreach($ep_results3 as $ep_result3)
		{
			$t_epd[] = $ep_result3['episode_id'];
		}
		//print_R($t_epd);
		//echo count($t_epd);
	$epdid_n = array_search($_GET['epidd'],$t_epd);
	$epdid_n = $epdid_n + 1;
	if(count($t_epd) == $epdid_n)
	{
		$epdid_n = 0;
	}else{
		$epdid_n;
	}
	;
if($_GET['epid'] !='')
{
	$epdid = $_GET['epid'];
}else{
	$epdid = $t_epd[$epdid_n];
}
$total_pages = count($ep_results1);

 $limit = 1;     
                           //how many items to show per page
	if($_GET['pn'] !='')
	{
    $page = $_GET['pn'];
	}else 
	{
	$page = '1';	
	}

    if($page) 
        $start = ($page - 1) * $limit;          //first item to display on this page
    else
        $start = 0;                             //if no page var is given, set start to 
    /* Get data. */
  
$ep_sql2 = "select episodes.id from panels
				 left join episodes  on
				 episodes.id = panels.episode_id 
				 where comic_id = '".$_GET['cid']."' group by panels.episode_id order by id  LIMIT $start, $limit  ";
$ep_results2 = $db -> single($ep_sql2);
$where ='&epidd='.$epdid.'&cid='.$_GET['cid']; 
    /* Setup page vars for display. */
    if ($page == 0) $page = 1;   	//if no page var is given, default to 1.
	 $page;
    $prev = $page - 1;                          //previous page is page - 1
     $next = $page + 1;                          //next page is page + 1
     $lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
     $lpm1 = $lastpage - 1;                      //last page minus 1

    $pagination = "";
    if($lastpage > 1)
    {   
        $pagination .= '<div class="text-center "><ul class="page-numbers">';
        //previous button
        if ($page > 1) 
            $pagination.= "<li><a href='". $_SERVER['PHP_SELF'] ."?pn=".$prev.$where."' class='page-numbers'><i class='fa fa-angle-left'></i>&nbsp;Prev</a></li> ";
        else
            $pagination.= "<li><i class='fa fa-angle-left'></i>&nbsp;Prev</li>"; 
       $pagination.="&nbsp;&nbsp;&nbsp;  <a href=episodes.php?cid=".$_GET['cid'].">".$epdid."</a> &nbsp; &nbsp;&nbsp;";
        //next button
        if ($page < $lastpage) 
		    $pagination.= "<li><a href='". $_SERVER['PHP_SELF'] ."?pn=".$next.$where."' >Next&nbsp;<i class='fa fa-angle-right'></i></a></li>";
        else
            $pagination.= "<li>Next&nbsp;<i class='fa fa-angle-right'></i></li>";
        $pagination.= "</ul></div>";      
    }

$ep_sql12 = "select * from episodes where id = '".$epdid."' ";
$ep_results12 = $db -> single($ep_sql12);

$pl_sql = "select * from panels where episode_id = '".$epdid."' order by id asc";
$pl_results = $db -> result($pl_sql);
?>
<div class="scroll-to-bottom"><i class="fa fa-angle-down"></i></div>			
		<!-- MAIN CONTENT
		================================================== -->		
		<main class="cd-main-content">
			
			<!-- TOP SECTION
			================================================== -->
			
	<?php if(count($pl_results) > 0 ) { ?>
	
	
			<section class="page-section white-section sp-top-bottom100">
				<div class="container">
					<div class="two-thirds column hs1 fontalt4 sm-bottom40"><h3>Comic Name: <?php echo $ep_results12['episode_name']; ?></h3></div>
					<div class="one-third column hs1 fontalt4 sm-bottom40" style="float:right"><?php echo $pagination; ?></div>
				</div>
				<div class="container">
<?php foreach($pl_results as $sl_result) {
$ep_sql1 = "select comic_id from episodes where id = '".$sl_result['episode_id']."' ";
$ep_results1 = $db -> single($ep_sql1);

	?>				
					<div class="offset-by-two fourteen columns">
						<div class="section-title text-center">
							<img src="images/<?php echo $ep_results1['comic_id'].'/'.$sl_result['episode_id'].'/'.$sl_result['panel_image'];?>" alt=""/>	
						</div>
					</div>
<?php } ?>
				</div>
			</section>
			<?php } else { ?>
			<section class="page-section white-section sp-top-bottom100">
				<div class="container text-center">
					<div class=" hs1 fontalt4 sm-bottom40 side-line">No Records</div>
				</div>
				</section>
			<?php } ?>
<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div>		
			
<?php include('footer.php'); ?>