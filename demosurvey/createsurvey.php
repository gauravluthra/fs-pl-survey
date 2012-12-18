<html>
<head>
<title>Demo Survey App</title>
</head>
<body>
<p>
<?php

//Load Redis Library
require 'Predis/Autoloader.php';
Predis\Autoloader::register();

//Connect to Redis Server
$redis = new Predis\Client();

//Store into DB as ('SurveyID' => List<'Question',List<Options>>)

//Map DTMF Keypad to an Array
$dtmfkeypad=array(0=>'Press 1',1=>'Press 2',2=>'Press 3',3=>'Press 4',4=>'Press 5',5=>'Press 6',6=>'Press 7',7=>'Press 8',8=>'Press 9',9=>'Press 0',10=>'Press *',11=>'Press #');

//Fetch Form Data
	//Questions	
	$Q1=$_POST['Q1'];
	$Q2=$_POST['Q2'];
	$Q3=$_POST['Q3'];
	//Option Lists
	$O1=$_POST['O1'];
	$O2=$_POST['O2'];
	$O3=$_POST['O3'];
	
	//Create List for Question-> Options Pairs
	$list1=$Q1;
	$list2=$Q2;
	$list3=$Q3;

	//Display for each (set)Question the Options List to be presented via IVR.	
	echo $Q1.'<br/>';	//Question 1	
	foreach ($O1 as $key=>$value){
		if (!empty($value)){
			$redis->rpush($list1, $dtmfkeypad[$key].' '.$value);
			echo $dtmfkeypad[$key].' '.$value.'<br/>';
		}
		else
			continue;
	}
	echo '<hr/>';
	
	echo $Q2.'<br/>';	//Question 2
	foreach ($O2 as $key=>$value){
		if (!empty($value)){
			$redis->rpush($list2, $dtmfkeypad[$key].' '.$value);
			echo $dtmfkeypad[$key].' '.$value.'<br/>';
		}
		else
			continue;
	}
	echo '<hr/>';
	
	echo $Q3.'<br/>';	//Question 3
	foreach ($O3 as $key=>$value){
		if (!empty($value)){
			$redis->rpush($list3, $dtmfkeypad[$key].' '.$value);
			echo $dtmfkeypad[$key].' '.$value.'<br/>';
		}
		else
			continue;
	}
// Parent Key(Survey-ID)
	$parent="Survey-ID";
	$sid = $redis->incr($parent); //Increment Survey-ID

// L1 Child List Survey:ID<Q1,Q2,Q3>, L2 Child List Q(n)<Option1,Option2....OptionN> 	
	$list= 'Survey: '.$sid;
	$redis->rpush($list,$list1);
	$redis->rpush($list,$list2);
	$redis->rpush($list,$list3);

?>
<hr/>
Survey Created Successfully!<br/>
<a href="./index.php">Home</a>
</p>
</html>
