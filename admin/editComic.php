<?php
    include ("./header.php");
?>
<body>
<div id="wrapper">
    <?php require_once("./left_navigation.php"); ?>
    <?php
    $cid = 0;
    if(isset($_REQUEST['cid']) && $_REQUEST['cid'] > 0 ){
        $cid = $_REQUEST['cid'];
    }
    $new_comic = getComic($cid);
    extract($new_comic);
    ?>
    <script src="js/jquery-10.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <div id="page-wrapper" class="gray-bg">
        <?php require_once("./top_navigation.php") ?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-10">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h4><?php echo $id > 0 ? "Edit" : "New"; ?> Comic </h4>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="./action.php" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Comic Name</label>
                                    <div class="col-sm-6"><input name="comicName" type="text" class="form-control" value="<?php echo $comic_name; ?>" ></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Comic Abbreviation</label>
                                    <div class="col-sm-6"><input name="abbreviation" type="text" class="form-control" id="us3-abbreviation" value="<?php echo $comic_abbreviation; ?>"  autocomplete="off"/></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Comic Small Image</label>
                                    <div class="col-sm-6">
                                        <?php if($id > 0){ ?>
                                            <div class="col-sm-12"><img src="../images/<?php echo $id . "/" . $comic_image; ?>" style="width: 200px;margin-left: auto;margin-right: auto;display: block;padding: 10px;"></div>
                                        <?php } ?>
                                        <div class="col-sm-12"><input type="file" name="image" accept="image/*" /></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Comic Big Image</label>
                                    <div class="col-sm-6">
                                        <?php if($id > 0){ ?>
                                            <div class="col-sm-12"><img src="../images/<?php echo $id . "/" . $comic_big_image; ?>" style="width: 200px;margin-left: auto;margin-right: auto;display: block;padding: 10px;"></div>
                                        <?php } ?>
                                        <div class="col-sm-12"><input type="file" name="image1" accept="image/*" /></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-6"><button class="btn btn-primary" id="save" type="reset"><i class="fa fa-check"></i>&nbsp;Save</button></div>
                                </div>
                                <input type="hidden" name="cid" value="<?php echo $id; ?>" />
                                <input type="hidden" name="key" value="editComic" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("./footer.php"); ?>

    </div>
</div>

<!-- Mainly scripts -->

<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- blueimp gallery -->
<script src="js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#comics").addClass("active");
        $("#new_comic").addClass("active");
        
        $("#save").click(function(){
            $("form").submit();
        });
    });
</script>
</body>

</html>
