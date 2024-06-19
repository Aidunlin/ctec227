<?php
session_start();
require_once "inc/app.inc.php";
require_once "inc/functions.inc.php";

$form_data = [
    "email" => "",
    "first_name" => "",
    "last_name" => "",
    "password" => ""
];

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_data = get_form_data(array_keys($form_data));
    array_push($errors, ...validate_register_form($form_data));

    if (count($errors) == 0) {
        $result = register_user($form_data);
        array_push($errors, ...$result["errors"]);

        if (count($errors) == 0) {
            $user = $result["data"];
            header("Location: login.php?success=Successfully registered {$user["first_name"]} {$user["last_name"]}!");
            exit;
        }
    }

    // Just in case.
    unset($form_data["password"]);
}

$page_title = "Register";
require_once "inc/header.inc.php";

display_errors_if_any($errors);
?>

<form method="post">
    <div class="mb-3">
        <label for="first_name" class="form-label">First name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $form_data["first_name"] ?>">
    </div>

    <div class="mb-3">
        <label for="last_name" class="form-label">Last name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $form_data["last_name"] ?>">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="<?= $form_data["email"] ?>">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password">
        <div>Must be at least 8 characters in length.</div>
    </div>

    <input type="submit" class="btn btn-primary" value="<?= $page_title ?>">
</form>

<?php require_once "inc/footer.inc.php"; ?>