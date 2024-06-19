<?php
class Student
{
    /** The student's name. */
    public readonly string $name;
    /** The student's age. */
    public readonly int $age;
    /** The student's grade. */
    public readonly float $grade;

    /** Creates a new student. */
    function __construct(string $name, int $age, float $grade)
    {
        $this->name = $name;
        $this->age = $age;
        $this->grade = $grade;
    }

    /** Returns a string detailing this student's academic standing. */
    function academic_standing()
    {
        // Because match statements execute from top to bottom,
        // we can swap the subject expression (grade > x) and conditional expression (true)
        // to construct this amazingly simple match statement.

        return match (true) {
            $this->grade >= 3.5 => "Excellent",
            $this->grade >= 3 => "Good",
            $this->grade >= 2 => "Average",
            default => "Needs Improvement",
        };
    }
}
