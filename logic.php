<?php

$userinputs = array('numwords');
$password = array();

foreach($_GET as $value){
	$userinputs[] = $value;
}

for($i=0; $i<$userinputs[0]; $i++){
	$password[$i]=rand(1,5);
}
