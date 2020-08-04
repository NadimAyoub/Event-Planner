<?php
require_once 'classes/Sponsors.php';
require_once 'classes/SponsorTableGateway.php';
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$pdo = Connection::getInstance();

$gateway = new SponsorTableGateway($pdo);

$gateway->delete($id);

header('Location: viewSponsors.php');
?>