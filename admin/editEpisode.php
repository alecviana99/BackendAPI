<?php
    include ("./header.php");
?>
<body>
<div id="wrapper">
    <?php require_once("./left_navigation.php"); ?>
    <?php
    $eid = 0;
    if(isset($_REQUEST['eid']) && $_REQUEST['eid'] > 0 ){
        $eid = $_REQUEST['eid'];
    }
    $new_episode = getEpisode($eid);
    extract($new_episode);
    
    $comics = adminGetComics();
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
                            <h4><?php echo $eid > 0 ? "Edit" : "New"; ?> Episode </h4>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="./action.php" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Comic Name</label>
                                    <div class="col-sm-6">
                                        <div class="col-sm-12">
                                            <select name="comicName" class="form-control input-sm">
                                                <?php
                                                    foreach($comics as $row):
                                                        extract($row);
                                                        if($eid > 0):
                                                            if($comic_id == $id):
                                                                echo "<option value='$id' selected>$comic_name</option>";
                                                            else:
                                                                echo "<option value='$id'>$comic_name</option>";
                                                            endif;
                                                        else:
                                                            echo "<option value='$id'>$comic_name</option>";
                                                        endif;
                                                    endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Episode Name</label>
                                    <div class="col-sm-6"><input name="episode_name" type="text" class="form-control" value="<?php echo $episode_name; ?>" ></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Episode Abbreviation</label>
                                    <div class="col-sm-6"><input name="e_abbreviation" type="text" class="form-control" id="us3-abbreviation" value="<?php echo $e_abbreviation; ?>"  autocomplete="off" /></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Episode Image</label>
                                    <div class="col-sm-6">
                                        <?php if($eid > 0){ ?>
                                            <div class="col-sm-12"><img src="../images/<?php echo $comic_id . "/" . $eid . "/" . $episode_image; ?>" style="width: 200px;margin-left: auto;margin-right: auto;display: block;padding: 10px;"></div>
                                        <?php } ?>
                                        <div class="col-sm-12"><input type="file" name="image" accept="image/*" /></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-6"><button class="btn btn-primary" id="save" type="reset"><i class="fa fa-check"></i>&nbsp;Save</button></div>
                                </div>
                                <input type="hidden" name="eid" value="<?php echo $eid; ?>" />
                                <input type="hidden" name="key" value="editEpisode" />
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
        $("#episodes").addClass("active");
        $("#new_episode").addClass("active");
        
        $("#save").click(function(){
            $("form").submit();
        });
    });
</script>
</body>

</html>
