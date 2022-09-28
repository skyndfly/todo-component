<?php
if( !session_id() ) @session_start();
require "../vendor/autoload.php";



\App\clasess\Router::rout();


