<?php
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$pdo = Connection::getInstance();

$gateway = new LocationTableGateway($pdo);

$gateway->delete($id);

header('Location: viewLocations.php');