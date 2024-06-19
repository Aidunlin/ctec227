<?php
require "inc/db_connect.inc.php";
require_once "inc/functions.inc.php";

$posts = get_posts();
$count_string = get_post_count_string(count($posts));

$page_title = "JSludge - all posts";
$details = "All posts";

if (isset($_GET["category"])) {
    $category_name = get_category_name($_GET["category"]);
    $page_title = "JSludge - $category_name";
    $details = "$count_string with category '$category_name'";
} else if (isset($_GET["tag"])) {
    $tag_name = get_tag_name($_GET["tag"]);
    $page_title = "JSludge - $tag_name";
    $details = "$count_string with tag '$tag_name'";
}

// `$page_title` must be ready at this point to display in the header.
require "inc/header.inc.php";
echo "<h2 style='view-transition-name: details'>$details</h2>";

foreach ($posts as $post) {
    $categories = get_categories_for_post($post->post_id);
    $tags = get_tags_for_post($post->post_id);

    echo "<article style='view-transition-name: post-$post->post_id'>";

    echo "<header>";
    echo "<h3 class='post-title'><a href='single.php?id=$post->post_id' title='Read the post' class='contrast'>$post->title</a></h3>";
    echo "</header>";

    echo "<div class='grid'>";

    echo "<div>";
    echo "<p><b><i>$post->first_name $post->last_name</i></b></p>";
    echo "<p style='view-transition-name: content-$post->post_id'>$post->content</p>";
    echo "<a href='single.php?id=$post->post_id' title='Read the post'>Read more ></a>";
    echo "</div>";

    echo "<div>";
    echo "<p><b><i>$post->date</i></b></p>";
    display_categories_for_post($categories);
    display_tags_for_post($tags);
    echo "</div>";

    echo "</div>";

    echo "</article>";
}

require "inc/footer.inc.php";
