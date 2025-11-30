<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form method="post">
	<pre>
    <input type="text" name="txtUsername" placeholder="Username">
    <input type="password" name="txtPassword" placeholder="Password">
    <input type="text" name="txtFname" placeholder="Firstname">
    <input type="text" name="txtLname" placeholder="Lastname">
    <input type="text" name="txtCourse" placeholder="Course">
    <input type="number" name="txtYear" value="Year">
    <input type="submit" name="btnRegister" value="Register">

    </pre>
	</form>
</body>
</html>

<?php
	$conn= mysqli_connect("localhost","root","","eventmanagement");
	


	if(isset($_POST['btnRegister'])){
		$uname =$_POST['txtUsername'];
		$pwd=$_POST['txtPassword'];
		$fname =$_POST['txtFname'];
		$lname=$_POST['txtLname'];
		$course =$_POST['txtCourse'];
		$yr=$_POST['txtYear'];


	$sqlSelect="select * from users where username='$uname'";

	$result =mysqli_query($conn,$sqlSelect);

	if(mysqli_num_rows($result)==0){
		$sqlUsers="insert into users(username,password,fname,lname)
			values ('$uname','$pwd','$fname','$lname')";
		mysqli_query($conn,$sqlUsers);
		$sqlStudent="insert into student values('$course',$yr,'$uname')"; 
	
		mysqli_query($conn,$sqlStudent);	
	}else

		echo '<script>
			alert("username name is existing.");
		</script>';

	}

?>