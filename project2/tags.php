<?php
require "inc/db_connect.inc.php";
require_once "inc/functions.inc.php";

$tags = get_tags();

$page_title = "JSludge - all tags";
require "inc/header.inc.php";

echo "<h2>All tags</h2>";
echo "<ul>";

foreach ($tags as $tag) {
    echo "<li><a href='blog.php?tag=$tag->id'>$tag->tag</a></li>";
}

echo "</ul>";

require "inc/footer.inc.php";
