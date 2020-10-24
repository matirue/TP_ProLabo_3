<?php

session_start();
session_unset();
header("LOCATION: ../frontend/login.html");

?>