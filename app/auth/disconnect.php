<?php
include('../includes/function.php');
session_unset();
session_destroy();
header('location:/Académie_de_magie/index.php');