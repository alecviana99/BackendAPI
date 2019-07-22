<?php
include ("./header.php");
?>
<body>
<link href="css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
<style>
    .t_b{font-weight : bold; }
</style>
<div id="wrapper">
    <?php require_once("./left_navigation.php"); ?>
    <div id="page-wrapper" class="gray-bg">
        <?php require_once("./top_navigation.php") ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2 style="font-weight: bold">Dashboard</h2>
            </div>
        </div>
        <?php include("./footer.php"); ?>

    </div>
</div>



<!-- Mainly scripts -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- blueimp gallery -->
<script src="js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".gallery_photo").mouseover(function(){
            var id = $(this).attr("id");
            var new_id = id.replace("photo_","");
            $("#close_"+new_id).fadeIn();
        });
        $(".gallery_photo").mouseout(function(){
            var id = $(this).attr("id");
            var new_id = id.replace("photo_","");
            $("#close_"+new_id).fadeOut();
        });
        
        $("i.fa.fa-th-large").parent().parent().addClass("active");
    });
</script>
</body>

</html>
