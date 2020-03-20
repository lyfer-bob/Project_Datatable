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
                    <div class="panel-title">Invoice Report</div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="sale_report"  class="display" style="width:100%">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
<?php require_once __DIR__ . "/component/footer.php"?>

    <!--custom-->
    <script src="assets/js/web/invoice_detail.js"></script>

    <!-- layout footer -->
<?php require_once __DIR__ . "/component/layout_footer.php"?>