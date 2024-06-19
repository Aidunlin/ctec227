<?php

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

function validate_register_form(array $form_data)
{
    $errors = [];

    if ($form_data["first_name"] == "") {
        $errors[] = "Your first name is required";
    }

    if ($form_data["last_name"] == "") {
        $errors[] = "Your last name is required";
    }

    if ($form_data["email"] == "") {
        $errors[] = "An email address is required";
    } else if (!filter_var($form_data["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Your email address is invalid";
    }

    if ($form_data["password"] == "") {
        $errors[] = "A password is required";
    } else if (strlen($form_data["password"]) < 8) {
        $errors[] = "A stronger password is required (more than 8 characters)";
    }

    return $errors;
}

function validate_login_form(array $form_data)
{
    $errors = [];

    if ($form_data["email"] == "") {
        $errors[] = "Your email address is required";
    } else if (!filter_var($form_data["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Your email address is invalid";
    }

    if ($form_data["password"] == "") {
        $errors[] = "Your password is required";
    }

    return $errors;
}

function get_user(string $id_or_email)
{
    global $db;
    $errors = [];

    $sql = "SELECT * FROM user WHERE user_id=:user_id OR email=:email LIMIT 1";
    $statement = $db->prepare($sql);

    try {
        $statement->execute(["user_id" => $id_or_email, "email" => $id_or_email]);
    } catch (\PDOException $exception) {
        $errors[] = match ($exception->getCode()) {
            default => "Could not get user!",
        };
    }

    $data = $statement->fetch();

    if ($data) {
        // Just in case.
        unset($data["password"]);
    } else {
        $errors[] = "Could not get user!";
    }

    return ["data" => $data, "errors" => $errors];
}

function register_user(array $form_data)
{
    global $db;
    $errors = [];

    $field_names = array_keys($form_data);
    $columns_joined = join(", ", $field_names);
    $params_joined = join(", ", array_map(fn ($field) => ":$field", $field_names));

    $form_data["password"] = hash("sha512", $form_data["password"]);

    $sql = "INSERT INTO user ($columns_joined) VALUES ($params_joined)";
    $statement = $db->prepare($sql);

    try {
        $statement->execute($form_data);
    } catch (PDOException $exception) {
        $errors[] = match ($exception->getCode()) {
            "23000" => "Email address is already used",
            default => "Could not register",
        };
    }

    // Just in case.
    unset($form_data["password"]);

    return ["data" => $form_data, "errors" => $errors];
}

function login_user(array $form_data)
{
    global $db;
    $errors = [];

    $field_names = array_keys($form_data);
    $conditions_joined = join(" AND ", array_map(fn ($field) => "$field=:$field", $field_names));

    $form_data["password"] = hash("sha512", $form_data["password"]);

    $sql = "SELECT * FROM user WHERE $conditions_joined LIMIT 1";
    $statement = $db->prepare($sql);

    try {
        $statement->execute($form_data);
    } catch (\PDOException $exception) {
        $errors[] = match ($exception->getCode()) {
            default => "Could not log in!",
        };
    }

    $data = $statement->fetch();

    if ($data) {
        // Just in case.
        unset($data["password"]);
    } else {
        $errors[] = "Email or password is incorrect!";
    }

    return ["data" => $data, "errors" => $errors];
}

function display_errors_if_any(array $errors)
{
    if (count($errors) == 0) {
        return;
    }

    echo "<div class='alert alert-danger'>";
    echo "<h3>Errors</h3>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo "<p class='m-0'>Please fix all errors to continue.</p>";
    echo "</div>";
}

function display_nav_link_li(string $page_link, string $page_name, string $current_link)
{
    echo "<li class='nav-item fw-semibold'>";
    display_nav_link($page_link, $page_name, $current_link);
    echo "</li>";
}

function display_nav_link(string $page_link, string $page_name, string $current_link, $link_type = "nav-link")
{
    if ($page_link == $current_link) {
        echo "<a class='$link_type active' aria-current='page' href='$page_link'>$page_name</a>";
    } else {
        echo "<a class='$link_type' href='$page_link'>$page_name</a>";
    }
}

function display_logged_in_message(array $user)
{
    echo "<div class='alert alert-success'>";
    echo "Welcome, <strong>{$user["first_name"]} {$user["last_name"]}</strong>!";
    echo "</div>";
}

function display_logged_out_message()
{
    echo "<div class='alert alert-info'>";
    echo "<p>Welcome, new user!</p>";
    echo "Please <a href='register.php' class='link-body-emphasis'>register</a>";
    echo " or <a href='login.php' class='link-body-emphasis'>login</a>.</div>";
}

function display_user_details(array $user)
{
    echo "<details class='mb-3 border rounded px-3'>";
    echo "<summary class='fw-bold py-2'>User details</summary>";
    echo "<table class='table'>";
    echo "<tr>";
    echo "<th>Property</th>";
    echo "<th>Value</th>";
    echo "</tr>";
    foreach ($user as $property => $value) {
        echo "<tr>";
        echo "<td>$property</td>";
        echo "<td>$value</td>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<td>password</td>";
    echo "<td><a href='https://www.youtube.com/watch?v=dQw4w9WgXcQ' class='link-dark text-decoration-none' title='We\"ll never give your password up...'>********</a></td>";
    echo "</tr>";
    echo "</table>";
    echo "</details>";
}
