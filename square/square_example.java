// Square.java

class Square extends Shape
{
	protected double length; 

	public Square(double length) 
	{
		this.length = length;
		int numberOfSides = 4;
		super(numberOfSides);
	}

	public double area()
	{
		double area = Math.pow(this.length, 2.0);
		return area;
	}
}



// TestSqaure.java

import Square;

class TestSquare
{
	public static void main(String[] args) 
	{
		Square mySquare = new Square(10.0);
		double area = mySquare.area();
		System.out.println("The area of my square is " + area);
	}
}
