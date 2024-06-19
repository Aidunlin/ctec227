<?php
session_start();
if (!isset($_SESSION["user_name"])) {
    header("Location: login.php");
    exit;
}

require_once "inc/app.inc.php";
require_once "inc/functions.inc.php";

$form_data = [
    "name" => "",
    "description" => "",
];

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = handle_photo_upload($form_data);
    $form_data = $result["data"];
    $errors = $result["errors"];

    if (count($errors) == 0) {
        header("Location: .?success=Uploaded {$form_data["name"]}!");
        exit;
    }
}

$page_title = "Upload";
require_once "inc/header.inc.php";

display_errors_if_any($errors);
?>

<form method="post" enctype="multipart/form-data" style="view-transition-name: form">
    <input type="hidden" name="MAX_FILE_SIZE" value="100000000">

    <div class="mb-3">
        <label class="form-label" for="photo">Photo</label>
        <input class="form-control" type="file" name="photo" id="photo" accept="image/*">
        <div class="form-text">Maximum size is 100 MB.</div>
        <div class="form-text">Pro-tip: you can paste in a photo as well!</div>
        <!-- This preview element is updated whenever the file input changes. -->
        <img class="img-fluid rounded mt-3 d-none" id="preview" src="#" alt="Preview" width="100" />
    </div>

    <div class="mb-3">
        <label class="form-label" for="name">Name</label>
        <input class="form-control" type="text" name="name" id="name" maxlength="64" value="<?= $form_data["name"] ?>">
    </div>

    <div class="mb-3">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-control" name="description" id="description" maxlength="512"><?= $form_data["description"] ?></textarea>
    </div>

    <div class="mb-3">
        <input class="btn btn-primary" type="submit" value="Upload">
    </div>
</form>

<script>
    /** @type {HTMLInputElement} */
    const photoInput = document.getElementById("photo");

    /** @type {HTMLImageElement} */
    const previewImage = document.getElementById("preview");

    /** @type {HTMLInputElement} */
    const nameInput = document.getElementById("name");

    /** @type {HTMLTextAreaElement} */
    const descriptionTextArea = document.getElementById("description");

    function onChange() {
        // It's a good practice to remove the previous object url.
        if (previewImage.src != "#") {
            URL.revokeObjectURL(previewImage.src);
        }

        const file = photoInput.files[0];

        if (!file) {
            previewImage.classList.add("d-none");
            return;
        }

        previewImage.src = URL.createObjectURL(file);
        previewImage.classList.remove("d-none");

        if (!nameInput.value) {
            nameInput.value = file.name;
        }
    }

    photoInput.onchange = onChange;

    // Support CTRL-V for photos...

    document.onpaste = (e) => {
        if (!e.clipboardData) return;
        photoInput.files = e.clipboardData.files;
        onChange();
    };

    // ... but don't let it happen when a textbox is focused.

    nameInput.onpaste = (e) => e.stopPropagation();
    descriptionTextArea.onpaste = (e) => e.stopPropagation();
</script>

<?php require_once "inc/footer.inc.php"; ?>