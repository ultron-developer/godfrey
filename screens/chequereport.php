<?php
include("../head.inc.php");
$queryMgr = new querymanager();
$allcheques = $queryMgr->getAllChequeReports();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Godfrey/Cheque_report</title>
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
            <li class="nav-item">
                <a class="nav-link" href="allreports">All Reports</a>
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
                <a class="nav-link active" href="chequereport">Cheque Report</a>
            </li>
        </ul>
    </div>
</nav>

<body>
    <div class="container mt-3 text-center">
        <a href="addcheque" class="btn btn-success mb-3">Add New Cheque</a>
        <h5 class="text-center">Not Deposited Yet!</h5>
        <hr>
        <div id="managerTable" class="container" style="overflow-x:auto;    ">
            <table class="table-sm table-bordered table-striped text-center border" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th scope="col">Action</th>
                        <th scope="col">Cheque #</th>
                        <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">To</th>
                        <th scope="col">Given By</th>
                        <th scope="col">Note</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $megatotal = 0;
                    for ($i = count($allcheques[0]) - 1; $i >= 0; $i--) {
                        if ($allcheques[0][$i]['cheque_status'] == "Not Deposited") {
                            $megatotal += $allcheques[0][$i]['cheque_amount'];
                    ?>
                            <tr>
                                <td><a href="chequedetails?chequeid=<?php echo $allcheques[0][$i]['id']; ?>" style="color:red;">Remove</a></td>
                                <td><?php echo $allcheques[0][$i]['cheque_number']; ?></td>
                                <td><?php echo date("M jS, Y", strtotime($allcheques[0][$i]['cheque_date'])); ?></td>
                                <td><?php echo "$ " . $allcheques[0][$i]['cheque_amount']; ?></td>
                                <td><?php echo $allcheques[0][$i]['cheque_given_to']; ?></td>
                                <td><?php echo $allcheques[0][$i]['cheque_given_by'] . " on " . date("M jS, Y", strtotime($allcheques[0][$i]['cheque_given_date'])); ?></td>
                                <td><?php echo $allcheques[0][$i]['note']; ?></td>
                                <td><?php echo $allcheques[0][$i]['cheque_status']; ?></td>
                            </tr>
                    <?php
                        }
                    } ?>
                </tbody>
            </table>
        </div>
        <hr>
        <h5>Balance Pending : <?php echo "$ " . $megatotal; ?></h5>
    </div>
</body>

</html>