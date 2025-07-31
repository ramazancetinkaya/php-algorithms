<?php
/**
 * Array Sum Algorithm
 * 
 * This algorithm efficiently calculates the sum of elements in a numeric array
 * without using PHP's built-in functions like array_sum().
 */

/**
 * Validates if the input is an array containing only numeric values
 * 
 * @param mixed $input The input to validate
 * @return bool True if input is a valid numeric array, false otherwise
 */
function isValidNumericArray($input): bool {
    // Check if input is an array
    if (!is_array($input)) {
        return false;
    }
    
    // Check if array is empty
    if (empty($input)) {
        return true; // Empty arrays are valid, sum will be 0
    }
    
    // Check if all elements are numeric
    foreach ($input as $value) {
        if (!is_numeric($value)) {
            return false;
        }
    }
    
    return true;
}

/**
 * Calculates the sum of elements in a numeric array
 * 
 * @param array $numbers The array of numbers to sum
 * @return float|int The sum of the array elements
 */
function calculateArraySum(array $numbers): float|int {
    // Validate input
    if (!isValidNumericArray($numbers)) {
        throw new InvalidArgumentException("Input must be an array of numeric values");
    }
    
    // Handle empty array
    if (empty($numbers)) {
        return 0;
    }
    
    // Initialize sum
    $sum = 0;
    
    // Iterate through array and add each element to the sum
    // This single-pass approach minimizes memory usage
    foreach ($numbers as $number) {
        $sum += $number;
    }
    
    return $sum;
}

/**
 * Enhanced array sum algorithm with Kahan summation for improved accuracy
 * Useful for large arrays with floating point numbers
 * 
 * @param array $numbers The array of numbers to sum
 * @return float|int The sum of the array elements
 */
function calculateArraySumPrecise(array $numbers): float|int {
    // Validate input
    if (!isValidNumericArray($numbers)) {
        throw new InvalidArgumentException("Input must be an array of numeric values");
    }
    
    // Handle empty array
    if (empty($numbers)) {
        return 0;
    }
    
    // Initialize variables for Kahan summation algorithm
    $sum = 0;
    $compensation = 0; // Compensation term for lost low-order bits
    
    // Apply Kahan summation algorithm
    // This reduces numerical errors when summing floating-point numbers
    foreach ($numbers as $number) {
        $y = $number - $compensation;     // Adjusted input
        $t = $sum + $y;                   // Next sum
        $compensation = ($t - $sum) - $y; // Compute rounding error
        $sum = $t;                        // Store current sum
    }
    
    return $sum;
}

/**
 * Wrapper function to calculate and display the sum of an array
 * 
 * @param array $input The array of numbers to sum
 * @param bool $usePreciseMethod Whether to use the precise calculation method
 * @return void
 */
function sumAndDisplayArray(array $input, bool $usePreciseMethod = false): void {
    // Validate input
    if (!isValidNumericArray($input)) {
        echo "Please provide a valid array of numeric values.";
        return;
    }
    
    // Calculate sum using the appropriate method
    $sum = $usePreciseMethod 
        ? calculateArraySumPrecise($input)
        : calculateArraySum($input);
    
    // Format array for display
    $arrayString = '[' . implode(', ', $input) . ']';
    
    // Display result
    echo "Array: $arrayString\n";
    echo "Sum: $sum";
}

// Example usage
$numbersToSum = [10, 20, 30, 40, 50]; // Change this array to sum different numbers
sumAndDisplayArray($numbersToSum);

// For arrays with floating point numbers that require high precision
// $floatingPointNumbers = [0.1, 0.2, 0.3, 0.4, 0.5];
// sumAndDisplayArray($floatingPointNumbers, true);
?>
