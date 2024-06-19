<?php
require_once "inc/app.inc.php";
require_once "inc/functions.inc.php";

$form_data = [
    "email" => "",
    "password" => "",
];

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_data = get_form_data(array_keys($form_data));
    array_push($errors, ...validate_login_form($form_data));

    if (count($errors) == 0) {
        $result = login_user($form_data);
        $user = $result["data"];
        array_push($errors, ...$result["errors"]);

        if (count($errors) == 0) {
            session_start();
            $_SESSION["user_id"] = $user["user_id"];
            header("Location: home.php");
            exit;
        }
    }

    // Just in case.
    unset($form_data["password"]);
}

$page_title = "Login";
require_once "inc/header.inc.php";

// Handles the message from successfully registering.
$success_message = $_GET["success"] ?? "";
if (strlen($success_message)) {
    echo "<div class='alert alert-success'>$success_message</div>";
}

display_errors_if_any($errors);
?>

<form method="post">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="<?= $form_data["email"] ?>">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>

    <input type="submit" class="btn btn-primary" value="<?= $page_title ?>">
</form>

<?php require_once "inc/footer.inc.php"; ?>