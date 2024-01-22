<?php
class DBManager
{
    const HOST = "localhost";
    const USER = "root";
    const PASS = "";
    const DBNAME = "godfrey";

    protected $db = null;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DBNAME, self::USER, self::PASS);

            //show mysql errors
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            //show character encoding
            $this->db->exec("set names utf8");
        } catch (Exception $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }
}
