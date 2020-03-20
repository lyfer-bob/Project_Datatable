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
                <div class="panel-title">Batch Detail</div>
                <div class=" form-inline">
                    <div class="form-group pr-2 pb-1">
                        <br>
                        <label class="label-search">Date &nbsp;:&nbsp;</label>
                        <input type="text" class="form-control custom-date" id="date_search" >
                    </div>
                    <div class="form-group pr-2 pb-1">
                        <br>
                        <label class="label-search">Type &nbsp;:&nbsp;</label>
                        <select class="form-control custom-select" id="type_search">
                            <option value="Invoice">Invoice</option>
                            <option value="Receive">Receive</option>
                            <option value="Creditnote">Creditnote</option>
                        </select>
                    </div>
                    <div class="form-group pr-2 pb-1">
                        <br>
                        <label class="label-search"> &nbsp;  &nbsp;Batch &nbsp;:&nbsp;</label>
                        <select class="form-control custom-select" id="batch_search">
                            <option value="null">--batch detail--</option>
                        </select>
                    </div>
                    <br>
                    <br>
                </div>
                <div class="table-responsive">
                    <table id="tbBat"  class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>BatchNumber</th>
                            <th>Invoice No.</th>
                            <th>PO Date</th>
                            <th>Amount</th>
                            <th>Ship BY</th>
                            <th>Ship Pack</th>
                            <th>Cus Name</th>
                            <th>Items</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
<?php require_once __DIR__ . "/component/footer.php"?>

<!--custom-->
<script src="assets/js/web/batch_detail.js"></script>

<!-- layout footer -->
<?php require_once __DIR__ . "/component/layout_footer.php"?>