<?php

function build_word_list(){
	$regex="/<li>[a-z,\s]*<\/li>/";
	//read in list of words from http://www.paulnoll.com/Books/Clear-English/
	//pick a random list of words to use each time
	$word_building_subpages = array("01-02", "03-04", "05-06", "07-08", "09-10", "11-12", "13-14", "15-16", "17-18", "19-20", "21-22", "23-24", "25-26", "27-28", "29-30");
	$rand_subpage = array_rand($word_building_subpages);
	$html_string = "http://www.paulnoll.com/Books/Clear-English/words-".$word_building_subpages[$rand_subpage]."-hundred.html";
	$file_contents = file_get_contents($html_string);
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

$word_limit = 8; //max number of words for a password
$userinputs = array(); //keep track of user inputs
$password = ''; //password is a string
$error_message = ''; //start out with no error message

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
	if($userinputs['numwords']>0 && $userinputs['numwords']<=$word_limit){

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
		$error_message = "Please enter a valid number of words from which to construct a password. This must be greater than 0 but less than or equal to".$word_limit.".";
	}
}

if(array_key_exists('specialchar', $userinputs)){
	//if box is selected
	$randomspecialchar = array_rand($listofspecialchars);
	$password=$password.$listofspecialchars[$randomspecialchar];
}

if(array_key_exists('number', $userinputs)){
	//if box is selected
	$randomnum = array_rand($listofnums);
	$password=$password.$listofnums[$randomnum];
}

