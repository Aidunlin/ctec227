<?php
class Triangle
{
    /** The first side length of the triangle. */
    public readonly float $side1;
    /** The second side length of the triangle. */
    public readonly float $side2;
    /** The third side length of the triangle. */
    public readonly float $side3;

    /** Creates a new triangle. */
    function __construct(float $side1, float $side2, float $side3)
    {
        $this->side1 = $side1;
        $this->side2 = $side2;
        $this->side3 = $side3;
    }

    /** Returns a string detailing the type of this triangle. */
    function type()
    {
        $unique_side_lengths = array_unique([$this->side1, $this->side2, $this->side3]);
        $num_unique_sides = count($unique_side_lengths);

        return match ($num_unique_sides) {
            1 => "Equilateral", // One unique length is shared by all three sides
            2 => "Isosceles", // Two different lengths 
            default => "Scalene", // Each side has a different length
        };
    }
}
