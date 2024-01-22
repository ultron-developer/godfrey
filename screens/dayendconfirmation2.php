<?php
include("../head.inc.php");
$data = $_SESSION['dailyCalculation'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Godfrey/Day_end_details</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand font-weight-bold text-white" style="text-shadow: 2px 2px 4px #000000;" href="#">Godfrey Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <a class="nav-link f-right" href="delivery">Back</a> -->
</nav>

<body>
    <div class="container mt-3">
        <h3 class="text">Confirm The Details</h3>
        <hr class="my-1">
        <h5 class="text-center">Today's Readings</h5>
        <hr class="my-1">
        <div class="container text-center">
            <div class="row">
                <div class="col-3">
                    <h6 class="my-2">Gas 1</h6>
                    <p class="mb-1"><?php echo $data["gas_1_$"]; ?></p>
                    <p class="mb-1"><?php echo $data["gas_1_L"]; ?></p>
                </div>
                <div class="col-3">
                    <h6 class="my-2">Gas 2</h6>
                    <p class="mb-1"><?php echo $data["gas_2_$"]; ?></p>
                    <p class="mb-1"><?php echo $data["gas_2_L"]; ?></p>
                </div>
                <div class="col-3">
                    <h6 class="my-2">Diesel</h6>
                    <p class="mb-1"><?php echo $data["diesel_$"]; ?></p>
                    <p class="mb-1"><?php echo $data["diesel_L"]; ?></p>
                </div>
                <div class="col-3">
                    <h6 class="my-2">Super</h6>
                    <p class="mb-1"><?php echo $data["super_$"]; ?></p>
                    <p class="mb-1"><?php echo $data["super_L"]; ?></p>
                </div>
            </div>
        </div>
        <hr class="my-1">
        <div class="container text-center">
            <div class="row">
                <div class="col-3">
                    <h6 class="my-2">Epos Total</h6>
                    <p class="mb-1"><?php echo $data["epos_total"]; ?></p>
                </div>
                <div class="col-3">
                    <h6 class="my-2">On Hold</h6>
                    <p class="mb-1"><?php echo $data["on_hold"]; ?></p>
                </div>
                <div class="col-3">
                    <h6 class="my-2">Balance Cleared</h6>
                    <p class="mb-1"><?php echo $data["balance_cleared"]; ?></p>
                </div>
                <div class="col-3">
                    <h6 class="my-2">Total Varience</h6>
                    <p class="mb-1"><?php echo $data["variance"]; ?></p>
                </div>
            </div>
        </div>
        <hr class="my-1">
        <hr class="mt-3 mb-1">
        <h5 class="text-center">Today's Sell</h5>
        <hr class="my-1">
        <div class="container text-center">
            <div class="row">
                <div class="col-3">
                    <h6 class="my-2">Gas</h6>
                    <p class="mb-1"><?php echo $data["gas_sold"]; ?></p>
                    <p class="mb-1"><?php echo $data["gas_sold_L"]; ?></p>
                </div>
                <div class="col-3">
                    <h6 class="my-2">Diesel</h6>
                    <p class="mb-1"><?php echo $data["diesel_sold"]; ?></p>
                    <p class="mb-1"><?php echo $data["diesel_sold_L"]; ?></p>
                </div>
                <div class="col-3">
                    <h6 class="my-2">Super</h6>
                    <p class="mb-1"><?php echo $data["super_sold"]; ?></p>
                    <p class="mb-1"><?php echo $data["super_sold_L"]; ?></p>
                </div>
                <div class="col-3">
                    <h6 class="my-2">Total</h6>
                    <p class="mb-1"><?php echo $data["total_sold"]; ?></p>
                </div>
            </div>
        </div>
        <hr class="my-1">
        <hr class="mt-3 mb-1">
        <h5 class="text-center">Fuel Inventory</h5>
        <hr class="my-1">
        <div class="container text-center">
            <div class="row">
                <div class="col-4">
                    <h6 class="my-2">Gas</h6>
                    <p class="mb-1"><?php echo $data["current_gas_inventory"]; ?></p>
                </div>
                <div class="col-4">
                    <h6 class="my-2">Diesel</h6>
                    <p class="mb-1"><?php echo $data["current_diesel_inventory"]; ?></p>
                </div>
                <div class="col-4">
                    <h6 class="my-2">Super</h6>
                    <p class="mb-1"><?php echo $data["current_super_inventory"]; ?></p>
                </div>
            </div>
        </div>
        <hr class="my-1">
        <div class="container text-center">
            <form action="controllers/fuel_controller.php" method="post">
                <input type="hidden" name="action" value="dayEndConfirmation">
                <a class="btn btn-danger mt-2 text-white" href="dayend">Cancel</a>
                <button class="btn btn-warning mt-2" type="submit">Day end</button>
            </form>
        </div>
    </div>
</body>

</html>