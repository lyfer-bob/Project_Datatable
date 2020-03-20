<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap Admin Theme v3</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="css/jquery-ui.css" rel="stylesheet" media="screen">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- dataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.1/css/rowGroup.dataTables.min.css">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!--timepicker-->
    <link href="../build/jquery.datetimepicker.min.css" rel="stylesheet">
    <!-- custom css -->
    <link href="../css/custom.css"  rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
        tr.ex1 {display: none;}
    </style>
</head>
<body>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="../index.php">Happy2JDE</a></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="row">
        <? require_once('web/slidebar.php') ?>
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

</div>
</div>


<!-- jquery -->
<script src ="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

<!-- bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<!-- dataTables -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.1.1/js/dataTables.rowGroup.min.js"></script>

<!--timepicker-->
<script src="../build/jquery.datetimepicker.full.js"></script>

<!--    date-->
<!--<script src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!--custom-->
<script src="../js/custom.js"></script>>
<script src="../js/timepicker.js"></script>
<!--<script src="js/change.js"></script>-->
<script src="../js/change.js"></script>

</body>
</html>
