<?php 
	$err ="";
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$number = $_POST['numbers'];
		
		if(empty($number)){
			$err = "Please enter phone number";
		}elseif(strlen($number) < 11){
			$err = "Phone number must be 11 digits";
		}else{
		
			$number = test_input($number);
			
		$servername = "localhost";
		$dbusername = "root";
		$dbpassword = "";
		$dbname = "numberdb";
		//create connectionto the database
		$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname) or die("Unable to connect");
		
		//check  if number has already exist
		$sql = "SELECT * FROM numbers WHERE phoneNo='$number'";
		$result = mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($result);
		$count = mysqli_num_rows($result);
		

		if ($count == 1) {
			//if number already exist return error message
			
			$err = "Phone number already exist";
		}else{
			$sql = "INSERT into numbers(phoneNo) values('$number')";
			if(mysqli_query($conn,$sql)){
				$err = "Phone number {$number} has been added to the database";
			} else {
		   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

		mysqli_close($conn);
			
		}
	}
	//function to clean and sanitze all in put
	function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		  }

	?>
<!doctype html>
<html>
<head>
	<title>My phone numbers database</title>
	<link rel="stylesheet" href="database.css">

</head>
<body>
	<div id="wrapper">
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			<label for="number" >Enter Phone Number </label>
			<input id="input" type="text" name="numbers" maxlength="11" onfocus="this.select();" />
			<span class="error"><?php echo $err ;?></span>
			<input type="submit" value="Add to database" name="submit" id="butn">
		</form>
		<a href="viewnumbers.php" > Click to view all numbers in database</a>
	</div>
	<script>
		
		var btn = document.getElementById("butn");
		btn.onclick = function(){
			var input = document.getElementById("input");
		if(input.value==""){
			alert("Enter Phone number");
			return false;
		}else if(!input.value.match(/^[0-9]+$/)){
			alert("invalid number");
			return false;
		}else if(input.value.length < 11){
			alert("Phone number should be 11 digits");
			return false;
		}
		}
		
	
	</script>
	
</body>

</html>
