<?php
header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="ISO-8859-1"?>';

if(isset($_REQUEST['From']))
	$from = $_REQUEST['From'];

//Load Redis Library
require 'Predis/Autoloader.php';
Predis\Autoloader::register();

//Connect to Redis Server
$redis = new Predis\Client();

//Fetch IVR Structure from DB

	//Survey ID
	/*
	$temp = $redis->lindex("Survey",0);
	$sid = $redis->get($temp); 
	*/
	$sid = $redis->get("Survey-ID");
	$list = "Survey: ".$sid;		
	//Questions
	$q1= $redis->lindex($list,0); 
	$q2= $redis->lindex($list,1);
	$q3= $redis->lindex($list,2);
	
	//Options(Array)
	$options1 = $redis->lrange($q1,0,-1);
	$options2 = $redis->lrange($q2,0,-1);
	$options3 = $redis->lrange($q3,0,-1);

//Format Structure to XML
	if(!isset($_REQUEST['q'])){
			print "<Response>";
			print "<GetDigits action=\"http://127.0.0.1:8080/answered/digitsresponse?from=".$from."&amp;sid=".$sid."&amp;q=1\" redirect=\"false\" numDigits=\"1\" method=\"POST\">";
			print "<Speak>Hi, This is a Survey Demo!</Speak>";
			print "<Speak>".$q1."</Speak>";
			foreach($options1 as $key=>$value){
				print "<Speak>".$value."</Speak>";
			}
			print "</GetDigits></Response>";
	}
	else if($_REQUEST['q']=='2'){
			print "<Response>";		
			print "<GetDigits action=\"http://127.0.0.1:8080/answered/digitsresponse?sid=".$sid."&amp;q=2\" redirect=\"false\" numDigits=\"1\" method=\"POST\">";
			print "<Speak>Next Question is.</Speak>";
			print "<Speak>".$q2."</Speak>";
			foreach($options2 as $key=>$value){
				print "<Speak>".$value."</Speak>";
			}
		print "</GetDigits></Response>";
		}
	else if($_REQUEST['q']=='3'){
			print "<Response>";
			print "<GetDigits action=\"http://127.0.0.1:8080/answered/digitsresponse?sid=".$sid."&amp;q=3\" redirect=\"false\" numDigits=\"1\" method=\"POST\">";
			print "<Speak>Next Question is.</Speak>";
			print "<Speak>".$q3."</Speak>";
			foreach($options3 as $key=>$value){
				print "<Speak>".$value."</Speak>";
			}
		print "</GetDigits></Response>";
	}
	else if($_REQUEST['q']=='4'){
			print "<Response><Speak>Thank You for taking this Survey</Speak><Hangup/></Response>";
		}

?> 

