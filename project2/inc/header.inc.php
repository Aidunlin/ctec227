<?php
require_once "inc/db_connect.inc.php";
require_once "inc/functions.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="color-scheme" content="light dark">
  <meta name="view-transition" content="same-origin">
  <link rel="stylesheet" href="css/pico.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title><?= $page_title ?></title>
</head>

<body class="container">
  <header style="view-transition-name: header">
    <nav>
      <ul>
        <li class="brand">
          <a class="secondary" href="blog.php">
            <hgroup>
              <h1>JSludge</h1>
              <p>The AI-Generated JavaScript Blog</p>
            </hgroup>
          </a>
        </li>

        <?php
        const LINKS = [
          "blog.php" => "Home",
          "categories.php" => "Categories",
          "tags.php" => "Tags"
        ];

        foreach (LINKS as $link => $text) {
          echo "<li>";
          if ($link == basename($_SERVER["PHP_SELF"])) {
            echo "<a aria-current='true' href='$link'>$text</a>";
          } else {
            echo "<a href='$link'>$text</a>";
          }
          echo "</li>";
        } ?>
      </ul>
    </nav>
  </header>