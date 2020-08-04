<?php
require_once 'classes/Offers.php';
require_once 'classes/OfferTableGateway.php';
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$pdo = Connection::getInstance();

$gateway = new OfferTableGateway($pdo);

$gateway->delete($id);

header('Location: viewOffers.php');