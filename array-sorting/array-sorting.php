<?php
/**
 * Array Sorting Algorithms
 * 
 * This file contains implementations of different sorting algorithms
 * for both ascending and descending order without using PHP's built-in
 * sorting functions.
 */

/**
 * Validates if the input is a valid array with comparable elements
 * 
 * @param mixed $input The input to validate
 * @return bool True if input is a valid array, false otherwise
 */
function isValidComparableArray($input): bool {
    // Check if input is an array
    if (!is_array($input)) {
        return false;
    }
    
    return true;
}

/**
 * Custom swap function to exchange elements in an array
 * 
 * @param array &$array The array containing elements to swap
 * @param int $i Index of first element
 * @param int $j Index of second element
 * @return void
 */
function swap(array &$array, int $i, int $j): void {
    $temp = $array[$i];
    $array[$i] = $array[$j];
    $array[$j] = $temp;
}

/**
 * Quicksort algorithm implementation
 * 
 * @param array &$array The array to sort
 * @param int $low Starting index
 * @param int $high Ending index
 * @param bool $ascending True for ascending, false for descending
 * @return void
 */
function quickSort(array &$array, int $low, int $high, bool $ascending = true): void {
    // Base case: If low >= high, subarray is sorted or empty
    if ($low < $high) {
        // Partition the array and get the pivot index
        $pivotIndex = partition($array, $low, $high, $ascending);
        
        // Recursively sort elements before and after pivot
        quickSort($array, $low, $pivotIndex - 1, $ascending);
        quickSort($array, $pivotIndex + 1, $high, $ascending);
    }
}

/**
 * Partitioning function for Quicksort
 * 
 * @param array &$array The array to partition
 * @param int $low Starting index
 * @param int $high Ending index
 * @param bool $ascending True for ascending, false for descending
 * @return int The pivot index
 */
function partition(array &$array, int $low, int $high, bool $ascending): int {
    // Choose the rightmost element as pivot
    $pivot = $array[$high];
    
    // Index of smaller/greater element
    $i = $low - 1;
    
    // Traverse through all elements
    // Compare each element with pivot
    for ($j = $low; $j < $high; $j++) {
        // If ascending order
        if ($ascending) {
            // If current element is smaller than the pivot
            if ($array[$j] <= $pivot) {
                $i++; // Increment index of smaller element
                swap($array, $i, $j);
            }
        } else { // If descending order
            // If current element is greater than the pivot
            if ($array[$j] >= $pivot) {
                $i++; // Increment index of greater element
                swap($array, $i, $j);
            }
        }
    }
    
    // Swap the pivot element with the element at position i+1
    swap($array, $i + 1, $high);
    
    // Return the position from where partition is done
    return $i + 1;
}

/**
 * Merge Sort algorithm implementation
 * 
 * @param array &$array The array to sort
 * @param int $left Starting index
 * @param int $right Ending index
 * @param bool $ascending True for ascending, false for descending
 * @return void
 */
function mergeSort(array &$array, int $left, int $right, bool $ascending = true): void {
    // Base case: if there's only one element or none
    if ($left >= $right) {
        return;
    }
    
    // Find the middle point
    $middle = (int)(($left + $right) / 2);
    
    // Sort first and second halves
    mergeSort($array, $left, $middle, $ascending);
    mergeSort($array, $middle + 1, $right, $ascending);
    
    // Merge the sorted halves
    merge($array, $left, $middle, $right, $ascending);
}

/**
 * Merge function for Merge Sort
 * 
 * @param array &$array The array to merge
 * @param int $left Left index
 * @param int $middle Middle index
 * @param int $right Right index
 * @param bool $ascending True for ascending, false for descending
 * @return void
 */
function merge(array &$array, int $left, int $middle, int $right, bool $ascending): void {
    // Calculate sizes of two subarrays to be merged
    $n1 = $middle - $left + 1;
    $n2 = $right - $middle;
    
    // Create temporary arrays
    $leftArray = [];
    $rightArray = [];
    
    // Copy data to temporary arrays
    for ($i = 0; $i < $n1; $i++) {
        $leftArray[$i] = $array[$left + $i];
    }
    for ($j = 0; $j < $n2; $j++) {
        $rightArray[$j] = $array[$middle + 1 + $j];
    }
    
    // Merge the temporary arrays back into original array
    $i = 0;     // Initial index of first subarray
    $j = 0;     // Initial index of second subarray
    $k = $left; // Initial index of merged subarray
    
    while ($i < $n1 && $j < $n2) {
        if ($ascending) {
            // For ascending order
            if ($leftArray[$i] <= $rightArray[$j]) {
                $array[$k] = $leftArray[$i];
                $i++;
            } else {
                $array[$k] = $rightArray[$j];
                $j++;
            }
        } else {
            // For descending order
            if ($leftArray[$i] >= $rightArray[$j]) {
                $array[$k] = $leftArray[$i];
                $i++;
            } else {
                $array[$k] = $rightArray[$j];
                $j++;
            }
        }
        $k++;
    }
    
    // Copy the remaining elements of leftArray[], if any
    while ($i < $n1) {
        $array[$k] = $leftArray[$i];
        $i++;
        $k++;
    }
    
    // Copy the remaining elements of rightArray[], if any
    while ($j < $n2) {
        $array[$k] = $rightArray[$j];
        $j++;
        $k++;
    }
}

/**
 * Insertion Sort algorithm implementation
 * More efficient for small arrays
 * 
 * @param array &$array The array to sort
 * @param bool $ascending True for ascending, false for descending
 * @return void
 */
function insertionSort(array &$array, bool $ascending = true): void {
    $length = count($array);
    
    for ($i = 1; $i < $length; $i++) {
        $key = $array[$i];
        $j = $i - 1;
        
        if ($ascending) {
            // For ascending order
            while ($j >= 0 && $array[$j] > $key) {
                $array[$j + 1] = $array[$j];
                $j--;
            }
        } else {
            // For descending order
            while ($j >= 0 && $array[$j] < $key) {
                $array[$j + 1] = $array[$j];
                $j--;
            }
        }
        
        $array[$j + 1] = $key;
    }
}

/**
 * Wrapper function to sort and display array
 * 
 * @param array $input The array to sort
 * @param bool $ascending True for ascending, false for descending
 * @param string $algorithm Sorting algorithm to use: 'quick', 'merge', or 'insertion'
 * @return void
 */
function sortAndDisplayArray(array $input, bool $ascending = true, string $algorithm = 'quick'): void {
    // Validate input
    if (!isValidComparableArray($input)) {
        echo "Please provide a valid array.";
        return;
    }
    
    // Create a copy of the input array to avoid modifying the original
    $arrayCopy = $input;
    
    // Display original array
    $originalArrayString = '[' . implode(', ', $arrayCopy) . ']';
    echo "Original array: $originalArrayString\n";
    
    // Sort using the specified algorithm
    $startTime = microtime(true);
    
    switch (strtolower($algorithm)) {
        case 'merge':
            mergeSort($arrayCopy, 0, count($arrayCopy) - 1, $ascending);
            $algorithmName = "Merge Sort";
            break;
        case 'insertion':
            insertionSort($arrayCopy, $ascending);
            $algorithmName = "Insertion Sort";
            break;
        case 'quick':
        default:
            quickSort($arrayCopy, 0, count($arrayCopy) - 1, $ascending);
            $algorithmName = "Quick Sort";
    }
    
    $endTime = microtime(true);
    $executionTime = ($endTime - $startTime) * 1000; // Convert to milliseconds
    
    // Display sorted array
    $sortedArrayString = '[' . implode(', ', $arrayCopy) . ']';
    $orderType = $ascending ? "ascending" : "descending";
    echo "Sorted array ($orderType using $algorithmName): $sortedArrayString\n";
    echo "Execution time: " . number_format($executionTime, 6) . " ms";
}

// Example usage
$arrayToSort = [34, 7, 23, 32, 5, 62, 1, 19, 42, 11, 94];

echo "ASCENDING ORDER:\n";
sortAndDisplayArray($arrayToSort, true, 'quick');

echo "\n\nDESCENDING ORDER:\n";
sortAndDisplayArray($arrayToSort, false, 'quick');

// Try different algorithms for comparison
// echo "\n\nUsing Merge Sort (ascending):\n";
// sortAndDisplayArray($arrayToSort, true, 'merge');

// echo "\n\nUsing Insertion Sort (descending):\n";
// sortAndDisplayArray($arrayToSort, false, 'insertion');

/**
 * Recommendations
 *  For Large Arrays (>1000 elements)   : Quicksort or Mergesort should be preferred
 *  For Small Arrays (<50 elements)     : Insertion Sort may be more efficient
 *  If Stability is Important           : Merge Sort should be preferred (order of equal elements is preserved)
 *  If Memory Constrained               : Quick Sort or Insertion Sort should be preferred
 */
?>
