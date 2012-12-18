<html>
<head>
<title>Demo Survey App</title>
</head>
<body>
<p>Create a survey
<form action="createsurvey.php" method="post">

<!-- Question One -->
	Question 1:<br/> <!--Question Box-->
		<input type="text" name="Q1"><br/>
	Options<br/> <!--Options List-->
		<?php 
		$dtmfkeys = array('1','2','3','4','5','6','7','8','9','0','*','#');
		foreach ($dtmfkeys as $key)
		echo 'Key'.$key.'&nbsp<input type="text" name="O1[]"><br/>';
		?>
<hr/>
<!-- Question Two -->
	Question 2:<br/> <!--Question Box-->
	<input type="text" name="Q2"><br/>
	Options<br/> <!--Options List-->
	<?php 
	$dtmfkeys = array('1','2','3','4','5','6','7','8','9','0','*','#');
	foreach ($dtmfkeys as $key)
	echo 'Key'.$key.'&nbsp<input type="text" name="O2[]"><br/>';
	?>
<hr/>
<!-- Question Three -->
	Question 3:<br/> <!--Question Box-->
	<input type="text" name="Q3"><br/>
	Options<br/> <!--Options List-->
	<?php 
	$dtmfkeys = array('1','2','3','4','5','6','7','8','9','0','*','#');
	foreach ($dtmfkeys as $key)
	echo 'Key'.$key.'&nbsp<input type="text" name="O3[]"><br/>';
	?>

<input type="submit" value="Submit">
</form>
</p>
</body>
<html>
