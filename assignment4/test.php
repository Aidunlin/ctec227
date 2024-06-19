<?php
require_once "problem-1.php";
require_once "problem-2.php";
require_once "problem-3.php";
require_once "problem-4.php";
require_once "problem-5.php";
require_once "problem-6.php";
require_once "problem-7.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 4 Tests</title>
</head>

<body>
    <h1>Assignment 4 Tests</h1>


    <h2>Problem 1 - Product</h2>
    <?php
    $product = new Product("Apple", 3.75, 4);
    echo $product->display_info();
    ?>


    <h2>Problem 2 - Circle</h2>
    <?php
    $circle = new Circle(5);
    $area = round($circle->area(), 2);
    $circumference = round($circle->circumference(), 2);
    echo "Radius: $circle->radius, Area: $area, Circumference: $circumference";
    ?>


    <h2>Problem 3 - Student</h2>
    <?php
    $student = new Student("Aidan", 21, 3.4);
    echo "Academic standing for $student->name with $student->grade gpa: " . $student->academic_standing();
    ?>


    <h2>Problem 4 - Temperature Conversion</h2>
    <?php
    echo "<p>100 C is " . TemperatureConverter::c_to_f(100) . " F";
    echo "<br>68 F is " . TemperatureConverter::f_to_c(68) . " C</p>";
    ?>


    <h2>Problem 5 - Library</h2>
    <?php
    $library = new Library();
    $library->add_book("Book 1", "Author 1", "Genre 1", 5);
    $library->add_book("Book 2", "Author 2", "Genre 2", 3);
    $library->add_book("Book 3", "Author 3", "Genre 3", 1);

    $library->display_inventory();

    // Availability example

    echo "<p>Is 'Book 4' in the library? ";
    if ($library->check_availability("Book 4")) {
        echo "yes</p>";
    } else {
        echo "no</p>";
    }

    // Borrowing example

    $remaining = $library->get_book_info("Book 1")->copies_available;
    echo "<p>Copies available for 'Book 1': $remaining";

    if ($library->borrow_book("Book 1")) {
        $remaining = $library->get_book_info("Book 1")->copies_available;
        echo "<br>Successfully borrowed 'Book 1'.";
        echo "<br>Remaining copies available for 'Book 1': $remaining</p>";
    } else {
        echo "<br>Could not borrow 'Book 1'.</p>";
    }

    // Returning example

    $remaining = $library->get_book_info("Book 3")->copies_available;
    echo "<br>Copies available for 'Book 3': $remaining";

    if ($library->return_book("Book 3")) {
        $remaining = $library->get_book_info("Book 3")->copies_available;
        echo "<br>Successfully returned 'Book 3'.";
        echo "<br>Remaining copies available for 'Book 3': $remaining</p>";
    } else {
        echo "<br>Could not return 'Book 3'.</p>";
    }
    ?>


    <h2>Problem 6 - Rectangle</h2>
    <?php
    $rectangle = new Rectangle(3, 4);
    echo "<p>Length: $rectangle->length, Width: $rectangle->width";
    echo "<br>Area: " . $rectangle->area();
    echo "<br>Perimeter: " . $rectangle->perimeter();
    echo "<br>Diagonal: " . $rectangle->diagonal() . "</p>";
    ?>


    <h2>Problem 7 - Triangle</h2>
    <?php
    $triangle = new Triangle(3, 4, 3);
    echo "<p>Side lengths: $triangle->side1, $triangle->side2, $triangle->side3";
    echo "<br>" . $triangle->type() . "</p>";
    ?>
</body>

</html>