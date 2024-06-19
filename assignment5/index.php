<?php
$db = new PDO("mysql:host=localhost;dbname=joins_demo", "root");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

function start_task()
{
    $selected_task = intval($_GET["task"] ?? 1);
    match ($selected_task) {
        1 => task1(),
        2 => task2(),
        3 => task3(),
        4 => task4(),
        5 => task5(),
        6 => task6(),
        default => taskerror(),
    };
}

function task1()
{
    global $db;
    $sql = "SELECT comment FROM comment WHERE idea_id=4";
    $records = $db->query($sql)->fetchAll();
    echo "<h2>Task 1</h2>";
    if (count($records)) {
        echo "<p>Prompt: Show all comments for an idea where the idea.idea_id = 4</p>";
        echo "<ul>";
        foreach ($records as $record) {
            echo "<li>{$record["comment"]}</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Data not found</p>";
    }
}

function task2()
{
    global $db;
    $sql = "SELECT idea.description, idea.user_id, comment.comment FROM comment, idea WHERE comment.idea_id=idea.idea_id AND idea.idea_id=4";
    $records = $db->query($sql)->fetchAll();
    echo "<h2>Task 2</h2>";
    if (count($records)) {
        echo "<p>Prompt: Modify the query above to include the idea.description, idea.user_id, comment.comment </p>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Comment</th>";
        echo "<th>User id</th>";
        echo "<th>Description</th>";
        echo "</tr>";
        foreach ($records as $record) {
            echo "<tr>";
            echo "<td>{$record["comment"]}</td>";
            echo "<td>{$record["user_id"]}</td>";
            echo "<td>{$record["description"]}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Data not found</p>";
    }
}

function task3()
{
    global $db;
    $sql = "SELECT tag.tag, idea_tag.tag_id FROM tag, idea_tag WHERE tag.id=idea_tag.tag_id AND idea_tag.idea_id=4";
    $records = $db->query($sql)->fetchAll();
    echo "<h2>Task 3</h2>";
    if (count($records)) {
        echo "<p>Prompt: Show all tags for an idea.idea_id = 4 and include the idea_tag.tag_id</p>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Tag</th>";
        echo "<th>Tag id</th>";
        echo "</tr>";
        foreach ($records as $record) {
            echo "<tr>";
            echo "<td>{$record["tag"]}</td>";
            echo "<td>{$record["tag_id"]}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Data not found</p>";
    }
}

function task4()
{
    global $db;
    $sql = "SELECT tag.tag, idea_tag.tag_id FROM tag, idea_tag WHERE tag.id=idea_tag.tag_id AND idea_tag.idea_id=4 ORDER BY tag.tag";
    $records = $db->query($sql)->fetchAll();
    echo "<h2>Task 4</h2>";
    if (count($records)) {
        echo "<p>Prompt: Show all tags for an idea.idea_id = 4 and include the idea_tag.tag_id and the tag.tag (this will require two joins). Order the results by the tag.tag column</p>";
        echo "<p>Note: This doesn't actually require two joins. In fact, this task is the same as task 3, except with a different ordering.</p>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Tag</th>";
        echo "<th>Tag id</th>";
        echo "</tr>";
        foreach ($records as $record) {
            echo "<tr>";
            echo "<td>{$record["tag"]}</td>";
            echo "<td>{$record["tag_id"]}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Data not found</p>";
    }
}

function task5()
{
    global $db;
    $sql = "SELECT user.first_name, user.last_name, user.username FROM user, idea WHERE idea.user_id=user.user_id AND idea.idea_id=1";
    $record = $db->query($sql)->fetch();
    echo "<h2>Task 5</h2>";
    if ($record) {
        echo "<p>Prompt: Show all of the user info for idea.idea_id = 1. Include the user.first_name, user.last_name, user.username</p>";
        echo "<table>";
        echo "<tr>";
        echo "<th>First name</th>";
        echo "<th>Last name</th>";
        echo "<th>User name</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>{$record["first_name"]}</td>";
        echo "<td>{$record["last_name"]}</td>";
        echo "<td>{$record["username"]}</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "<p>Data not found</p>";
    }
}

function task6()
{
    global $db;
    $sql = "SELECT idea.description, idea.user_id, comment.comment, user.first_name, user.last_name FROM idea, comment, user WHERE idea.user_id=user.user_id AND idea.idea_id=comment.idea_id AND idea.idea_id=1";
    $records = $db->query($sql)->fetchAll();
    echo "<h2>Task 6</h2>";
    if ($records) {
        echo "<p>Prompt: List idea.description, idea.user_id, comment.comment, user.first_name, user.last_name where idea.idea_id=1</p>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Comment</th>";
        echo "<th>Description</th>";
        echo "<th>User id</th>";
        echo "<th>First name</th>";
        echo "<th>Last name</th>";
        echo "</tr>";
        foreach ($records as $record) {
            echo "<tr>";
            echo "<td>{$record["comment"]}</td>";
            echo "<td>{$record["description"]}</td>";
            echo "<td>{$record["user_id"]}</td>";
            echo "<td>{$record["first_name"]}</td>";
            echo "<td>{$record["last_name"]}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Data not found</p>";
    }
}

function taskerror()
{
    echo "<p>Task not found!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coding Assignment 5</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        nav ul {
            list-style-type: none;
            padding-inline-start: 0;
        }

        nav li {
            display: inline;
        }

        nav a {
            padding: 0.5em;
            text-decoration: none;
        }

        table th {
            text-align: left;
        }

        table th,
        table td {
            padding: 0.5em;
        }
    </style>
</head>

<body>
    <h1>Coding Assignment 5</h1>
    <nav>
        <ul>
            <li><a href="?task=1">Task 1</a></li>
            <li><a href="?task=2">Task 2</a></li>
            <li><a href="?task=3">Task 3</a></li>
            <li><a href="?task=4">Task 4</a></li>
            <li><a href="?task=5">Task 5</a></li>
            <li><a href="?task=6">Task 6</a></li>
        </ul>
    </nav>
    <?php start_task(); ?>
</body>

</html>