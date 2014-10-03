<?php

function build_word_list(){
	$regex="/<li>[a-z,\s]*<\/li>/";
	$file_contents = file_get_contents("http://www.paulnoll.com/Books/Clear-English/words-01-02-hundred.html");
	preg_match_all($regex, $file_contents, $word_list);
	foreach ($word_list as &$value) {
		//remove <li> and </li>
		$remove_values=array("<li>", "</li>");
		$value = str_replace($remove_values, "", $value);
		//remove all whitepaces
		$value = preg_replace('/\s+/', '', $value);
	}
	return $word_list[0];
}

$userinputs = array(); //keep track of user inputs
$password = ''; //password is a string
$error_message = ''; //start out with no error message
//list of random words
//$listofwords = array('hi', 'bob', 'thread', 'crazy', 'poop', 'work', 'school', 'chair', 'kitchen', 'dog', 'cat', 'bat', 'sat');
$listofwords=build_word_list();
//create list of special characters from ascii codes
$ascii_code_symbols = array_merge(range(33,47), range(58, 64), range(91, 96), range(123, 126));
$listofspecialchars='';
foreach ($ascii_code_symbols as $key => $value) {
	$listofspecialchars[]=chr($value);
}
//create list of numbers
$listofnums = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

//get specifications from user
foreach($_GET as $key => $value){
	$userinputs[$key] = $value;
}

//construct password from random words
if (array_key_exists('numwords', $userinputs)){
	//check to make sure we assemble a valid # of words
	if($userinputs['numwords']>0 && $userinputs['numwords']<=sizeof($listofwords)){

		$password_keys = array_rand($listofwords, $userinputs['numwords']);
		//if only one word convert to array
		if($userinputs['numwords'] == 1){
			$password_keys_array[]=$password_keys;
		}
		//else copy to the same array
		else{
			$password_keys_array = $password_keys;
		}
		
		foreach ($password_keys_array as $key => $value) {
			//add a dash between words
			if($key != 0){
				$password = $password.'-';
			}
			//append each word onto the password string
			$password = $password.$listofwords[$value];
		}

	}
	else{
		$error_message = "Please enter a valid number of words from which to construct a password. This must be greater than 0 but less than or equal to".sizeof($listofwords).".";
	}
}

if(array_key_exists('specialchar', $userinputs)){
	//if box is selected
	//if(isset($userinputs('specialchar')){
		$randomspecialchar = array_rand($listofspecialchars);
		$password=$password.$listofspecialchars[$randomspecialchar];
	//}
}

if(array_key_exists('number', $userinputs)){
	//if box is selected
//	if(isset($userinputs('number')){
		$randomnum = array_rand($listofnums);
		$password=$password.$listofnums[$randomnum];
//	}
}

