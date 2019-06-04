<?php 
include('../server.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
	
	.header 
	{
		background: #003366;
		color: white;
		text-align: center;
	}
	button[name=register_btn] 
	{
		background: #003366;
	}
	.table
	{
		border-collapse: collapse;
		width: 100%;
		height: 100%;
	}
	table, th, td 
	{
     border: 1px solid black;
     text-align: center;
    }
	
	</style>
</head>
<body>
	
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<div class="profile_info">
		

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
			<p>Welcome		<strong><?php echo $_SESSION['user']['username']; ?>&#44;</strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="admin_home.php?logout='1'" style="color: red;">logout</a>
                       &nbsp; 
					</small></p>  

				<?php endif ?>
			</div>
		</div>
	</div>
	

	
	<?php
	$sql = 'select * from admin_table';
	$query = mysqli_query($db, $sql);
	
	if (!$query)
	{
		die('error found' . mysqli_error($conn));
	}
	
	
	echo "
	<table class='table'>
	<tr>
	<th>FirstName</th>
	<th>LastName</th>
	<th>Email</th>
	<th>Major</th>
	<th>BirthDate</th>
	<th>Telephone</th>
	<th>Address</th>
	<th>City</th>
	<th>State</th>
	<th>Zip</th>
	</tr>";
	
	while ($row = mysqli_fetch_array($query))
	{
		echo '<tr>
		<td>'.$row['FirstName'].'</td>
		<td>'.$row['LastName'].'</td>
		<td>'.$row['Email'].'</td>
		<td>'.$row['Major'].'</td>
		<td>'.$row['BirthDate'].'</td>
		<td>'.$row['Telephone'].'</td>
		<td>'.$row['Address'].'</td>	
		<td>'.$row['City'].'</td>	
		<td>'.$row['State'].'</td>	
     	<td>'.$row['Zip'].'</td>
     	</tr>';
	}
	
	echo "</table>";
	?>


</body>
</html>
