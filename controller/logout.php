<?php

require_once '../config.php';

//elimino tutte le sessioni
session_unset();

//dedirect to login

header('Location: ../view/login.php');
die;
