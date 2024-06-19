<?php

/** The database connection. */
$db = new PDO("mysql:host=localhost;dbname=ctec", "root");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
