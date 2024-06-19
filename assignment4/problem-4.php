<?php
class TemperatureConverter
{
    /** Converts a temperature from degrees Celsius to degrees Fahrenheit, and returns it. */
    static function c_to_f(float $c)
    {
        return ($c * 9 / 5) + 32;
    }

    /** Converts a temperature from degrees Fahrenheit to degrees Celsius, and returns it. */
    static function f_to_c(float $f)
    {
        return ($f - 32) * 5 / 9;
    }
}
