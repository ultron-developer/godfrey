<?php
include "../head.inc.php";
$action = $_REQUEST['action'];
$_SESSION["filter_name"] = $action;

switch ($action) {

    case "filter_by_month_year":

        $_SESSION["filter_month"] = $_POST['select_month'];
        $_SESSION["filter_year"] = $_POST['select_year'];
        break;

    case "totals_month_wise":

        $_SESSION["filter_year_2"] = $_POST['select_year_2'];
        break;
}

//var_dump($_SESSION);

header("Location: ../allreports");
