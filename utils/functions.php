<?php
require_once 'classes/User.php';
require_once 'classes/Admin.php';

function is_logged_in() {
    start_session();
    
    return (isset($_SESSION['user']));
}
function start_session() {
    $id = session_id();
    if ($id === "") {
        session_start();
    }
}
?>
