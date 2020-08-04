<?php
require_once 'classes/EventRegistration.php';
require_once 'classes/EventRegistrationGateway.php';
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$pdo = Connection::getInstance();

$gateway = new RegistrationTableGateway($pdo);

if (isset($_GET['id'])) {
$gateway->delete($id);
header('Location: viewRegistrations.php');
}else{
    header('Location: viewRegistrations.php');
}

