<?php
	final class Util { 
		public static function is_valid_email($email) {
			$ubit = strtok($email, '@');
			$rest = strtok('');
			
			// first check if '@' exists in string
			if (($at = strpos($email, "@")) == FALSE) return FALSE;
			
			// check that ubit is 8 characters
			if (strlen($ubit) !== 8) return FALSE;

			// ensure that email is from UB
			if ($rest !== 'buffalo.edu') return FALSE;

			return TRUE;
 		}
	} 
?>