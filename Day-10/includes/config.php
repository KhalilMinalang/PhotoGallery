<?php

    // Database Constants
    //define("DB_SERVER", "localhost");
    //define("DB_USER", "gallery");
    //define("DB_PASS", "php0TL123");
    //define("DB_NAME", "photo_gallery");
    // This means if it's NOT defined, then define it.
    //if(!defined('DB_SERVER')) {define("DB_SERVER", "localhost");}
    
    // OR
    // defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
    // defined('DB_USER') ? null : define("DB_USER", "gallery");
    // defined('DB_PASS') ? null : define("DB_PASS", "php0TL123");
    // defined('DB_NAME') ? null : define("DB_NAME", "photo_gallery");
    
    // my setup
    defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
    defined('DB_USER') ? null : define("DB_USER", "root");
    defined('DB_PASS') ? null : define("DB_PASS", "");
    defined('DB_NAME') ? null : define("DB_NAME", "photo_gallery");
    
?>