<?php

class querymanager extends DBManager
{
    public function getCurrentFuelStatus()
    {
        $query = $this->db->prepare("SELECT * FROM `current_fuel_status`");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        return array($results[0]);
    }

    public function getLastReadings($id)
    {
        $query = $this->db->prepare("SELECT * FROM `daily_fuel_readings` WHERE `id` = ?");
        $query->execute([$id]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        return array($results[0]);
    }

    public function getAllFuelReports()
    {
        $query = $this->db->prepare("SELECT * FROM `daily_fuel_report`;");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        return array($results);
    }

    public function getAllChequeReports()
    {
        $query = $this->db->prepare("SELECT * FROM `cheque_report`;");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        return array($results);
    }

    public function getChequeDetailsById($id)
    {
        $query = $this->db->prepare("SELECT * FROM `cheque_report` WHERE `id` = ?");
        $query->execute([$id]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        return $results[0];
    }

    public function addDelivery($delivery)
    {
        $query = $this->db->prepare("INSERT INTO `fuel_delivery_report` (`date`, `gas_L`, `diesel_L`, `super_L`, `amount`) VALUES (:delivery_date, :gas_L, :diesel_L, :super_L, :amount);");
        return $query->execute(array(
            "delivery_date" => date("Y-m-d"),
            "gas_L" => $delivery["gas_L"],
            "diesel_L" => $delivery["diesel_L"],
            "super_L" => $delivery["super_L"],
            "amount" => 0
        ));
    }

    public function addCheque($cheque)
    {
        $query = $this->db->prepare("INSERT INTO `cheque_report` (`cheque_number`, `cheque_date`, `cheque_amount`, `cheque_given_to`, `cheque_given_by`, `cheque_given_date`, `note`) VALUES (:cheque_number, :cheque_date, :cheque_amount, :cheque_given_to, :cheque_given_by, :cheque_given_date, :note);");
        return $query->execute(array(
            "cheque_number" => $cheque["cheque_number"],
            "cheque_date" => $cheque["cheque_date"],
            "cheque_amount" => $cheque["cheque_amount"],
            "cheque_given_to" => $cheque["cheque_given_to"],
            "cheque_given_by" => $cheque["cheque_given_by"],
            "cheque_given_date" => $cheque["cheque_given_date"],
            "note" => $cheque["note"]
        ));
    }

    public function updateChequeStatusById($cid)
    {
        $query = $this->db->prepare("UPDATE `cheque_report` SET `cheque_status`=:cheque_status WHERE `id`=:cid");
        return $query->execute(array(
            "cid" => $cid,
            "cheque_status" => "Deposited"
        ));
    }

    public function updateCurrentFuelStatusByAddingDelivery($delivery)
    {
        $query = $this->db->prepare("UPDATE `current_fuel_status` SET `gas_L`=:gas_L, `diesel_L` =:diesel_L, `super_L` =:super_L WHERE `last_update_id`=:last_update_id");
        return $query->execute(array(
            "gas_L" => $delivery["gas_L"] + $delivery["last_gas_L"],
            "diesel_L" => $delivery["diesel_L"] + $delivery["last_diesel_L"],
            "super_L" => $delivery["super_L"] + $delivery["last_super_L"],
            "last_update_id" => $delivery["last_update_id"]
        ));
    }

    public function updateCurrentFuelStatusByChangingPrice($pricechange)
    {
        $query = $this->db->prepare("UPDATE `current_fuel_status` SET `gas_price`=:gas_price, `diesel_price` =:diesel_price, `super_price` =:super_price WHERE `last_update_id`=:last_update_id");
        return $query->execute(array(
            "gas_price" => $pricechange["gas_price"],
            "diesel_price" => $pricechange["diesel_price"],
            "super_price" => $pricechange["super_price"],
            "last_update_id" => $pricechange["last_update_id"]
        ));
    }

    public function updateCurrentFuelStatusByEndingDay($dayend)
    {
        $query = $this->db->prepare("UPDATE `current_fuel_status` SET `gas_L`=:gas_L, `diesel_L` =:diesel_L, `super_L` =:super_L, `last_update_id` =:new_update_id WHERE `last_update_id`=:last_update_id");
        return $query->execute(array(
            "gas_L" => $dayend["current_gas_inventory"],
            "diesel_L" => $dayend["current_diesel_inventory"],
            "super_L" => $dayend["current_super_inventory"],
            "new_update_id" => $dayend["last_update_id"] + 1,
            "last_update_id" => $dayend["last_update_id"]
        ));
    }

    public function addDailyFuelReadings($readings)
    {
        $query = $this->db->prepare("INSERT INTO `daily_fuel_readings` (`date`, `gas_1_$`, `gas_1_L`, `gas_2_$`, `gas_2_L`, `diesel_$`, `diesel_L`, `super_$`, `super_L`, `epos_total`, `balance_cleared`, `on_hold`, `employee`) VALUES (:readings_date, :gas_1_D, :gas_1_L, :gas_2_D, :gas_2_L, :diesel_D, :diesel_L, :super_D, :super_L, :epos_total, :balance_cleared, :on_hold, :employee);");
        return $query->execute(array(
            "readings_date" => date("Y-m-d"),
            "gas_1_D" => floatval($readings["gas_1_$"]),
            "gas_1_L" => floatval($readings["gas_1_L"]),
            "gas_2_D" => floatval($readings["gas_2_$"]),
            "gas_2_L" => floatval($readings["gas_2_L"]),
            "diesel_D" => floatval($readings["diesel_$"]),
            "diesel_L" => floatval($readings["diesel_L"]),
            "super_D" => floatval($readings["super_$"]),
            "super_L" => floatval($readings["super_L"]),
            "epos_total" => floatval($readings["epos_total"]),
            "balance_cleared" => floatval($readings["balance_cleared"]),
            "on_hold" => floatval($readings["on_hold"]),
            "employee" => $readings["employee"]
        ));
    }

    public function addDailyFuelReadings_new($readings)
    {
        $query = $this->db->prepare("INSERT INTO `daily_fuel_readings` (`date`, `gas_1_$`, `gas_1_L`, `gas_2_$`, `gas_2_L`, `diesel_$`, `diesel_L`, `super_$`, `super_L`, `epos_total`, `balance_cleared`, `on_hold`, `employee`) VALUES (:readings_date, :gas_1_D, :gas_1_L, :gas_2_D, :gas_2_L, :diesel_D, :diesel_L, :super_D, :super_L, :epos_total, :balance_cleared, :on_hold, :employee);");
        return $query->execute(array(
            "readings_date" => date("Y-m-d"),
            "gas_1_D" => 0,
            "gas_1_L" => 0,
            "gas_2_D" => 0,
            "gas_2_L" => 0,
            "diesel_D" => 0,
            "diesel_L" => 0,
            "super_D" => 0,
            "super_L" => 0,
            "epos_total" => floatval($readings["epos_total"]),
            "balance_cleared" => floatval($readings["balance_cleared"]),
            "on_hold" => floatval($readings["on_hold"]),
            "employee" => $readings["employee"]
        ));
    }

    public function addDailyFuelReport($readings)
    {
        $query = $this->db->prepare("INSERT INTO `daily_fuel_report` (`daily_fuel_readings_id`, `date`, `gas_$`, `gas_L`, `diesel_$`, `diesel_L`, `super_$`, `super_L`, `total`, `variance`) VALUES (:daily_fuel_readings_id, :readings_date, :gas_D, :gas_L, :diesel_D, :diesel_L, :super_D, :super_L, :total, :variance);");
        return $query->execute(array(
            "daily_fuel_readings_id" => floatval($readings["last_update_id"] + 1),
            "readings_date" => date("Y-m-d"),
            "gas_D" => floatval($readings["gas_sold"]),
            "gas_L" => floatval($readings["gas_sold_L"]),
            "diesel_D" => floatval($readings["diesel_sold"]),
            "diesel_L" => floatval($readings["diesel_sold_L"]),
            "super_D" => floatval($readings["super_sold"]),
            "super_L" => floatval($readings["super_sold_L"]),
            "total" => floatval($readings["total_sold"]),
            "variance" => floatval($readings["variance"])
        ));
    }

    public function addDailyFuelReport_new($readings)
    {
        $query = $this->db->prepare("INSERT INTO `daily_fuel_report` (`daily_fuel_readings_id`, `date`, `gas_$`, `gas_L`, `diesel_$`, `diesel_L`, `super_$`, `super_L`, `total`, `variance`) VALUES (:daily_fuel_readings_id, :readings_date, :gas_D, :gas_L, :diesel_D, :diesel_L, :super_D, :super_L, :total, :variance);");
        return $query->execute(array(
            "daily_fuel_readings_id" => floatval($readings["last_update_id"] + 1),
            "readings_date" => date("Y-m-d"),
            "gas_D" => floatval($readings["gas_$"]),
            "gas_L" => floatval($readings["gas_L"]),
            "diesel_D" => floatval($readings["diesel_$"]),
            "diesel_L" => floatval($readings["diesel_L"]),
            "super_D" => floatval($readings["super_$"]),
            "super_L" => floatval($readings["super_L"]),
            "total" => floatval($readings["total_sold"]),
            "variance" => floatval($readings["variance"])
        ));
    }
}
