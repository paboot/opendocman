<?php
include('../odm-load.php');
include('../udf_functions.php');

session_start();

if (!isset($_SESSION['uid']))
{
    header('Location:index.php?redirection=' . urlencode($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']));
    exit;
}

$last_message = (isset($_REQUEST['last_message']) ? $_REQUEST['last_message'] : '');
draw_header('Help Section', $last_message);

echo "<h1>UNDER CONSTRUCTION</h1>";
?>