<?php
include_once("db.php");
include 'functions.php';

$smsName = !empty( churchSMSname(1) )?churchSMSname(1):"Uplus";
echo "$smsName";
?>