<?php
class Library
{
    /**
     * The list of books in the library. 
     * @var BookInfo[]
     */
    private $inventory;

    /** Creates a new library. */
    function __construct()
    {
        $this->inventory = [];
    }

    /**
     * Adds a new book to this library.
     * Can optionally specificy the number of copies available.
     * 
     * If another book with a matching title already exists in the library,
     * then this will only increase the copies available for that book.
     */
    function add_book(string $title, string $author, string $genre, $copies_available = 1)
    {
        foreach ($this->inventory as $key => $book_info) {
            if ($title == $book_info->title) {
                $book_info->copies_available += $copies_available;
                $this->inventory[$key] = $book_info;
                return;
            }
        }

        $this->inventory[] = new BookInfo($title, $author, $genre, $copies_available);
    }

    /** Returns an array of book titles (regardless of the number of available copies). */
    function get_all_book_titles()
    {
        return array_map(fn (BookInfo $book_info) => $book_info->title, $this->inventory);
    }

    /**
     * Returns a BookInfo for the corresponding book title in this library.
     * 
     * Returns false if this library does not contain the book.
     */
    function get_book_info(string $book_title)
    {
        foreach ($this->inventory as $book_info) {
            if ($book_title == $book_info->title) {
                return $book_info;
            }
        }

        return false;
    }

    /**
     * Returns whether the book with the corresponding book title has any available copies.
     * 
     * Returns false if this library does not contain the book.
     */
    function check_availability(string $book_title)
    {
        foreach ($this->inventory as $book_info) {
            if ($book_title == $book_info->title) {
                return $book_info->check_availability();
            }
        }

        return false;
    }

    /**
     * Attempts to decrement the book's available copies (without going below 0), and returns whether it was successful.
     * 
     * Returns false if this library does not contain the book.
     */
    function borrow_book(string $book_title)
    {
        foreach ($this->inventory as $key => $book_info) {
            if ($book_title == $book_info->title) {
                $success = $book_info->borrow_book();

                if ($success) {
                    $this->inventory[$key] = $book_info;
                }

                return $success;
            }
        }

        return false;
    }

    /**
     * Attempts to increment the book's available copies, and returns whether it was successful.
     * 
     * Returns false if this library does not contain the book.
     */
    function return_book(string $book_title)
    {
        foreach ($this->inventory as $key => $book_info) {
            if ($book_title == $book_info->title) {
                $book_info->return_book();
                $this->inventory[$key] = $book_info;
                return true;
            }
        }

        return false;
    }

    /** Displays information on all books in this library. */
    function display_inventory()
    {
        echo "<table>";
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Author</th>";
        echo "<th>Genre</th>";
        echo "<th>Copies available</th>";
        echo "</tr>";
        foreach ($this->inventory as $book_info) {
            echo "<tr>";
            echo "<td>{$book_info->title}</td>";
            echo "<td>{$book_info->author}</td>";
            echo "<td>{$book_info->genre}</td>";
            echo "<td style='text-align:right'>{$book_info->copies_available}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

class BookInfo
{
    /** The title of the book. */
    public readonly string $title;
    /** The author of the book. */
    public readonly string $author;
    /** The genre of the book. */
    public readonly string $genre;
    /** The number of copies available for this book. */
    public int $copies_available = 1;

    /** Creates a new BookInfo. Can optionally specificy the number of copies available. */
    function __construct(string $title, string $author, string $genre, $copies_available = 1)
    {
        $this->title = $title;
        $this->author = $author;
        $this->genre = $genre;
        $this->copies_available = $copies_available;
    }

    /** Returns whether this book has any available copies. */
    function check_availability()
    {
        return $this->copies_available > 0;
    }

    /** Attempts to decrement this book's available copies (without going below 0), and returns whether it was successful. */
    function borrow_book()
    {
        if ($this->copies_available == 0) {
            return false;
        }

        $this->copies_available--;
        return true;
    }

    /** Increments this book's available copies. */
    function return_book()
    {
        $this->copies_available++;
    }
}
