<?php

// Square.php

class Square extends Shape
{
	protected $length; 

	public function __construct($length) 
	{
		$this->length = $length;
		$number_of_sides = 4;
		parent::__construct($number_of_sides);
	}

	public function area()
	{
		$area = pow($this->length, 2);
		return $area;
	}
}



// index.php

include 'Square.php';

$mySquare = new Square(10);
$area = mySquare->area();
echo 'The area of my square is '.$area;
