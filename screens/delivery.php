<?php
include("../head.inc.php");
$queryMgr = new querymanager();
$currentData = $queryMgr->getCurrentFuelStatus()[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Godfrey/Delivery</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="#">Delivery<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="chequereport">Cheque Report</a>
            </li>
        </ul>
    </div>
</nav>

<body>
    <div class="container mt-3">
        <h3 class="text-center">Add Delivery</h3>
        <hr>
        <div class="container">
            <form action="controllers/fuel_controller.php" method="post">
                <input type="hidden" name="action" value="addDelivery">
                <input type="hidden" name="last_gas_L" value='<?php echo $currentData["gas_L"] ?>'>
                <input type="hidden" name="last_diesel_L" value='<?php echo $currentData["diesel_L"] ?>'>
                <input type="hidden" name="last_super_L" value='<?php echo $currentData["super_L"] ?>'>
                <input type="hidden" name="last_update_id" value='<?php echo $currentData["last_update_id"] ?>'>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Gas</span>
                            </div>
                            <input type="number" name="gas_L" class="form-control" step="0.001" id="" placeholder="Liters" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Diesel</span>
                            </div>
                            <input type="number" name="diesel_L" class="form-control" id="" placeholder="Liters" step="0.001" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Super</span>
                            </div>
                            <input type="number" name="super_L" class="form-control" id="" placeholder="Liters" step="0.001" required>
                        </div>
                    </div>
                    <!-- <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Total amount</span>
                            </div>
                            <input type="number" name="amount" class="form-control" id="" placeholder="$" step="0.01" required>
                        </div>
                    </div> -->
                    <div class="col-12 text-center">
                        <hr>
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>