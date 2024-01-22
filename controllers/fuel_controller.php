<?php
include "../head.inc.php";
$query = new querymanager();
$action = $_REQUEST['action'];

function check_roatation($fuel_D, $fuel_L, $fuel_Price)
{
    $new_fuel_L = $fuel_L;

    if ($new_fuel_L < 0) {
        $new_fuel_L = $new_fuel_L + 1000;
    }

    if ($new_fuel_L != 0) {
        while (true) {
            $division_amount = $fuel_D / $new_fuel_L;
            $flag = $division_amount - $fuel_Price;
            if ($flag > 0.15) {
                $new_fuel_L = $new_fuel_L + 1000;
            } else {
                break;
            }
        }
    }

    return $new_fuel_L;
}

switch ($action) {

    case "addDelivery":

        $query->addDelivery($_POST);
        $query->updateCurrentFuelStatusByAddingDelivery($_POST);
        header("Location: ../lastupdate");

        break;

    case "addCheque":

        $query->addCheque($_POST);
        header("Location: ../chequereport");

        break;

    case "dailyCalculation_new":

        var_dump($_POST);
        $_SESSION['dailyCalculation'] = $_POST;
        $total_sold = round($_POST["gas_$"] + $_POST["diesel_$"] + $_POST["super_$"], 2);
        $total_sold_L = round($_POST["gas_L"] + $_POST["diesel_L"] + $_POST["super_L"], 2);
        $_SESSION['dailyCalculation'] += ["total_sold" => $total_sold];
        $_SESSION['dailyCalculation'] += ["total_sold_L" => $total_sold_L];

        $current_gas_inventory = round($_SESSION['dailyCalculation']['last_gas_inventory'] - $_POST["gas_L"], 3);
        $current_diesel_inventory = round($_SESSION['dailyCalculation']['last_diesel_inventory'] - $_POST["diesel_L"], 3);
        $current_super_inventory = round($_SESSION['dailyCalculation']['last_super_inventory'] - $_POST["super_L"], 3);
        $_SESSION['dailyCalculation'] += ["current_gas_inventory" => $current_gas_inventory];
        $_SESSION['dailyCalculation'] += ["current_diesel_inventory" => $current_diesel_inventory];
        $_SESSION['dailyCalculation'] += ["current_super_inventory" => $current_super_inventory];

        $variance = round($_SESSION['dailyCalculation']['epos_total'] + $_SESSION['dailyCalculation']['on_hold'] - $_SESSION['dailyCalculation']['balance_cleared'] - $total_sold, 2);
        $_SESSION['dailyCalculation'] += ["variance" => $variance];
        header("Location: ../dayendconfirmation");
        break;

    case "dailyCalculation":

        $_SESSION['dailyCalculation'] = $_POST;
        $currentData = $query->getCurrentFuelStatus()[0];

        $gas1_sold = $_SESSION['dailyCalculation']['gas_1_$'] - $_SESSION['dailyCalculation']['last_gas_1_$'];
        $gas1_sold = round($gas1_sold >= 0 ? $gas1_sold : $gas1_sold + 10000, 2);
        $gas1_sold_L = $_SESSION['dailyCalculation']['gas_1_L'] - $_SESSION['dailyCalculation']['last_gas_1_L'];
        $gas1_sold_L = round(check_roatation($gas1_sold, $gas1_sold_L, $currentData["gas_price"]), 3);

        $gas2_sold = $_SESSION['dailyCalculation']['gas_2_$'] - $_SESSION['dailyCalculation']['last_gas_2_$'];
        $gas2_sold = round($gas2_sold >= 0 ? $gas2_sold : $gas2_sold + 10000, 2);
        $gas2_sold_L = $_SESSION['dailyCalculation']['gas_2_L'] - $_SESSION['dailyCalculation']['last_gas_2_L'];
        $gas2_sold_L = round(check_roatation($gas2_sold, $gas2_sold_L, $currentData["gas_price"]), 3);

        $gas_sold = $gas1_sold + $gas2_sold;
        $gas_sold_L = $gas1_sold_L + $gas2_sold_L;

        $diesel_sold = $_SESSION['dailyCalculation']['diesel_$'] - $_SESSION['dailyCalculation']['last_diesel_$'];
        $diesel_sold = round($diesel_sold >= 0 ? $diesel_sold : $diesel_sold + 10000, 2);
        $diesel_sold_L = $_SESSION['dailyCalculation']['diesel_L'] - $_SESSION['dailyCalculation']['last_diesel_L'];
        $diesel_sold_L = round(check_roatation($diesel_sold, $diesel_sold_L, $currentData["diesel_price"]), 3);

        $super_sold = $_SESSION['dailyCalculation']['super_$'] - $_SESSION['dailyCalculation']['last_super_$'];
        $super_sold = round($super_sold >= 0 ? $super_sold : $super_sold + 10000, 2);
        $super_sold_L = $_SESSION['dailyCalculation']['super_L'] - $_SESSION['dailyCalculation']['last_super_L'];
        $super_sold_L = round(check_roatation($super_sold, $super_sold_L, $currentData["super_price"]), 3);


        $total_sold = round($gas_sold + $diesel_sold + $super_sold, 2);

        $current_gas_inventory = round($_SESSION['dailyCalculation']['last_gas_inventory'] - $gas_sold_L, 3);
        $current_diesel_inventory = round($_SESSION['dailyCalculation']['last_diesel_inventory'] - $diesel_sold_L, 3);
        $current_super_inventory = round($_SESSION['dailyCalculation']['last_super_inventory'] - $super_sold_L, 3);

        $variance = round($_SESSION['dailyCalculation']['epos_total'] + $_SESSION['dailyCalculation']['on_hold'] - $_SESSION['dailyCalculation']['balance_cleared'] - $total_sold, 2);
        $_SESSION['dailyCalculation'] += ["gas_sold" => $gas_sold];
        $_SESSION['dailyCalculation'] += ["gas_sold_L" => $gas_sold_L];
        $_SESSION['dailyCalculation'] += ["diesel_sold" => $diesel_sold];
        $_SESSION['dailyCalculation'] += ["diesel_sold_L" => $diesel_sold_L];
        $_SESSION['dailyCalculation'] += ["super_sold" => $super_sold];
        $_SESSION['dailyCalculation'] += ["super_sold_L" => $super_sold_L];
        $_SESSION['dailyCalculation'] += ["total_sold" => $total_sold];
        $_SESSION['dailyCalculation'] += ["variance" => $variance];
        $_SESSION['dailyCalculation'] += ["current_gas_inventory" => $current_gas_inventory];
        $_SESSION['dailyCalculation'] += ["current_diesel_inventory" => $current_diesel_inventory];
        $_SESSION['dailyCalculation'] += ["current_super_inventory" => $current_super_inventory];

        header("Location: ../dayendconfirmation");

        break;

    case "dayEndConfirmation":

        $query->updateCurrentFuelStatusByEndingDay($_SESSION['dailyCalculation']);
        $query->addDailyFuelReadings($_SESSION['dailyCalculation']);
        $query->addDailyFuelReport($_SESSION['dailyCalculation']);
        unset($_SESSION['dailyCalculation']);
        header("Location: ../lastupdate");

        break;

    case "new_dayEndConfirmation":

        $query->updateCurrentFuelStatusByEndingDay($_SESSION['dailyCalculation']);
        $query->addDailyFuelReadings_new($_SESSION['dailyCalculation']);
        $query->addDailyFuelReport_new($_SESSION['dailyCalculation']);
        unset($_SESSION['dailyCalculation']);
        header("Location: ../lastupdate");

        break;

    case "priceChange":

        $query->updateCurrentFuelStatusByChangingPrice($_POST);
        header("Location: ../lastupdate");

        break;

    case "depositTheCheque":

        $query->updateChequeStatusById($_POST['cheque_id']);
        header("Location: ../chequereport");

        break;
}
