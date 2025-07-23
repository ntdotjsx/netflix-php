<?php
$DATABASE = new class {
    private $host = "localhost";
    private $db_name = "your_database";
    private $username = "your_username";
    private $password = "your_password";
    private $conn;

    public function __construct($host = null, $db_name = null, $username = null, $password = null)
    {
        if ($host)
            $this->host = $host;
        if ($db_name)
            $this->db_name = $db_name;
        if ($username)
            $this->username = $username;
        if ($password)
            $this->password = $password;
    }

    // เชื่อมต่อฐานข้อมูล
    public function connect()
    {
        $this->conn = null;

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
            exit;
        }

        return $this->conn;
    }
}

?>