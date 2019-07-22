<?php
include ("./header.php");
?>
<body>
<div id="wrapper">
    <?php require_once("./left_navigation.php"); ?>
    <?php
        $pid = 0;
        if(isset($_REQUEST['pid']) && $_REQUEST['pid'] > 0 ){
            $pid = $_REQUEST['pid'];
        }
        $data = getPanels($pid);
        extract($data);

        $comics = adminGetComics();
    ?>
    <script src="js/jquery-10.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/plugins/chosen/chosen.css" />

    <div id="page-wrapper" class="gray-bg">
        <?php require_once("./top_navigation.php") ?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h4><?php echo $pid > 0 ? "Edit" : "New"; ?> Panel</h4>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="./action.php" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Comic Name</label>
                                    <div class="col-sm-7">
                                        <div class="col-sm-12">
                                            <select name="comicName" class="form-control input-sm" id="comicName">
                                                <?php
                                                    foreach($comics as $row):
                                                        extract($row);
                                                        if($pid > 0):
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
                                    <label class="col-sm-3 control-label">Episode Name</label>
                                    <div class="col-sm-7">
                                        <div class="col-sm-12">
                                            <select name="episodeName" class="form-control input-sm" id="episodeName">
                                                <?php
                                                    if($pid > 0):
                                                        $episodes = adminGetEpisodes($comic_id);
                                                        foreach($episodes as $row):
                                                            extract($row);
                                                            if($id == $episode_id)
                                                                echo "<option value='$id' selected>$episode_name</option>";
                                                            else
                                                                echo "<option value='$id'>$episode_name</option>";
                                                        endforeach;
                                                    else:
                                                        $episodes = adminGetEpisodes(-1);
                                                        foreach($episodes as $row):
                                                            extract($row);
                                                            echo "<option value='$id'>$episode_name</option>";
                                                        endforeach;
                                                    endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Panel</label>
                                    <div class="col-sm-7">
                                        <?php if($pid > 0){ ?>
                                            <div class="col-sm-12"><img src="../images/<?php echo $comic_id . "/" . $episode_id . "/" . $panel_image; ?>" style="width: 200px;margin-left: auto;margin-right: auto;display: block;padding: 10px;"></div>
                                        <?php } ?>
                                        <div class="col-sm-12"><input type="file" name="panels[]" accept="image/*" multiple /></div>
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-5"><button class="btn btn-primary " type="submit"><i class="fa fa-check"></i>&nbsp;Save</button></div>
                                    <div class="col-sm-2"></div>
                                </div>
                                <input type="hidden" name="pid" value="<?php echo $pid; ?>" />
                                <input type="hidden" name="key" value="editPanel" />
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
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/plugins/chosen/chosen.jquery.js"></script>

<!-- blueimp gallery -->
<script src="js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#panels").addClass("active");
        $("#new_panel").addClass("active");
        
        $("#comicName").change(function() {
            var comic_id = $(this).val();
            
            $.post(
                "action.php",
                {
                    key: "ajax_get_episode",
                    comic_id: comic_id
                },
                function(response) {
                    episodesArray = JSON.parse(response);
                    var str = "";
                    for(var row in episodesArray) {
                        console.log(episodesArray[row].id);
                        str += "<option value='" + episodesArray[row].id + "'>" + episodesArray[row].episode_name + "</option>";
                    }
                    $("#episodeName").html(str);
                }
            );
        });
    });
</script>
</body>

</html>
