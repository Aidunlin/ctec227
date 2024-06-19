<?php

/**
 * Displays a list of errors in an alert box.
 *
 * @param array $errors An array of error messages.
 */
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

/**
 * Displays a nav link in the form of an <li> element.
 *
 * @param string $page_link The link to navigate to.
 * @param string $page_name The name of the page to navigate to.
 * @param string $active_link The current link of the page displaying this.
 * @param string|null $confirm (Optional) A message to ask for user confirmation before navigating to the page.
 */
function display_nav_link_li(string $page_link, string $page_name, string $active_link, string $confirm = null)
{
    echo "<li class='nav-item fw-semibold'>";
    display_nav_link($page_link, $page_name, $active_link, "nav-link", $confirm);
    echo "</li>";
}

/**
 * Displays a nav link.
 *
 * @param string $page_link The link to navigate to.
 * @param string $page_name The name of the page to navigate to.
 * @param string $active_link The current link of the page displaying this.
 * @param string $link_type A Bootstrap class to use for the link (such as "navbar-brand").
 * @param string|null $confirm (Optional) A message to ask for user confirmation before navigating to the page.
 */
function display_nav_link(string $page_link, string $page_name, string $active_link, $link_type = "nav-link", string $confirm = null)
{
    if ($confirm) {
        $onclick = "onclick='return confirm(\"$confirm\")'";
    } else {
        $onclick = "";
    }

    if ($page_link == $active_link) {
        echo "<a class='$link_type active' aria-current='page' href='$page_link' $onclick>$page_name</a>";
    } else {
        echo "<a class='$link_type' href='$page_link' $onclick>$page_name</a>";
    }
}

/**
 * Displays a photo using a photo record.
 *
 * @param array $photo The photo record data.
 * @param string|null $loading (Optional) The loading type to use (such as "lazy").
 */
function display_photo(array $photo, $loading = "eager")
{
    echo "<img loading='$loading' width='{$photo["width"]}' height='{$photo["height"]}' class='img-fluid rounded'";
    echo " src='{$photo["path"]}' alt='\"{$photo["name"]}\" by {$photo["user_name"]}'";
    echo " style='view-transition-name: photo-{$photo["photo_id"]}' />";
}

/**
 * Displays a side-by-side view of a photo and details about it.
 *
 * @param array $photo The photo record data.
 */
function display_photo_with_info(array $photo)
{
    $uploaded = getdate(strtotime($photo["uploaded"]));

    echo "<div class='row'>";

    echo "<div class='col'>";
    echo "<a href='view.php?photo={$photo["photo_id"]}'>";
    display_photo($photo);
    echo "</a>";
    echo "</div>";

    echo "<div class='col'>";
    echo "<h3>Details</h3>";
    echo "<p>{$photo["description"]}</p>";
    echo "<p>Uploaded by <a href='.?user={$photo["user_name"]}'>{$photo["user_name"]}</a> on {$uploaded["month"]} {$uploaded["mday"]}, {$uploaded["year"]}</p>";
    echo "<p>Resolution: {$photo["width"]} x {$photo["height"]}</p>";

    echo "<p><a href='view.php?photo={$photo["photo_id"]}'>Show bigger view</a></p>";
    if (isset($_SESSION["user_name"]) && $photo["user_name"] == $_SESSION["user_name"]) {
        echo "<p><a class='link-danger' href='delete.php?photo={$photo["photo_id"]}' onclick='return confirm(\"Are you sure you want to delete this photo?\")'>Delete</a></p>";
    }
    echo "</div>";

    echo "</div>";
}

/**
 * Displays a gallery of photos.
 *
 * @param array $photos An array of photo records.
 * @param string|null $loading (Optional) The loading type to use (such as "lazy").
 */
function display_photos(array $photos, $loading = "eager")
{
    if (count($photos) == 0) {
        echo "<p>No photos</p>";
    }

    echo "<div class='row'>";
    foreach ($photos as $photo) {
        echo "<div class='col-3 mb-3'>";
        echo "<a href='?photo={$photo["photo_id"]}'>";
        display_photo($photo, $loading);
        echo "</a>";
        echo "</div>";
    }
    echo "</div>";
}
