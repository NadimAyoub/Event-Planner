<?php
require_once 'classes/Manager.php';
require_once 'classes/ManagerTableGateway.php';
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$pdo = Connection::getInstance();

$gateway = new ManagerTableGateway($pdo);

$gateway->delete($id);

header('Location: viewManagers.php');
?>