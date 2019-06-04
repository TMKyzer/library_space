    <!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="roomtimetable.css">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UALR - Library Rooms</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script type="text/javascript">
  	$( function() { 
	     $( "#datepicker" ).datepicker({ minDate: 0, dateFormat: "yy-mm-dd" });
	     $( "#datepicker" ).datepicker("setDate", new Date());
  	} );
	</script>
	<script type="text/javascript">
    $(document).ready(function(){
      var checkCount = 0;
        $('input[type="checkbox"]').click(function(){
            if($(this).is(":checked")){
                checkCount++;
            }
            else if($(this).is(":not(:checked)")){
                checkCount--;
            }
        });
        $('input[type="submit"]').click(function(){
          if(checkCount < 1){
            alert("Select a day/time!!");
          }
        });
    });
</script>
<script type="text/javascript">  //only displays table selected
   jQuery(function () {
      $('#table-select').change(function () {
          $('#tbl_div > div').css('display', 'none');
          if (this.value) {
              $('#' + this.value).css('display', 'block');
          }
      }).change()
  })
</script>
 
 <script type="text/javascript">
  $(document).ready(function(){
   var $form = $('tableForm');
   $form.submit(function(){
      $.post($(this).attr('action'), $(this).serialize(), function(response){
      },'json');
      return false;
   });
  });
 </script>
 
 <script type="text/javascript">
      var jsonData;
      $.ajax({
        type: 'POST',
        url: 'roomtable/checkReservation.php',
        success: function(result) {
          //console.log('this is the result: ' + result);
          jsonData = JSON.parse(result);
          console.log(jsonData);
          jsonData.forEach(function(element){
            var convertedTime = element.time.replace(/:/g, "");
            var combined = element.roomnumber + convertedTime;
            $('#'+combined).prop("disabled", true);
          });
        }
      });
    </script>
 
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
           font-size: 15px;
        }
        
        
    </style>
</head>
<body>
  
   <div class="top-header">
          <a href="https://library-space-kxshukla.c9users.io/homepage/index.html"><img src = "../images/logo.png" alt="logo"></a>
          <h1>Ottenhiemer Library</h1>
        </div>
        
 
     <div class="format">
       <a href="https://library-space-kxshukla.c9users.io/index.php">Room Selection</a>
       <a href="https://library-space-kxshukla.c9users.io/roomtable/reservedlist.php">My Reservations</a>
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
            <p> Welcome <strong><?php echo $_SESSION['username']; ?>&#44;</strong></p>
          
              <p><a href="index.php?logout='1"style="color:red;">Logout</a></p>
         
        <?php endif ?>
    </div>
    <?php
    include ('roomtablecon.php');
 
    
   // include ('server.php');
    session_start();
    $date = $_POST['datepicker'];
    $whichtable = $_POST['table-select'];
    $user = $_SESSION['username'];
    $errors = array();

    if (isset($_POST["submit"])){
        echo '<h2 align="center">You Reserved:</h2>';
        echo '<table>';
        echo '<tr><th>Room</th><th>Time</th><th>Date</th></tr>';
        //echo 'User: '. $user;
        if ($whichtable == 'tb1'){
            for ($i = 401; $i <= 406; $i++){
                if(!empty($_POST[$i])){
                    foreach($_POST[$i] as $selected){
                        echo '<tr><td>'. $i .'</td><td>'. $selected .'</td><td>'. $date .'</td></tr>';
                        $sql = "INSERT INTO timeslot (user, date, time, roomnumber) VALUES ('$user', '$date', '$selected', '$i')";
                        mysqli_query($connection, $sql);
                    }
                }
            }
        }
        if ($whichtable == 'tb2'){
            for ($i = 501; $i <= 506; $i++){
                if(!empty($_POST[$i])){
                    foreach($_POST[$i] as $selected){
                        echo '<tr><td>'. $i .'</td><td>'. $selected .'</td><td>'. $date .'</td></tr>';
                        $sql = "INSERT INTO timeslot (user, date, time, roomnumber) VALUES ('$user', '$date', '$selected', '$i')";
                        mysqli_query($connection, $sql);
                    }
                }
            }
        }
        echo '</table>';
    }
?>
</body>
</html>