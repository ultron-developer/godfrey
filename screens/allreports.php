<?php
include("../head.inc.php");
$queryMgr = new querymanager();
$allReports = $queryMgr->getAllFuelReports();
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
            background: white;
            position: sticky;
            top: 0;
        }

        #managerTable {
            max-height: 500px;
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
    <div class="container mt-3">
        <h3 class="text-center">All Reports</h3>
        <hr>
        <div id="managerTable" class="container" style="overflow-x:auto;">
            <table class="table-sm table-bordered table-striped text-center border" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Gas($)</th>
                        <th scope="col">Gas(L)</th>
                        <th scope="col">Diesel($)</th>
                        <th scope="col">Diesel(L)</th>
                        <th scope="col">Super($)</th>
                        <th scope="col">Super(L)</th>
                        <th scope="col">Total($)</th>
                        <th scope="col">Total(L)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $megatotal_d = 0;
                    $megatotal_l = 0;
                    for ($i = count($allReports[0]) - 1; $i >= 16; $i--) {
                        $megatotal_d += $allReports[0][$i]['total'];
                        $total_l = $allReports[0][$i]['gas_L'] + $allReports[0][$i]['diesel_L'] + $allReports[0][$i]['super_L'];
                        $megatotal_l += $total_l;
                    ?>
                        <tr>
                            <td><?php echo $allReports[0][$i]['date']; ?></td>
                            <td><?php echo $allReports[0][$i]['gas_$']; ?></td>
                            <td><?php echo $allReports[0][$i]['gas_L']; ?></td>
                            <td><?php echo $allReports[0][$i]['diesel_$']; ?></td>
                            <td><?php echo $allReports[0][$i]['diesel_L']; ?></td>
                            <td><?php echo $allReports[0][$i]['super_$']; ?></td>
                            <td><?php echo $allReports[0][$i]['super_L']; ?></td>
                            <td><?php echo $allReports[0][$i]['total']; ?></td>
                            <td><?php echo ($allReports[0][$i]['gas_L'] + $allReports[0][$i]['diesel_L'] + $allReports[0][$i]['super_L']); ?></td>
                        </tr>
                    <?php
                    } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><span style="font-weight:bold">Totals:</span></td>
                        <td><span style="font-weight:bold"><?php echo $megatotal_d; ?></span></td>
                        <td><span style="font-weight:bold"><?php echo $megatotal_l; ?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>