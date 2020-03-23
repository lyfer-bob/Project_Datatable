<?php

?>

    <!-- layout header -->
<?php require_once __DIR__ . "/component/layout_header.php" ?>

    <!-- header -->
<?php require_once __DIR__ . "/component/header.php" ?>

    <!-- content -->
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12">
                <div class="content-box-large">
                    <div class="panel-title">Sale Report</div>
                    <br>
                    <br>
                    <div class=" form-inline">
                        <div class="form-group pr-2 pb-1">
                            <label class="label-search">PM &nbsp;:&nbsp;</label>
                            <select class="form-control custom-select" id="batch_search">
                                <option value="null">--PM--</option>
                            </select>
                        </div>
                        <div class="form-group pr-2 pb-1">
                            <label class="label-search">&nbsp;&nbsp; PE &nbsp;:&nbsp;</label>
                            <select class="form-control custom-select" id="batch_search">
                                <option value="null">--PE--</option>
                            </select>
                        </div>
                    </div>
                <br>
                <div class="table-responsive">
                    <table id="sale_report" class="display" style="width:100%">

                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- footer -->
<?php require_once __DIR__ . "/component/footer.php" ?>

    <!--custom-->
    <script src="assets/js/web/sale_detail.js"></script>

    <!-- layout footer -->
<?php require_once __DIR__ . "/component/layout_footer.php" ?>