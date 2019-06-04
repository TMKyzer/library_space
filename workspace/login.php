<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
   <link rel="stylesheet" type="text/css" href="css_form/styles.css">  
    
    <style>
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
          <a href="https://library-space-kxshukla.c9users.io/homepage/index.html"><img src = "images/logo.png" alt="logo"></a>
          <h1>Ottenhiemer Library</h1>
        </div>
        
    <div class="header">
        <h2>LOGIN</h2>
     </div>

    <form method="post" action="login.php">
        
        <!-- display validation errors here -->
        <?php include ('errors.php'); ?>
        
         <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>
        
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
         <div class="input-group">
            <button type="submit" name="login" class="btn"> Login </button>
        </div>
        <p>
            Not yet a member? <a href="register.php">Sign up</a>
        </p>
       
    </form>
</body>
</html>