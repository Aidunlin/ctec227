<?php
class Product
{
    /** The name of the product. */
    public readonly string $name;
    /** The price of the product. */
    public readonly float $price;
    /** The amount available of this product. */
    public readonly int $quantity;

    /** Creates a new product. */
    function __construct(string $name, float $price, int $quantity)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    /** Calculates and returns the total combined value of this product. */
    function total_value()
    {
        return $this->price * $this->quantity;
    }

    /** Returns a string containing information about this product. */
    function display_info()
    {
        if ($this->quantity == 0) {
            return "Product '$this->name': $$this->price, 0 in stock";
        }

        $total_value = $this->total_value();
        return "Product '$this->name': $$this->price, $this->quantity in stock ($$total_value total)";
    }
}
