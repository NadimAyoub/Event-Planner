
    <?php
    $host = "localhost";
    $dbname = "eventplanning";
    $username = "root";
    $password = "";
    $dsn = "mysql:host=$host;port=3306;dbname=$dbname";
    try{
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>