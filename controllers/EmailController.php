<?php

require_once("../config/connection.php");
require_once("../models/Emails.php");

$email = new Emails();

switch($_GET['op'])
{
    case "emailConfirmed":
        $email->confirmedEmail($_POST['email']);
        break;
}

?>