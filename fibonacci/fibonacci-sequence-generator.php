<?php
/**
 * Fibonacci Sequence Generator
 */

/**
 * Validates if the input is a positive integer
 * 
 * @param mixed $input The input to validate
 * @return bool True if input is a positive integer, false otherwise
 */
function isPositiveInteger($input): bool {
    // Check if input is numeric and if it's an integer greater than 0
    return is_numeric($input) && $input == (int)$input && $input > 0;
}

/**
 * Generates and displays the Fibonacci sequence up to n terms
 * Using an iterative approach for better memory efficiency
 * 
 * @param int $n Number of Fibonacci terms to generate
 * @return void
 */
function generateFibonacci(int $n): void {
    // Validate the input
    if (!isPositiveInteger($n)) {
        echo "Please enter a valid positive integer.";
        return;
    }
    
    // Initialize variables
    $fibSequence = [];
    
    // Special case for n = 1
    if ($n >= 1) {
        $fibSequence[] = 0;
    }
    
    // Special case for n = 2
    if ($n >= 2) {
        $fibSequence[] = 1;
    }
    
    // Generate the Fibonacci sequence iteratively
    // This method is more memory efficient than recursion
    for ($i = 2; $i < $n; $i++) {
        // Each number is the sum of the two preceding ones
        $fibSequence[] = $fibSequence[$i - 1] + $fibSequence[$i - 2];
    }
    
    // Display the sequence
    echo "First $n Fibonacci numbers: " . implode(", ", $fibSequence);
}

// Example usage
$count = 10; // Change this value to generate a different number of Fibonacci terms
generateFibonacci($count);
?>
