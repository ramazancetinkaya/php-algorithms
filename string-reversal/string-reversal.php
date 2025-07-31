<?php
/**
 * String Reversal Algorithm
 * 
 * This algorithm efficiently reverses a string without using PHP's built-in
 * functions like strrev(). It implements a two-pointer approach for optimal
 * performance and memory usage.
 */

/**
 * Validates if the input is a valid string
 * 
 * @param mixed $input The input to validate
 * @return bool True if input is a valid string, false otherwise
 */
function isValidString($input): bool {
    return is_string($input);
}

/**
 * Reverses a string using a two-pointer approach
 * 
 * @param string $str The string to reverse
 * @return string The reversed string
 */
function reverseString(string $str): string {
    // Validate input
    if (!isValidString($str)) {
        throw new InvalidArgumentException("Input must be a string");
    }
    
    // Get string length using custom function
    $length = customStrlen($str);
    
    // Empty or single character strings are already "reversed"
    if ($length <= 1) {
        return $str;
    }
    
    // Convert string to character array for easier manipulation
    // This is necessary because PHP strings are immutable
    $charArray = [];
    for ($i = 0; $i < $length; $i++) {
        $charArray[] = $str[$i];
    }
    
    // Two-pointer approach: swap characters from both ends
    // This is more efficient than building a new string in reverse
    $left = 0;
    $right = $length - 1;
    
    while ($left < $right) {
        // Swap characters at left and right pointers
        $temp = $charArray[$left];
        $charArray[$left] = $charArray[$right];
        $charArray[$right] = $temp;
        
        // Move pointers towards the center
        $left++;
        $right--;
    }
    
    // Convert character array back to string
    return customImplode('', $charArray);
}

/**
 * Custom string length function without using built-in strlen()
 * 
 * @param string $str The string to measure
 * @return int The length of the string
 */
function customStrlen(string $str): int {
    $count = 0;
    
    // Count each character in the string
    // This works because PHP strings can be accessed like arrays
    while (isset($str[$count])) {
        $count++;
    }
    
    return $count;
}

/**
 * Custom implode function without using built-in implode()
 * 
 * @param string $glue The string to place between elements
 * @param array $pieces The array to join
 * @return string The joined string
 */
function customImplode(string $glue, array $pieces): string {
    $result = '';
    $count = count($pieces);
    
    for ($i = 0; $i < $count; $i++) {
        // Add the current piece
        $result .= $pieces[$i];
        
        // Add the glue if it's not the last element
        if ($i < $count - 1) {
            $result .= $glue;
        }
    }
    
    return $result;
}

/**
 * Wrapper function to reverse and display a string
 * 
 * @param string $input The string to reverse
 * @return void
 */
function reverseAndDisplayString(string $input): void {
    // Validate input
    if (!isValidString($input)) {
        echo "Please enter a valid string.";
        return;
    }
    
    // Reverse the string and display result
    $reversed = reverseString($input);
    echo "Original string: '$input'\n";
    echo "Reversed string: '$reversed'";
}

// Example usage
$stringToReverse = "Hello, World!"; // Change this value to reverse different strings
reverseAndDisplayString($stringToReverse);
?>
