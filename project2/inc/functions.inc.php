<?php

/**
 * Returns a string describing the number of posts.
 *
 * @param int The number of posts.
 * @return string
 */
function get_post_count_string($count) {
    return match ($count) {
        0 => "No posts",
        1 => "1 post",
        default => "$count posts"
    };
}

/**
 * Truncates a string to a specified amount of words.
 * 
 * https://stackoverflow.com/questions/965235/how-can-i-truncate-a-string-to-the-first-20-words-in-php
 *
 * @param string $text The string to limit.
 * @param int $limit The number of words to limit by.
 * @return string
 */
function limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

/**
 * Formats a raw, multiline content string into HTML. Unordered lists will be created whenever lines start with 4 spaces. Very rudimentary.
 *
 * @param string $raw The raw content.
 * @return string
 */
function format_content($raw)
{
    $content = "";
    $in_list = false;
    foreach (explode("\n", htmlspecialchars($raw)) as $line) {
        if (str_starts_with($line, "    ")) {
            if (!$in_list) {
                $in_list = true;
                $content .= "<ul>";
            }
            $content .= "<li>$line</li>";
        } else {
            if ($in_list) {
                $in_list = false;
                $content .= "</ul>";
            }
            $content .= "<p>$line</p>";
        }
    }
    return $content;
}

/**
 * Returns the name of the specified category, or `false` if the category doesn't exist.
 *
 * @param string|int $id The id of the category.
 * @return string|false
 */
function get_category_name($id)
{
    global $db;

    $sql =
        "SELECT category.category
        FROM category
        WHERE category.category_id = :category_id";

    $statement = $db->prepare($sql);
    $statement->execute(["category_id" => $id]);
    $category = $statement->fetch();
    if ($category) {
        return $category->category;
    }
    return false;
}

/**
 * Returns the name of the specified tag, or `false` if the tag doesn't exist.
 *
 * @param string|int $id The id of the tag.
 * @return string|false
 */
function get_tag_name($id)
{
    global $db;

    $sql =
        "SELECT tag.tag
        FROM tag
        WHERE tag.id = :tag_id";

    $statement = $db->prepare($sql);
    $statement->execute(["tag_id" => $id]);
    $tag = $statement->fetch();
    if ($tag) {
        return $tag->tag;
    }
    return false;
}

/**
 * Returns an array of posts. If `category` or `tag` is set in the URL, returns the posts that include the corresponding category or tag.
 *
 * @return array|false
 */
function get_posts()
{
    global $db;

    $sql =
        "SELECT post.post_id, post.title, post.date, post.content, author.author_id, author.first_name, author.last_name
        FROM post
        JOIN author
            ON post.author = author.author_id";

    if (isset($_GET["category"])) {
        $sql .=
            " JOIN post_category
                ON post.post_id = post_category.post_id
            JOIN category
                ON post_category.category_id = category.category_id
            WHERE category.category_id = :category_id";

        $stmt = $db->prepare($sql);
        $stmt->execute(["category_id" => $_GET["category"]]);
    } else if (isset($_GET["tag"])) {
        $sql .=
            " JOIN post_tag
                ON post.post_id = post_tag.post_id
            JOIN tag
                ON post_tag.tag_id = tag.id
            WHERE tag.id = :tag_id";

        $stmt = $db->prepare($sql);
        $stmt->execute(["tag_id" => $_GET["tag"]]);
    } else {
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }

    $posts = $stmt->fetchAll();

    if ($posts) {
        $posts = array_map(function ($post) {
            $post->content = htmlspecialchars(limit_text($post->content, 20));
            $post->date = date_create($post->date)->format('M d, Y');
            return $post;
        }, $posts);
    }

    return $posts;
}

/**
 * Returns the post based on the specified id, or `false` if the post doesn't exist.
 *
 * @param string|int $id The id of the post.
 * @return mixed|false
 */
function get_post($id)
{
    global $db;

    $sql =
        "SELECT post.post_id, post.title, post.date, post.content, author.author_id, author.first_name, author.last_name 
        FROM post 
        JOIN author 
            ON post.author = author.author_id 
        WHERE post.post_id = :post_id";

    $statement = $db->prepare($sql);
    $statement->execute(["post_id" => $id]);
    $post = $statement->fetch();

    if ($post) {
        $post->content = format_content($post->content);
        $post->date = date_create($post->date)->format('M d, Y');
    }

    return $post;
}

/**
 * Returns all the categories of a post.
 *
 * @param string|int $post_id The id of the post.
 * @return array|false
 */
function get_categories_for_post($post_id)
{
    global $db;

    $sql =
        "SELECT post_category.post_id, post_category.category_id, category.category 
        FROM post_category 
        JOIN category 
            ON post_category.category_id = category.category_id 
        WHERE post_category.post_id = :post_id
        ORDER BY category.category";

    $statement = $db->prepare($sql);
    $statement->execute(["post_id" => $post_id]);
    return $statement->fetchAll();
}

/**
 * Returns all the tags of a post.
 *
 * @param string|int $post_id The id of the post.
 * @return array|false
 */
function get_tags_for_post($post_id)
{
    global $db;

    $sql =
        "SELECT post_tag.post_id, post_tag.tag_id, tag.tag 
        FROM post_tag 
        JOIN tag 
            ON post_tag.tag_id = tag.id 
        WHERE post_tag.post_id = :post_id
        ORDER BY tag.tag";

    $statement = $db->prepare($sql);
    $statement->execute(["post_id" => $post_id]);
    return $statement->fetchAll();
}

/**
 * Displays categories in a comma-separated list.
 *
 * @param array $categories Category objects to display.
 */
function display_categories_for_post($categories)
{
    echo match (count($categories)) {
        0 => "<p>No categories",
        1 => "<p>Category:",
        default => "<p>Categories:",
    };
    if (count($categories) > 0) {
        echo "<br>";
        echo join(", ", array_map(fn ($row) => "<a class='secondary' href='blog.php?category={$row->category_id}'>{$row->category}</a>", $categories));
    }
    echo "</p>";
}

/**
 * Displays tags in a comma-separated list.
 *
 * @param array $tags Tag objects to display.
 */
function display_tags_for_post(array $tags)
{
    echo match (count($tags)) {
        0 => "<p>No tags",
        1 => "<p>Tag:",
        default => "<p>Tags:",
    };
    if (count($tags) > 0) {
        echo "<br>";
        echo join(", ", array_map(fn ($row) => "<a class='secondary' href='blog.php?tag={$row->tag_id}'>{$row->tag}</a>", $tags));
    }
    echo "</p>";
}

/**
 * Returns an array of all categories.
 *
 * @return array|false
 */
function get_categories()
{
    global $db;

    $sql =
        "SELECT category.category_id, category.category
        FROM category
        ORDER BY category.category";

    $statement = $db->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
}

/**
 * Returns an array of all tags.
 *
 * @return array|false
 */
function get_tags()
{
    global $db;

    $sql =
        "SELECT tag.id, tag.tag
        FROM tag
        ORDER BY tag.tag";

    $statement = $db->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
}
