<?php
trait Basededatos
{
    protected function pdo()
    {
        $host = "mysql:host=localhost;dbname=bd_biblioteca";
        $username = "root";
        $password = "";
        $option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING];

        try {
            $pdo = new PDO($host, $username, $password, $option);
            if ($pdo instanceof PDO) {
                return $pdo;
            } else {
                throw new Exception(message: "Database not found");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
