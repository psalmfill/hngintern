<html>
<head>
	<title>PhoneNumbers:View</title>
	<link rel="stylesheet" href="database.css">
</head>
<body onload="document.getElementById('numberview').select();">
	<div id="wrapper1">
		
		<h1 style="color:blue;margin:2%;">Phone Numbers Found on the database</h1>
		<textarea onfocus="this.select();" id="numberview"><?php
		$servername = "localhost";
		$dbusername = "root";
		$dbpassword = "";
		$dbname = "numberdb";
		//create connectionto the database
		$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname) or die("Unable to connect");
		
		//check  if number has already exist
		$sql = "SELECT * FROM numbers";
		$result = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($result);
		if($count > 0){
			
			while($row = mysqli_fetch_assoc($result)) {
				
        echo $row['phoneNo']."&#13;";
    }
		}
			?></textarea>
			 
	</div>
</body>

</html>
