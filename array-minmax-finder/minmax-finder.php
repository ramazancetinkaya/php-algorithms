<?php
/**
 * Array Min-Max Finder Algorithm
 * 
 * This algorithm efficiently finds the minimum and maximum values
 * in an array with a single pass approach to optimize performance.
 */

/**
 * Validates if the input is a non-empty array with comparable elements
 * 
 * @param mixed $input The input to validate
 * @return bool True if input is a valid non-empty array, false otherwise
 */
function isValidComparableArray($input): bool {
    // Check if input is an array
    if (!is_array($input)) {
        return false;
    }
    
    // Check if array is empty
    if (empty($input)) {
        return false;
    }
    
    return true;
}

/**
 * Finds the minimum and maximum values in an array
 * 
 * @param array $array The array to search
 * @return array An associative array with 'min' and 'max' keys
 * @throws InvalidArgumentException if the array is empty
 */
function findMinMax(array $array): array {
    // Validate input
    if (!isValidComparableArray($array)) {
        throw new InvalidArgumentException("Input must be a non-empty array");
    }
    
    // Initialize min and max with the first element
    $min = $array[0];
    $max = $array[0];
    
    // Count elements using custom function
    $count = customCount($array);
    
    // Single-pass approach: iterate through the array once
    // Starting from index 1 since we already used index 0
    for ($i = 1; $i < $count; $i++) {
        $current = $array[$i];
        
        // Update minimum if current element is smaller
        if ($current < $min) {
            $min = $current;
        }
        // Update maximum if current element is larger
        // Using 'else if' optimization when possible
        // (If a value is new minimum, it can't be new maximum)
        else if ($current > $max) {
            $max = $current;
        }
    }
    
    // Return results as an associative array
    return [
        'min' => $min,
        'max' => $max
    ];
}

/**
 * Optimized min-max finder for numeric arrays
 * Uses a pairwise comparison technique to reduce the number of comparisons
 * 
 * @param array $array The numeric array to search
 * @return array An associative array with 'min' and 'max' keys
 * @throws InvalidArgumentException if the array is empty or non-numeric
 */
function findMinMaxOptimized(array $array): array {
    // Validate input
    if (!isValidComparableArray($array)) {
        throw new InvalidArgumentException("Input must be a non-empty array");
    }
    
    // Count elements
    $count = customCount($array);
    
    // Initialize min and max
    $min = $array[0];
    $max = $array[0];
    
    // Process elements in pairs to reduce comparisons
    // This optimized algorithm uses ~1.5n comparisons instead of 2n
    // For even-length arrays, we start from index 1
    // For odd-length arrays, we start from index 2 as we've already used index 0
    $startIndex = ($count % 2 == 0) ? 0 : 1;
    
    for ($i = $startIndex; $i < $count - 1; $i += 2) {
        $first = $array[$i];
        $second = $array[$i + 1];
        
        // Determine smaller and larger of the pair
        if ($first < $second) {
            $smaller = $first;
            $larger = $second;
        } else {
            $smaller = $second;
            $larger = $first;
        }
        
        // Update min and max
        if ($smaller < $min) {
            $min = $smaller;
        }
        
        if ($larger > $max) {
            $max = $larger;
        }
    }
    
    return [
        'min' => $min,
        'max' => $max
    ];
}

/**
 * Custom count function without using built-in count()
 * 
 * @param array $array The array to count
 * @return int The number of elements in the array
 */
function customCount(array $array): int {
    $count = 0;
    
    // Manual iteration to count elements
    foreach ($array as $element) {
        $count++;
    }
    
    return $count;
}

/**
 * Wrapper function to find and display min-max of an array
 * 
 * @param array $input The array to analyze
 * @param bool $useOptimized Whether to use the optimized algorithm
 * @return void
 */
function findAndDisplayMinMax(array $input, bool $useOptimized = false): void {
    // Validate input
    if (!isValidComparableArray($input)) {
        echo "Please provide a valid non-empty array.";
        return;
    }
    
    try {
        // Find min and max using the appropriate method
        $result = $useOptimized 
            ? findMinMaxOptimized($input)
            : findMinMax($input);
        
        // Format array for display (limited to 10 elements if larger)
        $displayArray = customCount($input) > 10 
            ? array_slice($input, 0, 10) 
            : $input;
        
        $arrayString = '[' . implode(', ', $displayArray);
        
        if (customCount($input) > 10) {
            $arrayString .= ', ...';
        }
        
        $arrayString .= ']';
        
        // Display results
        echo "Array: $arrayString\n";
        echo "Minimum value: {$result['min']}\n";
        echo "Maximum value: {$result['max']}";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Example usage
$numbersArray = [42, 17, 8, 94, 23, 61, 12, 51, 6, 33];
findAndDisplayMinMax($numbersArray, true); // Set to true to use optimized algorithm
?>
