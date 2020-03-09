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

    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!--timepicker-->
    <link href="build/jquery.datetimepicker.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="index.html">Bootstrap Admin Theme</a></h1>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
	                         <button class="btn btn-primary" type="button">Search</button>
	                       </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b
                                            class="caret"></b></a>
                                <ul class="dropdown-menu animated fadeInUp">
                                    <li><a href="profile.html">Profile</a></li>
                                    <li><a href="login.html">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-md-2">
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav">

                    <li><a href="index.html"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="calendar.html"><i class="glyphicon glyphicon-calendar"></i> Calendar</a></li>
                    <li><a href="stats.html"><i class="glyphicon glyphicon-stats"></i> Statistics (Charts)</a></li>
                    <li class="current"><a href="tables.html"><i class="glyphicon glyphicon-list"></i> Tables</a></li>
                    <li><a href="buttons.html"><i class="glyphicon glyphicon-record"></i> Buttons</a></li>
                    <li><a href="editors.html"><i class="glyphicon glyphicon-pencil"></i> Editors</a></li>
                    <li><a href="forms.html"><i class="glyphicon glyphicon-tasks"></i> Forms</a></li>
                    <li class="submenu">
                        <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Pages
                            <span class="caret pull-right"></span>
                        </a>

                        <ul>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="signup.html">Signup</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">

            <div class="row">
                <div class="col-md-6">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Basic Table</div>

                            <div class="panel-options">
                                <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                                <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Striped Rows</div>

                            <div class="panel-options">
                                <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                                <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Border Table</div>

                            <div class="panel-options">
                                <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                                <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Hover Rows</div>

                            <div class="panel-options">
                                <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                                <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Condensed Table</div>

                            <div class="panel-options">
                                <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                                <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Table with row classes</div>

                            <div class="panel-options">
                                <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                                <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="success">
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr class="danger">
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr class="warning">
                                    <td>3</td>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Responsive Tables</div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="content-box-large">
                        <div class="panel-title">Batch Detail</div>
                        <div class=" form-inline">
                            <div class="form-group pr-2 pb-1">
                                <label class="label-search">วันที่ &nbsp;:&nbsp;</label>
                                <input type="text" class="form-control custom-date"  id="picker" max/>
                            </div>
                            <div class="form-group pr-2 pb-1">
                                <label class="label-search">Batch &nbsp;:&nbsp;</label>
                                <select class="form-control custom-select" id="batch_serch" >
                                    <option value="">--bacth detail--</option>
                                </select>
                            </div>
                            <div class="form-group pr-2 pb-1">
                                <label class="label-search">Type &nbsp;:&nbsp;</label>
                                <select class="form-control custom-select" id="type_serch">
                                    <option value="">--bacth detail--</option>
                                </select>
                            </div>
                            <div class="form-group pr-2 pb-1">
                                <label class="label-search">Type &nbsp;:&nbsp;</label>
                                <select class="form-control custom-select" id="type_serch" onchange="getval(this);">
                                    <option value="">--bacth detail--</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                </select>
                            </div>


                        </div>


                            <div class="table-responsive">
                            <table id="tbBat" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>BatchNumber</th>
                                    <th>Invoice No.</th>
                                    <th>PO Date</th>
                                    <th>Amount.</th>
                                    <th>Shipping BY</th>
                                    <th>Shipping Package</th>
                                    <th>Customer Name</th>
                                    <th>items</th>


                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <?php
//            include 'lib/dbconfig.php';
//            $sql = "SELECT BatchNumber,invoice_number,po_date,pay_amount,shipping_by,shipping_package,tax_name,items->>'$.*.item_code' itemcode ,items->>'$.*.ProductName' Name  ,
//		                items->>'$.*.PricePerUnit' UnitPrice  , items->>'$.*.QTY' QTY  ,items->>'$.*.ProductGroupID' ProductGroupID FROM TaxInvoice_detail where BatchNumber = '2020-03-04 16:11:02' ";
//            $result = $conn->query($sql);
            ?>

            <?php
            // include 'ex_datatables/index.php';
            /* echo  "<div class=\"panel-heading\">";
             echo  "<div class=\"panel-title\">Batch Detail</div>";
             echo  "</div>";
             echo  "<div class=\"panel-body\">";
             echo  "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-striped table-bordered\" id=\"example\">";
             echo  "<thead>";
             echo  "<tr>";
             echo  "<th>BatchNumber</th>";
             echo  "<th>Invoice No.</th>";
             echo  "<th>PO Date</th>";
             echo  "<th>Amount</th>";
             echo  "<th>Shipping BY</th>";
             echo  "<th>Shipping Package</th>";
             echo  "<th>Customer Name</th>";
             echo  "<th>items</th>";
             echo  "</tr>";
             echo  "</thead>";
             echo  "<tbody>";
             while( $row = $result->fetch_array(MYSQLI_BOTH) ){
                 echo "<tr>";
                 echo "<td>".$row['BatchNumber']."</td>";
                 echo "<td>".$row['invoice_number']."</td>";
                 echo "<td style=\"width: 80px;\">".$row['po_date']."</td>";
                 echo "<td>".$row['pay_amount']."</td>";
                 echo "<td>".$row['shipping_by']."</td>";
                 echo "<td>".$row['shipping_package']."</td>";
                 echo "<td>".$row['tax_name']."</td>";
                 echo "<td>".expand_items($row['Name'],$row['QTY'],$row['UnitPrice'])."</td>";
                 echo "</tr>";
              }


         echo "</tbody></table></div></div>";
         $conn->close();
         function expand_items($item_l,$qty_l,$up_l){
             $tmp1 = preg_replace('/\"|\[|\]/', '', $item_l);
             $tmp2 = explode(",",$tmp1);
             $tmp3 = preg_replace('/\"|\[|\]/', '', $qty_l);
             $tmp4 = explode(",",$tmp3);
             $tmp5 = preg_replace('/\"|\[|\]/', '', $up_l);
             $tmp6 = explode(",",$tmp5);
             $jj=0;
             foreach ($tmp2 as $values){
                 @$item.="<p>".$values."จำนวน ".$tmp4[$jj]." ราคา ".$tmp6[$jj];
                 @$item.="</p>";
                 $jj++;
             }
             return $item;
             }*/
            ?>


        </div>
    </div>
</div>

<footer>
    <div class="container">

        <div class="copy text-center">
            Copyright 2014 <a href='#'>Website</a>
        </div>

    </div>
</footer>


<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script data-require="jqueryui@*" data-semver="1.10.0" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.js"></script>

<!-- bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<!-- dataTables -->
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<!--    date-->
<!--<script src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script src= "build/jquery.datetimepicker.full.js"></script>
<script>
    $('#picker').datetimepicker({ //**-< add datae timpicker by class  $('.picker') if use date by id =  $('#picker')
        timepicker: false,
        datepicker: true,
        format: 'd-m-Y',
        value: Date.now(),
        weeks: true
    })
</script>


<script>
    $(document).ready(function () {
        $('#tbBat').DataTable({
            paging: true,
            searching: true,
            // "serverSide": true, **add test slide
            "processing": true, // add waittime processing datatable
            "ajax": {
                "url": "data/batch_inv_rec.php",
                "dataSrc": ""
            },
            //"ajax": "data/batch_inv_rec.php",
            columns: [

                {"data": "BatchNumber"},
                {"data": "invoiceNumber"},
                {"data": "poDate", "className": "col-width-70"},
                {"data": "payAmount"},
                {"data": "shippingBy", "className": "dt[-head|-body]-center"},
                {
                    "data": null, "className": "dt-body-center",//alingh datatable = "center"
                    "render": function (data, type, row) { //check data = "" -> data="0"
                        let result = "";
                        if (row.shippingPackage === "") {
                            result = "0";
                        } else {
                            result = row.shippingPackage;
                        }
                        return result;
                    },

                },
                // { "data": "shippingPackage" }, ** data =! 0 when data =""
                {"data": "taxName", "className": "col-width-100"},
                {"data": "itemDetail"}
                /*{ "data": "productName" }, **don't using column
                { "data": "unitPrice" },
                { "data": "qty" },
                { "data": "productGroupID" },
                { "data": "itemDetail" }*/
            ]
        });
    });
</script>
<script>
    function getval(sel)
    {
        alert(sel.value);
    }</script>
</body>
</html>
