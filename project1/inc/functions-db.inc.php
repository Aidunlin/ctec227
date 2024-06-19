<?php

/**
 * Gets a single user record from the database.
 *
 * @param string $user_name The user name. Exact match only.
 * 
 * @return array An associative array containing:
 * - `data`: The user record (or false on error).
 * - `errors`: An array of error messages (empty if successful).
 */
function get_user(string $user_name)
{
    global $db;
    $errors = [];

    $sql = "SELECT * FROM users WHERE user_name=:user_name LIMIT 1";
    $statement = $db->prepare($sql);

    try {
        $statement->execute(["user_name" => $user_name]);
    } catch (PDOException $exception) {
        $errors[] = match ($exception->getCode()) {
            default => $exception->getMessage(),
        };
    }

    $data = $statement->fetch();

    if ($data) {
        // Just in case.
        unset($data["password"]);
    } else {
        $errors[] = "Could not get user";
    }

    return ["data" => $data, "errors" => $errors];
}

/**
 * Creates a new user in the database.
 * 
 * @param array $form_data An associative array containing:
 * - `user_name`: the new user name.
 * - `password`: the user's password in plaintext.
 * 
 * @return array An array of error messages (empty if successful).
 */
function register_user(array $form_data)
{
    $form_data["password"] = hash("sha512", $form_data["password"]);

    global $db;
    $errors = [];

    $field_names = array_keys($form_data);
    $columns_joined = join(", ", $field_names);
    $params_joined = join(", ", array_map(fn ($field) => ":$field", $field_names));

    $sql = "INSERT INTO users ($columns_joined) VALUES ($params_joined)";
    $statement = $db->prepare($sql);

    try {
        $statement->execute($form_data);
    } catch (PDOException $exception) {
        $errors[] = match ($exception->getCode()) {
            "23000" => "User name is taken",
            default => $exception->getMessage(),
        };
    }

    return $errors;
}

/**
 * Checks a user name and password against the database.
 *
 * @param array $form_data An associative array containing:
 * - `user_name` the user name.
 * - `password` the user's password in plaintext.
 * 
 * @return array An associative array containing:
 * - `data`: The user record (or false on error).
 * - `errors`: An array of error messages (empty if successful).
 */
function login_user(array $form_data)
{
    $form_data["password"] = hash("sha512", $form_data["password"]);

    global $db;
    $errors = [];

    $field_names = array_keys($form_data);
    $conditions_joined = join(" AND ", array_map(fn ($field) => "$field=:$field", $field_names));

    $sql = "SELECT * FROM users WHERE $conditions_joined LIMIT 1";
    $statement = $db->prepare($sql);

    try {
        $statement->execute($form_data);
    } catch (PDOException $exception) {
        $errors[] = match ($exception->getCode()) {
            default => $exception->getMessage(),
        };
    }

    $data = $statement->fetch();

    if ($data) {
        // Just in case.
        unset($data["password"]);
    } else {
        $errors[] = "User name or password is incorrect";
    }

    return ["data" => $data, "errors" => $errors];
}

/**
 * Creates a new photo record in the database.
 *
 * @param array $form_data An associative array containing:
 * - `user_name`: The user who uploaded this photo.
 * - `file`: The filename of the uploaded photo.
 * - `name`: The photo's name.
 * - `description`: The photo's description.
 * - `width`: The photo's width.
 * - `height`: The photo's height.
 * 
 * @return array An array of error messages (empty if successful).
 */
function create_photo_record(array $form_data)
{
    global $db;
    $errors = [];

    $field_names = array_keys($form_data);
    $columns_joined = join(", ", $field_names);
    $params_joined = join(", ", array_map(fn ($field) => ":$field", $field_names));

    $sql = "INSERT INTO photos ($columns_joined) VALUES ($params_joined);";
    $statement = $db->prepare($sql);

    $success = false;

    try {
        $success = $statement->execute($form_data);
    } catch (PDOException $exception) {
        $errors[] = match ($exception->getCode()) {
            "23000" => "Photo already exists (try a different filename)",
            default => $exception->getMessage(),
        };
    }

    if (!$success) {
        $errors[] = "Could not create photo record";
    }

    return $errors;
}

/**
 * Gets all the photos in the database.
 *
 * @return array An associative array containing:
 * - `data`: An array of photo records (or false on error) Each record includes a path for displaying the image.
 * - `errors`: An array of error messages (empty if successful).
 */
function get_photos()
{
    global $db;
    $errors = [];

    $sql = "SELECT * FROM photos ORDER BY uploaded DESC";
    $statement = $db->prepare($sql);

    try {
        $statement->execute();
    } catch (PDOException $exception) {
        $errors[] = match ($exception->getCode()) {
            default => $exception->getMessage(),
        };
    }

    $data = $statement->fetchAll();

    if ($data !== false) {
        $data = array_map(function ($photo) {
            $photo["path"] = "photos/{$photo["user_name"]}/{$photo["file"]}";
            return $photo;
        }, $data);
    } else {
        $errors[] = "Could not get photos";
    }

    return ["data" => $data, "errors" => $errors];
}

/**
 * Gets all the photos made by a specific user.
 * 
 * @param string $user_name The user's name.
 *
 * @return array An associative array containing:
 * - `data`: An array of photo records (or false on error) Each record includes a path for displaying the image.
 * - `errors`: An array of error messages (empty if successful).
 */
function get_photos_from_user(string $user_name)
{
    global $db;
    $errors = [];

    $sql = "SELECT * FROM photos WHERE user_name=:user_name ORDER BY uploaded DESC";
    $statement = $db->prepare($sql);

    try {
        $statement->execute(["user_name" => $user_name]);
    } catch (PDOException $exception) {
        $errors[] = match ($exception->getCode()) {
            default => $exception->getMessage(),
        };
    }

    $data = $statement->fetchAll();

    if ($data !== false) {
        $data = array_map(function ($photo) {
            $photo["path"] = "photos/{$photo["user_name"]}/{$photo["file"]}";
            return $photo;
        }, $data);
    } else {
        $errors[] = "Could not get photos";
    }

    return ["data" => $data, "errors" => $errors];
}

/**
 * Gets a photo from the database.
 *
 * @param string|int $id The photo's id.
 * 
 * @return array An associative array containing:
 * - `data`: The photo record (or false on error). The record includes a path for displaying the image.
 * - `errors`: An array of error messages (empty if successful).
 */
function get_photo_record($id)
{
    global $db;
    $errors = [];

    $sql = "SELECT * FROM photos WHERE photo_id=:id LIMIT 1";
    $statement = $db->prepare($sql);

    try {
        $statement->execute(["id" => $id]);
    } catch (PDOException $exception) {
        $errors[] = match ($exception->getCode()) {
            default => $exception->getMessage(),
        };
    }

    $data = $statement->fetch();

    if ($data) {
        $data["path"] = "photos/{$data["user_name"]}/{$data["file"]}";
    } else {
        $errors[] = "Could not get photo";
    }

    return ["data" => $data, "errors" => $errors];
}

/**
 * Deletes a photo record. This does not delete the file.
 *
 * @param string|int $id The photo's id.
 * 
 * @return bool Whether the photo record was successfully deleted.
 */
function delete_photo_record($id)
{
    global $db;

    $sql = "DELETE FROM photos WHERE photo_id=:id AND user_name=:user_name LIMIT 1";
    $statement = $db->prepare($sql);
    return $statement->execute(["id" => $id, "user_name" => $_SESSION["user_name"]]);
}
