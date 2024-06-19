<?php
require "inc/db_connect.inc.php";
require_once "inc/functions.inc.php";

$categories = get_categories();

$page_title = "JSludge - all categories";
require "inc/header.inc.php";

echo "<h2>All categories</h2>";
echo "<ul>";

foreach ($categories as $category) {
    echo "<li><a href='blog.php?category=$category->category_id'>$category->category</a></li>";
}

echo "</ul>";

require "inc/footer.inc.php";
