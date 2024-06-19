<?php
class Rectangle
{
    /** The length of the rectangle. */
    public readonly float $length;
    /** The width of the rectangle. */
    public readonly float $width;

    /** Creates a new rectangle. */
    function __construct(float $length, float $width)
    {
        $this->length = $length;
        $this->width = $width;
    }

    /** Calculates and returns the area of this rectangle. */
    function area()
    {
        return $this->length * $this->width;
    }

    /** Calculates and returns the perimeter length of this rectangle. */
    function perimeter()
    {
        return $this->length * 2 + $this->width * 2;
    }

    /** Calculates and returns the diagonal length of this rectangle. */
    function diagonal()
    {
        return sqrt($this->length ** 2 + $this->width ** 2);
    }
}
