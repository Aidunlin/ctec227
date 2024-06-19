<?php
require_once "inc/db_connect.inc.php";
require_once "inc/functions.inc.php";

if (!isset($_GET["id"])) {
    header("Location: blog.php");
    exit;
}

$post = get_post($_GET["id"]);

if (!$post) {
    header("Location: blog.php");
    exit;
}

$categories = get_categories_for_post($post->post_id);
$tags = get_tags_for_post($post->post_id);

$page_title = $post->title;
require_once "inc/header.inc.php";

echo "<article style='view-transition-name: post-$post->post_id'>";

echo "<header>";
echo "<h2>$post->title</h2>";
echo "<p><b><i>$post->first_name $post->last_name - $post->date</i></b></p>";
display_categories_for_post($categories);
display_tags_for_post($tags);
echo "</header>";

echo "<div style='view-transition-name: content-$post->post_id'>$post->content</div>";

echo "</article>";

require "inc/footer.inc.php";
