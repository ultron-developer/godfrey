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
    <title>Godfrey/Last_updates</title>
</head>

<div class="social">
    <a href="https://www.linkedin.com/in/florin-cornea-b5118057/" target="_blank">
        <i class="fa fa-linkedin"></i>
    </a>
</div>
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
                <a class="nav-link active" href="#">Last Update<span class="sr-only">(current)</span></a>
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
        <div style="display:flex;">
            <h3 class="text-left d-inline-block">Last Update</h3>
            <p class="mt-auto mr-0 ml-auto text-right d-inline-block" style="margin-bottom: 8px;">(<?php echo $lastReadings["date"] ?> - <?php echo $lastReadings["employee"] ?>)</p>
        </div>
        <hr class="my-1">
        <div class="mt-4" style="display:flex;">
            <h4 class="text-center d-inline-block">Fuel Inventory</h4>
            <p class="mt-auto mr-0 ml-auto text-right d-inline-block" style="margin-bottom: 8px;">(Updated on: <?php echo $currentData["last_update"] ?>)</p>
        </div>
        <hr class="my-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-4 text-center">
                    <div class="border rounded m-1">
                        <h5 class="my-2">Gas</h5>
                        <hr class="my-2">
                        <h6><?php echo $currentData["gas_price"] ?> $/L</h6>
                        <div id="fluid-meter-regular"></div>
                        <h6><?php echo $currentData["gas_L"] ?> L</h6>
                        <input type="hidden" id="percentage-1" type="number" value="<?php echo $currentData["gas_L"] / 135; ?>">
                        <button style="display: none;" onclick="set_regular_percentage()" id="submit-percentage-regular">submit</button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-4 text-center">
                    <div class="border rounded m-1">
                        <h5 class="my-2">Diesel</h5>
                        <hr class="my-2">
                        <h6><?php echo $currentData["diesel_price"] ?> $/L</h6>
                        <div id="fluid-meter-diesel"></div>
                        <h6><?php echo $currentData["diesel_L"] ?> L</h6>
                        <input type="hidden" id="percentage-2" type="number" value="<?php echo $currentData["diesel_L"] / 135; ?>">
                        <button style="display: none;" onclick="set_diesel_percentage()" id="submit-percentage-diesel">submit</button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-4 text-center">
                    <div class="border rounded m-1">
                        <h5 class="my-2">Super</h5>
                        <hr class="my-2">
                        <h6><?php echo $currentData["super_price"] ?> $/L</h6>
                        <div id="fluid-meter-super"></div>
                        <h6><?php echo $currentData["super_L"] ?> L</h6>
                        <input type="hidden" id="percentage-3" type="number" value="<?php echo $currentData["super_L"] / 45.5; ?>">
                        <button style="display: none;" onclick="set_super_percentage()" id="submit-percentage-super">submit</button>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-1">
        <div class="my-2 text-center">
            <input class="form-control-input" type="checkbox" value="" id="show_readings_toggle" onclick="toggle_the_div()">
            <label class="form-control-label text-white m-0" for="show_readings_toggle">
                Show Last Readings
            </label>
        </div>
        <hr class="my-1">
        <div id="last_readings" style="display: none;">
            <h5 class="text-center">Last Readings</h5>
            <hr class="my-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-6 text-center">
                        <div class="border rounded m-1">
                            <h5 class="my-2">Gas 1</h5>
                            <hr class="my-2">
                            <h6><?php echo $lastReadings["gas_1_$"] ?> $</h6>
                            <h6><?php echo $lastReadings["gas_1_L"] ?> L</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 text-center">
                        <div class="border rounded m-1">
                            <h5 class="my-2">Gas 2</h5>
                            <hr class="my-2">
                            <h6><?php echo $lastReadings["gas_2_$"] ?> $</h6>
                            <h6><?php echo $lastReadings["gas_2_L"] ?> L</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 text-center">
                        <div class="border rounded m-1">
                            <h5 class="my-2">Diesel</h5>
                            <hr class="my-2">
                            <h6><?php echo $lastReadings["diesel_$"] ?> $</h6>
                            <h6><?php echo $lastReadings["diesel_L"] ?> L</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 text-center">
                        <div class="border rounded m-1">
                            <h5 class="my-2">Super 1</h5>
                            <hr class="my-2">
                            <h6><?php echo $lastReadings["super_$"] ?> $</h6>
                            <h6><?php echo $lastReadings["super_L"] ?> L</h6>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-1">
        </div>
    </div>
    <script>
        function toggle_the_div() {
            if (document.getElementById('show_readings_toggle').checked) {
                document.getElementById('last_readings').style.display = "block";
            } else {
                document.getElementById('last_readings').style.display = "none";
            }
        }

        var fm_regular = new FluidMeter();
        fm_regular.init({
            targetContainer: document.getElementById("fluid-meter-regular"),
            fillPercentage: 25,
            options: {
                fontSize: "15px",
                drawPercentageSign: true,
                drawBubbles: true,
                size: 70,
                borderWidth: 5,
                backgroundColor: "#262626",
                foregroundColor: "#4C4A4A",
                foregroundFluidLayer: {
                    fillStyle: "#53a31a",
                    angularSpeed: 30,
                    maxAmplitude: 5,
                    frequency: 30,
                    horizontalSpeed: -20
                },
                backgroundFluidLayer: {
                    fillStyle: "#2b570b",
                    angularSpeed: 100,
                    maxAmplitude: 3,
                    frequency: 22,
                    horizontalSpeed: 20
                }
            }
        });
        var fm_diesel = new FluidMeter();
        fm_diesel.init({
            targetContainer: document.getElementById("fluid-meter-diesel"),
            fillPercentage: 25,
            options: {
                fontSize: "15px",
                drawPercentageSign: true,
                drawBubbles: true,
                size: 70,
                borderWidth: 5,
                backgroundColor: "#262626",
                foregroundColor: "#4C4A4A",
                foregroundFluidLayer: {
                    fillStyle: "#93b02e",
                    angularSpeed: 30,
                    maxAmplitude: 5,
                    frequency: 30,
                    horizontalSpeed: -20
                },
                backgroundFluidLayer: {
                    fillStyle: "#394209 ",
                    angularSpeed: 100,
                    maxAmplitude: 3,
                    frequency: 22,
                    horizontalSpeed: 20
                }
            }
        });
        var fm_super = new FluidMeter();
        fm_super.init({
            targetContainer: document.getElementById("fluid-meter-super"),
            fillPercentage: 25,
            options: {
                fontSize: "15px",
                drawPercentageSign: true,
                drawBubbles: true,
                size: 70,
                borderWidth: 5,
                backgroundColor: "#262626",
                foregroundColor: "#4C4A4A",
                foregroundFluidLayer: {
                    fillStyle: "#892eb0",
                    angularSpeed: 30,
                    maxAmplitude: 5,
                    frequency: 30,
                    horizontalSpeed: -20
                },
                backgroundFluidLayer: {
                    fillStyle: "#091657",
                    angularSpeed: 100,
                    maxAmplitude: 3,
                    frequency: 22,
                    horizontalSpeed: 20
                }
            }
        });

        function set_regular_percentage() {
            fm_regular.setPercentage(Number(document.getElementById('percentage-1').value));
        }

        function set_diesel_percentage() {
            fm_diesel.setPercentage(Number(document.getElementById('percentage-2').value));
        }

        function set_super_percentage() {
            fm_super.setPercentage(Number(document.getElementById('percentage-3').value));
        }
        document.getElementById('submit-percentage-regular').click();
        document.getElementById('submit-percentage-diesel').click();
        document.getElementById('submit-percentage-super').click();
    </script>
</body>

</html>