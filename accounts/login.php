<?php
$page_title = "Login";
require_once "inc/header.inc.php";
require_once "inc/app.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = hash("sha512", $_POST["password"]);

    $sql = "SELECT * FROM user WHERE email=:email AND password=:password LIMIT 1";

    $stmt = $db->prepare($sql);
    $stmt->execute(["email" => $email, "password" => $password]);


    if ($stmt->rowCount() == 1) {
        $name = $stmt->fetch()["first_name"];
        echo "<div class='alert alert-success'>Logged in! Welcome $name</div>";
    } else {
        echo "<div class='alert alert-danger'>ERROR: Could not log in</div>";
    }
}
?>

<form method="post">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <input type="submit" class="btn btn-primary" value="Login">
</form>

<?php require_once "inc/footer.inc.php"; ?>