<?php  include('../server.php'); 
        // if the user is not logged in, they cannot access this page
       	if (!isLoggedIn()) {
         	$_SESSION['msg'] = "You must log in first";
         	header('location: ../login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="roomtimetable.css">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UALR - Library Rooms</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
   <style>
        .top-header{
            padding: 20px;
            text-align: center;
            background-color: #541823;
            color: white;
        }
        
        .top-header img {
             float: left;
             width: 100px;
             height: 100px;
             border: 4px solid #ddd;
             border-radius: 4px;
             }
          .content a{
          text-align: right;
        }
        .content{
          text-align: left;
        }
          .format{
          float: right;
          display: inline;
           padding: 14px 16px;
           margin: 0;
           border-right: 1px solid #bbb;
           font-size: 18px;
        }
        
        
    </style>
  
  
</head>
<body>
  
   <div class="top-header">
          <a href="https://library-space-kxshukla.c9users.io/homepage.php"><img src = "../images/logo.png" alt="logo"></a>
          <h1>Ottenhiemer Library</h1>
        </div>

 <!------------- Restricting the access ------------------>
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
	  	<!--	<img src="images/user_profile.png"  >  -->
			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
			<strong><?php echo $_SESSION['user']['username']; ?>&#44;</strong> 
					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
					</small></p>  
				<?php endif ?>
			</div>
		</div>
	</div>
    
   

     <div class="format">
      <a href="https://library-space-kxshukla.c9users.io/homepage/index.html">Home</a>
      <a href="https://library-space-kxshukla.c9users.io/index.php">Room Selection</a>
    </div>
  
    <form method="POST" action="">
    <table id="mytable" class="display">
        <thead><tr><th>Date</th><th>Time</th><th>Room</th></tr></thead>
    <?php
        include ('roomtablecon.php');
        
        session_start();
        $user = $_SESSION['username'];
    
        
        $sql = "SELECT date, time, roomnumber FROM timeslot WHERE user='$user'";
        $result = $connection->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['date'] ."</td><td>". $row['time'] ."</td><td>". $row['roomnumber'] . "</td></tr>";
            }
        } 
        else {
            echo "No Reservations";
        }
        
    ?>
</table>
</form>
</body>
</html>