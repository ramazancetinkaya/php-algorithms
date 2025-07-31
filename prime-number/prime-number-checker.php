<?php
/**
 * Prime Number Checker Algorithm
 * 
 * This algorithm efficiently determines if a number is prime
 * using optimized trial division method.
 */

/**
 * Validates if the input is a valid integer
 * 
 * @param mixed $input The input to validate
 * @return bool True if input is a valid integer, false otherwise
 */
function isValidInteger($input): bool {
    // Check if input is numeric and if it's an integer
    return is_numeric($input) && $input == (int)$input;
}

/**
 * Checks if a number is prime using an optimized algorithm
 * 
 * @param int $number The number to check
 * @return bool True if the number is prime, false otherwise
 */
function isPrime(int $number): bool {
    // Handle special cases
    // 2 and 3 are prime numbers
    if ($number == 2 || $number == 3) {
        return true;
    }
    
    // Numbers less than 2 or even numbers (except 2) are not prime
    if ($number < 2 || $number % 2 == 0) {
        return false;
    }
    
    // Check if divisible by 3
    if ($number % 3 == 0) {
        return false;
    }
    
    // Calculate square root once for optimization
    $sqrtNumber = customSqrt($number);
    
    // Check divisibility using 6k±1 optimization
    // All primes greater than 3 can be expressed in form of 6k±1
    // This reduces the number of divisions needed
    for ($i = 5; $i <= $sqrtNumber; $i += 6) {
        // Check if divisible by i or i+2
        if ($number % $i == 0 || $number % ($i + 2) == 0) {
            return false;
        }
    }
    
    // If no divisors found, the number is prime
    return true;
}

/**
 * Custom square root function without using built-in sqrt()
 * Using the Babylonian method for calculating square root
 * 
 * @param int $number The number to find square root of
 * @return float The square root of the number
 */
function customSqrt(int $number): float {
    // Handle special cases
    if ($number == 0 || $number == 1) {
        return $number;
    }
    
    // Initial guess for square root
    $x = $number / 2;
    $y = 0;
    
    // Use Babylonian method for approximation
    // This converges quadratically to the square root
    while ($x != $y) {
        $y = $x;
        $x = ($x + ($number / $x)) / 2;
    }
    
    return $x;
}

/**
 * Checks and displays if a number is prime
 * 
 * @param mixed $input The number to check
 * @return void
 */
function checkAndDisplayPrime($input): void {
    // Validate input
    if (!isValidInteger($input)) {
        echo "Please enter a valid integer.";
        return;
    }
    
    $number = (int)$input;
    
    // Check if prime and display result
    if (isPrime($number)) {
        echo "$number is a prime number.";
    } else {
        echo "$number is not a prime number.";
    }
}

// Example usage
$numberToCheck = 97; // Change this value to check different numbers
checkAndDisplayPrime($numberToCheck);
?>
