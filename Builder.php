<?php

interface PizzaInterface {
	public function setToppings($toppings);
	public function setBase($base_flavour);
	public function getToppings();
	public function getBase();
}

interface PizzaBuilderInterface {
	public function addTopping($topping);
	public function addBase($base_flavour);
	public function getPizza();
}

interface CookInterface {
	public function cookPizza(PizzaBuilder $pizza_builder);
}

// Product
class Pizza implements PizzaInterface {

	const BASE_TOMATO = "Tomato";
	const BASE_BBQ = "BBQ";
	
	const TOPPING_HAM = "Ham";
	const TOPPING_CHEESE = "Cheese";
	const TOPPING_PINEAPPLE = "Pineapple";
	
	private $toppings = [];
	private $base_flavour = '';
	
	function setToppings($toppings) {
		$this->toppings = $toppings;
	}
	
	function setBase($base_flavour) {
		$this->base_flavour = $base_flavour;
	}
	
	function getToppings() {
		return $this->toppings;
	}
	
	function getBase() {
		return $this->base_flavour;
	}
}

// Builder
class PizzaBuilder implements PizzaBuilderInterface {
	
	private $pizza;
	
	public function __construct() {
		$this->pizza = new Pizza();
	}
	
	function addTopping($value) {
		$toppings = $this->pizza->getToppings();
		$toppings[] = $value;
		$this->pizza->setToppings($toppings);
	}
	
	function addBase($value) {
		$this->pizza->setBase($value); 
	}
	
	function getPizza() {
		return $this->pizza;
	}
	
}

// Director
class Cook implements CookInterface {
	
	function cookPizza (PizzaBuilder $pizza_builder) {
		$pizza = $pizza_builder->getPizza();
		$base = $pizza->getBase();
		$toppings = implode(' ', $pizza->getToppings());
		echo "Chef is cooking up a {$base} {$toppings} pizza";
	}

}


$pizza = new PizzaBuilder();
$pizza->addBase(Pizza::BASE_BBQ);
$pizza->addTopping(Pizza::TOPPING_CHEESE);
$pizza->addTopping(Pizza::TOPPING_HAM);

$cook = new Cook();
$cook->cookPizza($pizza);
