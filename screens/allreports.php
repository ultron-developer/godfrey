<?php
include("../head.inc.php");
$queryMgr = new querymanager();
if (!isset($_SESSION["filter_month"])) {
    $_SESSION["filter_month"] = date("n") . "";
}
if (!isset($_SESSION["filter_year"])) {
    $_SESSION["filter_year"] = date("Y") . "";
}
if (!isset($_SESSION["filter_year_2"])) {
    $_SESSION["filter_year_2"] = date("Y") . "";
}
if (isset($_SESSION["filter_name"])) {
    switch ($_SESSION["filter_name"]) {

        case "all_reports":
            $allReports = $queryMgr->getAllFuelReports();
            break;
        case "filter_by_month_year":
            $allReports = $queryMgr->fetchDataByMonthYear($_SESSION["filter_month"], $_SESSION["filter_year"]);
            break;
        case "totals_month_wise":
            $allReports = $queryMgr->fetchDataByMonthWise($_SESSION["filter_year_2"]);
            break;
        case "totals_year_wise":
            $allReports = $queryMgr->fetchDataByYearWise();
            break;
    }
} else {
    $_SESSION["filter_name"] = "all_reports";
    $allReports = $queryMgr->getAllFuelReports();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Godfrey/All_reports</title>
    <style>
        table {
            text-align: left;
            position: relative;
        }

        th {
            background: black;
            position: sticky;
            top: 0;
        }

        #managerTable {
            max-height: 420px;
            overflow: auto;
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand font-weight-bold text-white" style="text-shadow: 2px 2px 4px #000000;" href="#">Godfrey Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link active" href="#">All Reports<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="lastupdate">Last Update</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dayend">Day End</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pricechange">Price Change</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="delivery">Delivery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="chequereport">Cheque Report</a>
            </li>
        </ul>
    </div>
</nav>

<body>
    <div class="container my-3">
        <h3 class="text-center">All Reports</h3>
        <hr>
        <select class="form-select" id="select_filter" onchange="toggle_filters()">
            <option <?php echo ($_SESSION['filter_name'] == "all_reports") ? "selected" : "" ?> value="all_reports">All Reports</option>
            <option <?php echo ($_SESSION['filter_name'] == "filter_by_month_year") ? "selected" : "" ?> value="filter_by_month_year">Filter By Month,Year</option>
            <option <?php echo ($_SESSION['filter_name'] == "totals_month_wise") ? "selected" : "" ?> value="totals_month_wise">Totals Month Wise</option>
            <option <?php echo ($_SESSION['filter_name'] == "totals_year_wise") ? "selected" : "" ?> value="totals_year_wise">Totals Year Wise</option>
        </select>
        <div id="all_reports" class="mt-2" style="display: none;">
            <form action="controllers/filters.php" method="post" id="all_reports_form">
                <input type="hidden" name="action" value="all_reports">
            </form>
        </div>
        <div id="filter_by_month_year" class="mt-2" style="display: none;">
            <form action="controllers/filters.php" method="post" id="filter_by_month_year_form">
                <input type="hidden" name="action" value="filter_by_month_year">
                <select class="form-select" id="select_month" name="select_month" onchange="this.form.submit()">
                    <option <?php echo ($_SESSION['filter_month'] == "1") ? "selected" : "" ?> value="1">January</option>
                    <option <?php echo ($_SESSION['filter_month'] == "2") ? "selected" : "" ?> value="2">February</option>
                    <option <?php echo ($_SESSION['filter_month'] == "3") ? "selected" : "" ?> value="3">March</option>
                    <option <?php echo ($_SESSION['filter_month'] == "4") ? "selected" : "" ?> value="4">April</option>
                    <option <?php echo ($_SESSION['filter_month'] == "5") ? "selected" : "" ?> value="5">May</option>
                    <option <?php echo ($_SESSION['filter_month'] == "6") ? "selected" : "" ?> value="6">June</option>
                    <option <?php echo ($_SESSION['filter_month'] == "7") ? "selected" : "" ?> value="7">July</option>
                    <option <?php echo ($_SESSION['filter_month'] == "8") ? "selected" : "" ?> value="8">August</option>
                    <option <?php echo ($_SESSION['filter_month'] == "9") ? "selected" : "" ?> value="9">September</option>
                    <option <?php echo ($_SESSION['filter_month'] == "10") ? "selected" : "" ?> value="10">October</option>
                    <option <?php echo ($_SESSION['filter_month'] == "11") ? "selected" : "" ?> value="11">November</option>
                    <option <?php echo ($_SESSION['filter_month'] == "12") ? "selected" : "" ?> value="12">December</option>
                </select>
                <select class="form-select" id="select_year" name="select_year" onchange="this.form.submit()">
                    <option <?php echo ($_SESSION['filter_year'] == "2024") ? "selected" : "" ?> value="2024">2024</option>
                    <option <?php echo ($_SESSION['filter_year'] == "2023") ? "selected" : "" ?> value="2023">2023</option>
                </select>
            </form>
        </div>
        <div id="totals_month_wise" class="mt-2" style="display: none;">
            <form action="controllers/filters.php" method="post" id="totals_month_wise_form">
                <input type="hidden" name="action" value="totals_month_wise">
                <select class="form-select" id="select_year_2" name="select_year_2" onchange="this.form.submit()">
                    <option <?php echo ($_SESSION['filter_year_2'] == "2024") ? "selected" : "" ?> value="2024">2024</option>
                    <option <?php echo ($_SESSION['filter_year_2'] == "2023") ? "selected" : "" ?> value="2023">2023</option>
                </select>
            </form>
        </div>
        <div id="totals_year_wise" class="mt-2" style="display: none;">
            <form action="controllers/filters.php" method="post" id="totals_year_wise_form">
                <input type="hidden" name="action" value="totals_year_wise">
            </form>
        </div>
        <div id="managerTable" class="mt-2" style="overflow-x:auto;">
            <table class="table table-sm table-striped table-dark text-center" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Total($)</th>
                        <th scope="col">Total(L)</th>
                        <th scope="col">Gas($)</th>
                        <th scope="col">Gas(L)</th>
                        <th scope="col">Diesel($)</th>
                        <th scope="col">Diesel(L)</th>
                        <th scope="col">Super($)</th>
                        <th scope="col">Super(L)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $megatotal_d = 0;
                    $megatotal_l = 0;
                    for ($i = count($allReports[0]) - 1; $i >= 0; $i--) {
                        $megatotal_d += $allReports[0][$i]['total'];
                        $total_l = $allReports[0][$i]['gas_L'] + $allReports[0][$i]['diesel_L'] + $allReports[0][$i]['super_L'];
                        $megatotal_l += $total_l;
                    ?>
                        <tr>
                            <td><?php echo $allReports[0][$i]['date']; ?></td>
                            <td><?php echo $allReports[0][$i]['total']; ?></td>
                            <td><?php echo ($allReports[0][$i]['gas_L'] + $allReports[0][$i]['diesel_L'] + $allReports[0][$i]['super_L']); ?></td>
                            <td><?php echo $allReports[0][$i]['gas_$']; ?></td>
                            <td><?php echo $allReports[0][$i]['gas_L']; ?></td>
                            <td><?php echo $allReports[0][$i]['diesel_$']; ?></td>
                            <td><?php echo $allReports[0][$i]['diesel_L']; ?></td>
                            <td><?php echo $allReports[0][$i]['super_$']; ?></td>
                            <td><?php echo $allReports[0][$i]['super_L']; ?></td>
                        </tr>
                    <?php
                    } ?>
                    <tr>
                        <td><span style="font-weight:bold">Totals:</span></td>
                        <td><span style="font-weight:bold"><?php echo $megatotal_d; ?></span></td>
                        <td><span style="font-weight:bold"><?php echo $megatotal_l; ?></span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    function submit_filter_form() {

    }

    function toggle_filters() {
        var filter_div1 = document.getElementById('filter_by_month_year');
        var filter_div2 = document.getElementById('totals_month_wise');
        var selected_filter = document.getElementById('select_filter').value;
        if (selected_filter == "filter_by_month_year") {
            filter_div1.style.display = "block";
            filter_div2.style.display = "none";
            document.getElementById(selected_filter + "_form").submit();
        } else if (selected_filter == "totals_month_wise") {
            filter_div1.style.display = "none";
            filter_div2.style.display = "block";
            document.getElementById(selected_filter + "_form").submit();
        } else if (selected_filter == "totals_year_wise") {
            filter_div1.style.display = "none";
            filter_div2.style.display = "none";
            document.getElementById(selected_filter + "_form").submit();
        } else {
            filter_div1.style.display = "none";
            filter_div2.style.display = "none";
            document.getElementById(selected_filter + "_form").submit();
        }

    }

    //toggle_filters();

    var filter_div1 = document.getElementById('filter_by_month_year');
    var filter_div2 = document.getElementById('totals_month_wise');
    var selected_filter = document.getElementById('select_filter').value;
    if (selected_filter == "filter_by_month_year") {
        filter_div1.style.display = "block";
        filter_div2.style.display = "none";
    } else if (selected_filter == "totals_month_wise") {
        filter_div1.style.display = "none";
        filter_div2.style.display = "block";
    } else if (selected_filter == "totals_year_wise") {
        filter_div1.style.display = "none";
        filter_div2.style.display = "none";
    } else {
        filter_div1.style.display = "none";
        filter_div2.style.display = "none";
    }
</script>

</html>