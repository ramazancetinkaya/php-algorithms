<?php
/**
 * Factorial Calculator Algorithms
 * 
 * This file contains two implementations of factorial calculation:
 * 1. Iterative (loop-based) approach
 * 2. Recursive approach
 */

/**
 * Validates if the input is a non-negative integer
 * 
 * @param mixed $input The input to validate
 * @return bool True if input is a non-negative integer, false otherwise
 */
function isNonNegativeInteger($input): bool {
    // Check if input is numeric, is an integer, and is not negative
    return is_numeric($input) && $input == (int)$input && $input >= 0;
}

/**
 * Calculates factorial using an iterative (loop-based) approach
 * This method is more memory-efficient for large numbers
 * 
 * @param int $n The number to calculate factorial for
 * @return int|float The factorial result (float for very large numbers)
 */
function iterativeFactorial(int $n): int|float {
    // Validate input
    if (!isNonNegativeInteger($n)) {
        throw new InvalidArgumentException("Input must be a non-negative integer");
    }
    
    // Special cases
    if ($n <= 1) {
        return 1; // 0! = 1 and 1! = 1
    }
    
    // Initialize result
    $result = 1;
    
    // Calculate factorial using a loop
    // This avoids the overhead of function calls in recursion
    for ($i = 2; $i <= $n; $i++) {
        $result *= $i;
    }
    
    return $result;
}

/**
 * Calculates factorial using a recursive approach
 * Note: May cause stack overflow for very large numbers
 * 
 * @param int $n The number to calculate factorial for
 * @return int|float The factorial result (float for very large numbers)
 */
function recursiveFactorial(int $n): int|float {
    // Validate input
    if (!isNonNegativeInteger($n)) {
        throw new InvalidArgumentException("Input must be a non-negative integer");
    }
    
    // Base cases
    if ($n <= 1) {
        return 1; // 0! = 1 and 1! = 1
    }
    
    // Recursive case: n! = n * (n-1)!
    return $n * recursiveFactorial($n - 1);
}

/**
 * Wrapper function to calculate and display factorial using both methods
 * 
 * @param mixed $input The number to calculate factorial for
 * @return void
 */
function calculateAndDisplayFactorial($input): void {
    // Validate input
    if (!isNonNegativeInteger($input)) {
        echo "Please enter a valid non-negative integer.";
        return;
    }
    
    $number = (int)$input;
    
    // Check if the number is too large (factorial grows very quickly)
    if ($number > 170) {
        echo "Warning: Calculating factorial for numbers larger than 170 will exceed PHP's floating-point limit and return INF (infinity).\n";
    } elseif ($number > 20) {
        echo "Warning: Calculating factorial for numbers larger than 20 may exceed PHP's integer limit and will be converted to floating-point.\n";
    }
    
    // Calculate using iterative approach
    echo "Iterative factorial of $number: " . iterativeFactorial($number) . "\n";
    
    // Calculate using recursive approach
    echo "Recursive factorial of $number: " . recursiveFactorial($number);
}

// Example usage
$numberToCalculate = 10; // Change this value to calculate factorial for different numbers
calculateAndDisplayFactorial($numberToCalculate);
?>
