# CTEC 227 Coding Assignment 3 - 2024

## Overview

This assignment requires you to demonstrate the Registration and Login code you learned in Module 2 and submit your work using GitHub Classroom.

While this assignment does not require you to style your work, remember that you will need to do so for an upcoming assignment to build an Image Library application.

You must use the **user** table located in the ctec database.

## Questions

If you have any questions, please use the Slack #questions channel.

## Assignment Details

Your assignment must contain the following four PHP pages:

- register.php
- login.php
- home.php
- logout.php

## Requirements for register.php

### Form Requirements

All fields are required and must not use the **required** HTML attribute but are validated in PHP using an error bucket.

- email field of type email
- first_name field
- last_name field
- password field of type password
- submit button with the value of Register

If all fields are filled out correctly, the user must be taken to the login.php page.

## Requirements for login.php

All fields are required and must not use the **required** HTML attribute but are validated in PHP using an error bucket.

- email field
- password field of type password
- submit button with the value of Login

If the email and password are found in the user table, redirect the user to the home.php page.

It must also establish a session variable to indicate that the user is in fact, logged in.

## Requirements for home.php

The home.php must have a link to register.php and login.php.

If the user is logged in, the page must link to the login.php page. Instead, it should show a link to a page called logout.php to destroy the user's session.

The page must show a link to login.php if the user is not logged in.

Place some placeholder content on the page of your choice.

## Requirements for logout.php

Users who try to type in logout.php in the browser should be redirected to the login.php page.

This page must drop the user session if they are logged in and then redirect the user to the home.php page.
