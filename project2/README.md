# CTEC 227 Project 2

This project will have you further develop the Blog application from Module 5.

There are miscellaneous due dates within this assignment.

In addition to the items outlined below, your project must pass HTML validation, CSS validation and must also not contain any WAVE Errors, Contrast Errors or Alerts.

Your project must look professional, styled and ready to add to your professional portfolio. 42% of this project will be weighted towards this.

The project must also maintain a consistent user experience across all of the pages.

The application must include all of the following pages:

- blog.php (home page)
- single.php (shows a single blog post)
- tags.php (shows all of the tags being used and each tag is a link to display posts that use that tag)
- categories.php (shows all of the categories used and each category is a link to display all posts that use that tag)
- tag.php (shows all of the posts for a given tag)
- category.php (shows all of the posts for a given category)

## Step 0: Install the application on XAMPP - Due by Wednesday 15th, 2024

Here's a list of the things you must do:

- Place this folder in your htdocs folder
- Start XAMPP, Apache and MySQL
- Using phpMyAdmin, create a new database and name it 'blog'. All lowercase.
- Import the SQL from the .sql folder in this repository
- Go to your browser and bring up the blog.php page
- You must submit a screen shot showing these items installed in Canvas by May 15, 2024.

## Step 1: Content Creation - Due by Friday 17th, 2024

- Your project must remove all of the existing content in each of the tables
- You must create at least 5 meaningful blog posts using phpMyAdmin. No need for a front-end form to do this for this project. Lorem Ipsum text must not be used.
- Use topics of your choice.
- Make sure that the project contains no remnants of the original content.
- This includes page titles, headings, footers, etc.
- You must submit a screen shot showing these items completed in Canvas by May 17, 2024.

## Step 2: Improve the navbar and make it your own - Due by Sunday 19th, 2024

- The navbar must not look like the one provided.
- Do not remove the 3 links provided (Home, Categories, Tags).
- Style it to match the overall theme you will use for the project.
- You must submit a screen shot showing your improved navbar in Canvas by May 19, 2024.

## Step 3: Improving the Home Page Content Area

- Each blog entry must look professionally styled and not use the default Bootstrap colors provided.
- The unordered lists for the categories must be replaced with comma separated values. If there is only one category, you must display the word "Category". If there are multiple categories you must display the word "Categories".
- Each category must link to the category.php page showing only the blog posts for that category.
- The categories must be in alphabetical order.
- If there is only one tag, you must display the word "Tag". If there are multiple tags you must display the word "Tags".
- The unordered lists for the tags must be replaced with comma, separated values.
- Each tag must link to the tag.php page showing all of the blog entires for just that one tag.
- The tags must be in alphabetical order.
- I would suggest making the code on the blog.php reusable so it can be used on other pages. Consider how to make it driven by a parameter in the URL.

## Step 4: Test Entire Application

- The application must perform without any errors.
- The user interface must be professionally styled and all links must work.
- The application must not contain any HTML/CSS validation errors.
- All WAVE test must not contain any color contrast, errors or alerts.
- Each and every item has been successfully implemented.

## Step 5: Database Export

- Export your blog database and place the .SQL file for your blog in the sql folder.
- The .sql file must be named new_db.sql

## Milestone Due Date Summary

- Step 0: Install the application on XAMPP - Due by Wednesday 15th, 2024
- Step 1: Content Creation - Due by Friday 17th, 2024
- Step 2: Improve the navbar and make it your own - Due by Sunday 19th, 2024
- Project 2 Due Date - Sunday, May 26, 2024 at 11:59 PM.

## Submission

- Save, stage, commit and push your work to GitHub.
- You must record a video (Loom, YouTube, etc.) reviewing your entire project. Place the video a folder named "video" along with a Markdown page which properly links to your video.
- Make sure you include all of the files and the new SQL file.

## Grading Rubric

| Item                                                                           | Full Marks | Partial marks |
|--------------------------------------------------------------------------------|------------|---------------|
| Step 0: Install the application on XAMPP completed on time                     | 25         | 12            |
| Step 1: Content Creation completed on time                                     | 25         | 12            |
| Step 2: Improve the navbar and footer and make them your own completed on time | 25         | 12            |
| The entire project is styled professionally                                    | 230        | 115           |
| The PHP code is sufficiently commented                                         | 20         | 10            |
| The quality of the PHP code is professional                                    | 35         | 17            |
| The project was turned in on time                                              | 35         | 17            |
| HTML Validates for all pages                                                   | 25         | 12            |
| CSS Validates for all pages                                                    | 25         | 12            |
| WAVE shows no Errors, Alerts or Color Contrast Issues                          | 25         | 12            |
| All aspects of the project work without issue                                  | 100        | 50            |
