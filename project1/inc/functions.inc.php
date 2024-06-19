<?php
require_once "inc/functions-db.inc.php";
require_once "inc/functions-display.inc.php";

/**
 * Filters and returns values from POST based on matching key names.
 *
 * @param array $field_names An array of field names to include. POST values that don't have a matching key name are not included in the output.
 * @return array The filtered POST data.
 */
function get_form_data(array $field_names)
{
    $form_data = [];

    foreach ($_POST as $field => $value) {
        $field = trim(strtolower($field));

        if (in_array($field, $field_names)) {
            $form_data[$field] = $value;
        }
    }

    return $form_data;
}

/**
 * Validates user inputs from the register form.
 *
 * @param array $form_data An associative array that should (but might not) contain:
 * - `user_name`: the new user name.
 * - `password`: the user's password in plaintext.
 * - `password_confirm`: an exact copy of the user's password.
 * 
 * @return array An array of error messages (empty if successful).
 */
function validate_register_form(array $form_data)
{
    $errors = [];

    if (!isset($form_data["user_name"]) || $form_data["user_name"] == "") {
        $errors[] = "A user name is required";
    } else if (!preg_match("/^\w+$/", $form_data["user_name"])) {
        $errors[] = "Your user name can only have letters, numbers, and underscores";
    } else if (strlen($form_data["user_name"]) > 32) {
        $errors[] = "Your user name cannot exceed 32 characters in length";
    }

    if (!isset($form_data["password"]) || $form_data["password"] == "") {
        $errors[] = "A password is required";
    } else if (strlen($form_data["password"]) < 8) {
        $errors[] = "Your password cannot be less than 8 characters in length";
    }

    if (!isset($form_data["password_confirm"]) || $form_data["password"] != $form_data["password_confirm"]) {
        $errors[] = "Passwords do not match";
    }

    return $errors;
}

/**
 * Validates user inputs from the login form.
 *
 * @param array $form_data An associative array that should (but might not) contain:
 * - `user_name`: the user name.
 * - `password`: the user's password in plaintext.
 * 
 * @return array An array of error messages (empty if successful).
 */
function validate_login_form(array $form_data)
{
    $errors = [];

    if (!isset($form_data["user_name"]) || $form_data["user_name"] == "") {
        $errors[] = "A user name is required";
    }

    if (!isset($form_data["password"]) || $form_data["password"] == "") {
        $errors[] = "Your password is required";
    }

    return $errors;
}

/**
 * Validates user inputs from the upload form.
 *
 * @param array $form_data An associative array that should (but might not) contain:
 * - `name`: the photo's name.
 * - `description`: the photo's description.
 * 
 * @return array An array of error messages (empty if successful).
 */
function validate_upload_form(array $form_data)
{
    $errors = [];

    if (!isset($form_data["name"]) || $form_data["name"] == "") {
        $errors[] = "A name is required";
    } else if (strlen($form_data["name"]) > 64) {
        $errors[] = "The name cannot exceed 64 characters in length";
    }

    if (isset($form_data["description"]) && strlen($form_data["description"]) > 512) {
        $errors[] = "The description cannot exceed 512 characters in length";
    }

    return $errors;
}

/**
 * Validates the file uploaded by the user.
 *
 * @return array An array of error messages (empty if successful).
 */
function validate_photo_file()
{
    $errors = [];

    if (!isset($_FILES["photo"])) {
        $errors[] = "A photo is required";
    } else if ($_FILES["photo"]["error"] != UPLOAD_ERR_OK) {
        $errors[] = match ($_FILES["photo"]["error"]) {
            UPLOAD_ERR_NO_FILE => "A photo is required",
            UPLOAD_ERR_INI_SIZE | UPLOAD_ERR_FORM_SIZE => "Photo exceeds maximum size (100 MB)",
            default => UPLOAD_ERRORS[$_FILES["photo"]["error"]],
        };
    } else if ($_FILES["photo"]["size"] > 100000000) {
        $errors[] = "Photo exceeds maximum size (100 MB)";
    }

    return $errors;
}

/**
 * Attempts to receive an uploaded photo.
 *
 * @param array $form_data An associative array containing:
 * - `name`: the photo's name.
 * - `description`: the photo's description.
 * 
 * @return array An associative array containing:
 * - `data`: the form data, as well as extra information about the uploaded photo.
 * - `errors`: An array of error messages (empty if successful).
 */
function handle_photo_upload(array $form_data)
{
    $form_data = get_form_data(array_keys($form_data));
    $errors = [];

    array_push($errors, ...validate_photo_file());
    array_push($errors, ...validate_upload_form($form_data));

    if (count($errors) > 0) {
        return ["data" => $form_data, "errors" => $errors];
    }

    $target_dir = "photos/{$_SESSION["user_name"]}";
    $dir_exists = is_dir($target_dir) || mkdir($target_dir, 0777, true);

    if (!$dir_exists) {
        $errors[] = "Could not create user photos directory";
        return ["data" => $form_data, "errors" => $errors];
    }

    $temp_file = $_FILES["photo"]["tmp_name"];
    $target_file = basename($_FILES["photo"]["name"]);
    $target_path = "$target_dir/$target_file";

    if (is_file($target_path)) {
        $errors[] = "Photo already exists (try a different filename)";
        return ["data" => $form_data, "errors" => $errors];
    }

    if (!move_uploaded_file($temp_file, $target_path)) {
        $errors[] = "Server failed to find uploaded file";
        return ["data" => $form_data, "errors" => $errors];
    }

    [$form_data["width"], $form_data["height"]] = getimagesize($target_path);

    $form_data["user_name"] = $_SESSION["user_name"];
    $form_data["file"] = $target_file;

    array_push($errors, ...create_photo_record($form_data));

    if (count($errors) > 0) {
        unlink($target_path);
    }

    return ["data" => $form_data, "errors" => $errors];
}
