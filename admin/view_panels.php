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
                <h2 style="font-weight: bold">Panels</h2>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <?php $panels = adminPanels(); ?>
                            <table class="table table-striped table-bordered table-hover " id="editable" >
                                <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Comic Name</th>
                                    <th>Episode Name</th>
                                    <th>Panel Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $index = 1;
                                foreach($panels as $panel){
                                    extract($panel);
                                    echo '<tr class="gradeU">';
                                    echo "<th>" . $index . "</th>";
                                    echo "<th>" . $comic_name . "</th>";
                                    echo "<th>" . $episode_name . "</th>";
                                    echo "<th><img src='../images/" . $comic_id . "/" . $episode_id . "/" . $panel_image ."' style='width : 200px'></th>";
                                    echo '<th>
                                                <a href="./editPanel.php?key=edit&pid=' . $id . '" class="btn" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="./action.php?key=p_moveFirst&pid=' . $id . '" class="btn" rel="tooltip" title="Move to First Panel"><i class="fa fa-toggle-up"></i></a>
                                                <a href="./action.php?key=delPanel&pid=' . $id . '" class="btn" rel="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>
                                            </th>';
                                    echo '</tr>';        
                                    $index ++;
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Number</th>
                                    <th>Comic Name</th>
                                    <th>Episode Name</th>
                                    <th>Panel Image</th>
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
        $("#new").click(function(){
            document.location.href = "./editSubCategory.php";
        });

        /* Init DataTables */
        var oTable = $('#editable').dataTable();

        /* Apply the jEditable handlers to the table */
        oTable.$('td').editable( '../example_ajax.php', {
            "callback": function( sValue, y ) {
                var aPos = oTable.fnGetPosition( this );
                oTable.fnUpdate( sValue, aPos[0], aPos[1] );
            },
            "submitdata": function ( value, settings ) {
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition( this )[2]
                };
            },

            "width": "90%",
            "height": "100%"
        } );

        $("#panels").addClass("active");
        $("#view_panels").addClass("active");
        
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
