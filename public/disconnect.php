<?php

// J'inclus le fichier de config
require '../inc/config.php';

// VOTRE CODE

session_destroy();

header('Location: index.php');
exit;

// FIN CODE