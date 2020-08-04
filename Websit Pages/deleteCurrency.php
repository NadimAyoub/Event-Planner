<?php
require_once 'classes/Currency.php';
require_once 'classes/CurrencyTableGateway.php';
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$pdo = Connection::getInstance();

$gateway = new CurrencyTableGateway($pdo);

$gateway->delete($id);

header('Location: viewCurrency.php');
?>