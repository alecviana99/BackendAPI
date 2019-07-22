<?php
    include ("./header.php");
?>
<body>

<div id="wrapper">
<?php require_once("./left_navigation.php"); ?>
    <div id="page-wrapper" class="gray-bg">
<?php require_once("./top_navigation.php") ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2 style="font-weight: bold">Episode List</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <button id="new" style="float: right;margin-bottom: 20px;" type="button" class="btn btn-w-m btn-primary">New Episode</button>
            </div>
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <?php $episodes = adminGetEpisodes(); ?>
                        <table class="table table-striped table-bordered table-hover " id="editable" >
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Episode Name</th>
                                    <th>Episode Abbreviation</th>
                                    <th>Episode Image</th>
                                    <th>Comic Name</th>
                                    <th>Likes</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $index = 1;
                                foreach($episodes as $row){
                                    extract($row);
                                    echo '<tr class="gradeU">';
                                    echo "<th align='center'>" . $index . "</th>";
                                    echo "<td>$episode_name</td>";
                                    echo "<td>$e_abbreviation</td>";
                                    echo '<th><div style="width:80px;height:60px;">
                                            <img src="../images/' . $comic_id . '/' . $id . '/' . $episode_image . '" style="max-width:100%;max-height:100%;"></div>
                                            </th>';
                                    echo "<td>$comic_name</td>";
                                    echo "<td>$likes</td>";
                                    if($active == 0):
//                                        echo "<td><input type='checkbox' id='$id' class='chk_active' checked value='$active' /></td>";
                                        echo "<td><a href='./action.php?key=active&eid=" . $id . "&value=0' class='btn btn-default btn-circle'><i class='fa fa-check'></i></a>";
                                    else:
//                                        echo "<td><input type='checkbox' id='$id' class='chk_active' value='$active' /></td>";
                                        echo "<td><a href='./action.php?key=active&eid=" . $id . "&value=1' class='btn btn-info btn-circle'><i class='fa fa-check'></a>";
                                    endif;
                                    echo '<td>
                                            <a href="./editEpisode.php?key=edit&eid=' . $id . '" class="chk" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="./action.php?key=e_moveFirst&eid=' . $id . '" class="btn" rel="tooltip" title="Move to First Episode"><i class="fa fa-toggle-up"></i></a>
                                            <a href="./action.php?key=delEpisode&eid='. $id . '" class="btn" rel="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>
                                          </td>';
                                    echo '</tr>';
                                    $index ++;
                                }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Number</th>
                                    <th>Episode Name</th>
                                    <th>Episode Abbreviation</th>
                                    <th>Episode Image</th>
                                    <th>Comic Name</th>
                                    <th>Likes</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
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
    <script src="js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Data Tables -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });

            /* Init DataTables */
            var oTable = $('#editable').dataTable();
            $("#new").click(function(){
                document.location.href = "./editEpisode.php";
            });
            
            $("#episodes").addClass("active");
            $("#view_episodes").addClass("active");
            
            /*$(".chk_active").click(function() {
                var id = this.id;
                var value = this.value;
                
                $.post(
                    "action.php",
                    {
                        key: "ajax_set_active",
                        episode_id: id,
                        value: value
                    },
                    function(response) {
                        document.location.href = "";
                    }
                );
            });*/

        });

    </script>
<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>
</body>

</html>