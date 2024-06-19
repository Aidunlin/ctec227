<?php
$page_title = "Register";
require_once "inc/header.inc.php";
require_once "inc/app.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = hash("sha512", $_POST["password"]);

    $sql = "INSERT INTO user (email, first_name, last_name, password)";
    $sql .= " VALUES (:email, :first_name, :last_name, :password)";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        "email" => $email,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "password" => $password
    ]);

    if ($stmt->rowCount() == 1) {
        echo "<div class='alert alert-success'>Registered! Welcome $first_name</div>";
    } else {
        echo "<div class='alert alert-danger'>ERROR: Could not register</div>";
    }
}
?>

<form method="post">
    <div class="mb-3">
        <label for="first_name" class="form-label">First name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" required>
    </div>

    <div class="mb-3">
        <label for="last_name" class="form-label">Last name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <input type="submit" class="btn btn-primary" value="Register">
</form>

<?php require_once "inc/footer.inc.php"; ?>