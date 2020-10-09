<?php 

// Function to generate OTP 
function generateNumericOTP($n) { 
	
	// Take a generator string which consist of 
	// all numeric digits 
	$generator = "1357902468"; 

	// Iterate for n-times and pick a single character 
	// from generator and append it to $result 
	
	// Login for generating a random character from generator 
	//	 ---generate a random number 
	//	 ---take modulus of same with length of generator (say i) 
	//	 ---append the character at place (i) from generator to result 

	$result = ""; 

	for ($i = 1; $i <= $n; $i++) { 
		$result .= substr($generator, (rand()%(strlen($generator))), 1); 
	} 

	// Return result 
	return $result; 
} 

// Main program 
$n = 6; 
print_r(generateNumericOTP($n)); 

?> 
