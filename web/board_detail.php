<?php

?>

    <!-- layout header -->
<?php require_once __DIR__ . "/component/layout_header.php"?>

    <!-- header -->
<?php require_once __DIR__ . "/component/header.php"?>

    <!-- content -->
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12">
                <div class="content-box-large">
                    <div class="panel-title">Board Report</div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="sale_report"  class="display" style="width:100%">

                        </table>
                    </div>
                    <br>
                    <br>
                    <div class=" form-inline">
                        <div class="form-group pr-2 pb-1">
                            <br>
                            <label class="label-search">Date &nbsp;:&nbsp;</label>
                            <input type="text" class="form-control custom-date" id="date_search" >
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="sale_report1"  class="display" style="width:100%">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
<?php require_once __DIR__ . "/component/footer.php"?>

    <!--custom-->
    <script src="assets/js/web/board_detail.js"></script>

    <!-- layout footer -->
<?php require_once __DIR__ . "/component/layout_footer.php"?>