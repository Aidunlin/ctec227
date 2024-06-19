# Photodepot - Project 1

CTEC 227 - Aidan Linerud

## Installation

MySQL and PHP 8.2.12 are both required to run. The [included SQL file](/sql/photodepot.sql) sets up the database for you.

## Features

- Simplified interface
- Supports [experimental page-to-page transitions](https://daverupert.com/2023/05/getting-started-view-transitions/)!
- User account registration and login
- Intuitive photo upload form (supports image pasting!)
- View all photos from specific user
- Delete your photos after-the-fact (and only your photos!)

## Implementation

Photodepot's code uses a plethora of associative arrays. I've kept consistency across function parameters, as well as include extra documentation on what array key-values are needed or returned.

Errors are handled in two ways:

- header("Location") calls (which will include an error message parameter)
- Appended to an array of error messages (which are displayed to the user)
