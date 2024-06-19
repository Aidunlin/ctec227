<?php
class Circle
{
    /** The radius of the circle. */
    public readonly float $radius;

    /** Creates a new circle. */
    function __construct(float $radius)
    {
        $this->radius = $radius;
    }

    /** Calculates and returns the area of this circle. */
    function area()
    {
        return pi() * $this->radius ** 2;
    }

    /** Calculates and returns the circumference of this circle. */
    function circumference()
    {
        return 2 * pi() * $this->radius;
    }
}
