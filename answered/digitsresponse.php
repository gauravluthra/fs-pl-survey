<?php
		$file = fopen('call.txt','a') or die('Cannot open File');
		
		$digits = $_REQUEST['Digits'];
		$curQ = $_REQUEST['q'];
		$sid = $_REQUEST['sid'];
		
		if(isset($_REQUEST['from'])){
			$from = $_REQUEST['from'];
			fwrite($file,"Survey-ID: ".$sid." New Call From ".$from."\n");
		}

		
		if ($digits == '#'){
			fwrite($file,"User Pressed to Exit.\n");        
		}
		else{
			fwrite($file,"Answer for Question ".$curQ." is ".$digits."\n");
		}
		
		header('Content-Type: application/xml');
		echo '<?xml version="1.0" encoding="ISO-8859-1"?>';

		if($curQ=='1'){
			$out="<Response><Speak>You Answered Question 1</Speak><Redirect>http://127.0.0.1:8080/answered?q=2</Redirect></Response>";
		}
		else if($curQ=='2'){
			$out="<Response><Speak>You Answered Question 2</Speak><Redirect>http://127.0.0.1:8080/answered?q=3</Redirect></Response>";
		}
		else if($curQ=='3'){
			$out="<Response><Speak>You Answered Question 3</Speak><Redirect>http://127.0.0.1:8080/answered?q=4</Redirect></Response>";
		}
	
	print($out);
	fclose($file);

?>

