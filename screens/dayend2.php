<?php
include("../head.inc.php");
$queryMgr = new querymanager();
$currentData = $queryMgr->getCurrentFuelStatus()[0];
$lastReadings = $queryMgr->getLastReadings($currentData["last_update_id"])[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Godfrey/Day_end</title>
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
            <li class="nav-item active">
                <a class="nav-link active" href="#">Day End<span class="sr-only">(current)</span></a>
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
        <h3 class="text-center">Day End</h3>
        <hr>
        <div class="container">
            <form action="controllers/fuel_controller.php" method="post">
                <input type="hidden" name="action" value="dailyCalculation">
                <input type="hidden" name="last_gas_1_$" value='<?php echo $lastReadings["gas_1_$"] ?>'>
                <input type="hidden" name="last_gas_1_L" value='<?php echo $lastReadings["gas_1_L"] ?>'>
                <input type="hidden" name="last_gas_2_$" value='<?php echo $lastReadings["gas_2_$"] ?>'>
                <input type="hidden" name="last_gas_2_L" value='<?php echo $lastReadings["gas_2_L"] ?>'>
                <input type="hidden" name="last_diesel_$" value='<?php echo $lastReadings["diesel_$"] ?>'>
                <input type="hidden" name="last_diesel_L" value='<?php echo $lastReadings["diesel_L"] ?>'>
                <input type="hidden" name="last_super_$" value='<?php echo $lastReadings["super_$"] ?>'>
                <input type="hidden" name="last_super_L" value='<?php echo $lastReadings["super_L"] ?>'>
                <input type="hidden" name="last_gas_inventory" value='<?php echo $currentData["gas_L"] ?>'>
                <input type="hidden" name="last_diesel_inventory" value='<?php echo $currentData["diesel_L"] ?>'>
                <input type="hidden" name="last_super_inventory" value='<?php echo $currentData["super_L"] ?>'>
                <input type="hidden" name="last_update_id" value='<?php echo $currentData["last_update_id"] ?>'>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Gas 1</span>
                            </div>
                            <input type="number" name="gas_1_$" step="0.01" class="form-control" id="" placeholder="$" aria-describedby="inputGroupPrepend3" value="<?php echo isset($_SESSION['dailyCalculation']) ? $_SESSION['dailyCalculation']['gas_1_$'] : ""; ?>" required>
                            <input type="number" name="gas_1_L" step="0.001" class="form-control" id="" placeholder="Liters" aria-describedby="inputGroupPrepend3" value="<?php echo isset($_SESSION['dailyCalculation']) ? $_SESSION['dailyCalculation']['gas_1_L'] : ""; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Gas 2</span>
                            </div>
                            <input type="number" name="gas_2_$" step="0.01" class="form-control" id="" placeholder="$" aria-describedby="inputGroupPrepend3" value="<?php echo isset($_SESSION['dailyCalculation']) ? $_SESSION['dailyCalculation']['gas_2_$'] : ""; ?>" required>
                            <input type="number" name="gas_2_L" step="0.001" class="form-control" id="" placeholder="Liters" aria-describedby="inputGroupPrepend3" value="<?php echo isset($_SESSION['dailyCalculation']) ? $_SESSION['dailyCalculation']['gas_2_L'] : ""; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Diesel</span>
                            </div>
                            <input type="number" name="diesel_$" step="0.01" class="form-control" id="" placeholder="$" aria-describedby="inputGroupPrepend3" value="<?php echo isset($_SESSION['dailyCalculation']) ? $_SESSION['dailyCalculation']['diesel_$'] : ""; ?>" required>
                            <input type="number" name="diesel_L" step="0.001" class="form-control" id="" placeholder="Liters" aria-describedby="inputGroupPrepend3" value="<?php echo isset($_SESSION['dailyCalculation']) ? $_SESSION['dailyCalculation']['diesel_L'] : ""; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Super 1</span>
                            </div>
                            <input type="number" name="super_$" step="0.01" class="form-control" id="" placeholder="$" aria-describedby="inputGroupPrepend3" value="<?php echo isset($_SESSION['dailyCalculation']) ? $_SESSION['dailyCalculation']['super_$'] : ""; ?>" required>
                            <input type="number" name="super_L" step="0.001" class="form-control" id="" placeholder="Liters" aria-describedby="inputGroupPrepend3" value="<?php echo isset($_SESSION['dailyCalculation']) ? $_SESSION['dailyCalculation']['super_L'] : ""; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Epos Total</span>
                            </div>
                            <input type="number" name="epos_total" step="0.01" class="form-control" id="" placeholder="$" aria-describedby="inputGroupPrepend3" value="<?php echo isset($_SESSION['dailyCalculation']) ? $_SESSION['dailyCalculation']['epos_total'] : ""; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">On Hold</span>
                            </div>
                            <input type="number" name="on_hold" step="0.01" class="form-control" id="" placeholder="$" aria-describedby="inputGroupPrepend3" value="<?php echo isset($_SESSION['dailyCalculation']) ? $_SESSION['dailyCalculation']['on_hold'] : ""; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Balance Clreared</span>
                            </div>
                            <input type="number" name="balance_cleared" step="0.01" class="form-control" id="" placeholder="$" aria-describedby="inputGroupPrepend3" value="<?php echo isset($_SESSION['dailyCalculation']) ? $_SESSION['dailyCalculation']['balance_cleared'] : ""; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Employee</span>
                            </div>
                            <select class="form-control" name="employee" id="">
                                <option value="Mihir">Mihir</option>
                                <option value="Krushap">Krushap</option>
                                <option value="Rumeshbhai">Rumeshbhai</option>
                            </select>
                        </div>
                    </div>
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