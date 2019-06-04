<?php include('../server.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Registration</title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
	<style>
		.header {
			background: #003366;
			color: white;
			text-align: center;
		}
		button[name=register] {
			background: #003366;
			color: white;
		}
	
        .top-header{
            padding: 20px;
            text-align: center;
            background-color: #541823;
            color: white;
            margin: auto;
        }
        
      .top-header img {
             float: left;
             width: 100px;
             height: 100px;
             border: 4px solid #ddd;
             border-radius: 4px;
             }
            
   
	</style>
</head>
<body>
	 <div class="top-header">
          <a href="https://capstone-kxshukla.c9users.io/workspace/homepage/index.html"><img src = "../images/logo.png" alt="logo"></a>
          <h1>Ottenhiemer Library</h1>
     </div>
     
	<div class="header">
		<h2>Admin - create user</h2>
	</div>
	
	<form method="post" action="createuser.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?php echo $first_name; ?>">
        </div>
     <div class="input-group">
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?php echo $last_name; ?>">
        </div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>User type</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="register"> + Create Admin</button>
		</div>
	</form>
</body>
</html>
