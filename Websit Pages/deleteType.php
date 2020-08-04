<?php
require_once 'classes/Types.php';
require_once 'classes/EventTypeTableGateway.php';
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$pdo = Connection::getInstance();

$gateway = new EventTypeTableGateway($pdo);

$gateway->delete($id);

header('Location: viewTypes.php');
?>