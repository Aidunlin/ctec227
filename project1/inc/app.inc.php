<?php

/** The database connection. */
$db = new PDO("mysql:host=localhost;dbname=photodepot", "root");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

/** An associative array of all possible uploading errors with associated messages. */
const UPLOAD_ERRORS = [
    UPLOAD_ERR_OK => "No errors",
    UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize",
    UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE",
    UPLOAD_ERR_PARTIAL => "Partial upload",
    UPLOAD_ERR_NO_FILE => "No file",
    UPLOAD_ERR_NO_TMP_DIR => "No temporary directory",
    UPLOAD_ERR_CANT_WRITE => "Can't write to disk",
    UPLOAD_ERR_EXTENSION => "File upload stopped by extension"
];
