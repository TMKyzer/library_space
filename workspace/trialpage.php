<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="roomtable/roomtimetable.css">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UALR - Library Rooms</title>


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
        
        
    </style>
  
  
</head>
<body>
  
  
  
   <div class="top-header">
          <a href="https://library-space-kxshukla.c9users.io/homepage.php"><img src = "../images/logo.png" alt="logo"></a>
          <h1>Ottenhiemer Library</h1>
        </div>


 <div class="content">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="error success">
                <h3>
                    <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        
        <?php if (isset($_SESSION["username"])): ?>
            <h2> Reservation for <strong><?php echo $_SESSION['username']; ?>&#44;</strong></h2>
          
              <p><a href="trialpage.php?logout='1"style="color:red;">Logout</a></p>
         
        <?php endif ?>
    </div>

</body>
</html>