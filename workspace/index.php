<?php  include('server.php'); 
        // if the user is not logged in, they cannot access this page
       	if (!isLoggedIn()) {
         	$_SESSION['msg'] = "You must log in first";
         	header('location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="roomtable/roomtimetable.css">
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
            return false;
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
           font-size: 20px;
        }
        
        
    </style>
</head>
<body>
<!------------- HEADER PAGE ------------------>
   <div class="top-header">
          <a href="https://library-space-kxshukla.c9users.io/homepage/index.html"><img src = "../images/logo.png" alt="logo"></a>
          <h1>Ottenhiemer Library</h1>
        </div>
  <div class="flex-center position-ref full-height">

<!--<div id="navbar">
      <button><a href="https://ualr.edu">Home</a></button>
      <button><a href="https://library-space-kxshukla.c9users.io/roomtable/reservedlist.php">My Reservations</a></button>
      <button><a href="index.php?logout='1'" style="color: red;">Logout</a></button>
</div>-->

    <div class="format">
       <button><a href="https://library-space-kxshukla.c9users.io/homepage/index.html">Home</a></button>
        <button><a href="https://library-space-kxshukla.c9users.io/roomtable/reservedlist.php">My Reservations</a></button>
        <button><a href="index.php?logout='1'" style="color: red;">Logout</a></button>
    </div>

    
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
			<p>Welcome		<strong><?php echo $_SESSION['user']['username']; ?>&#44;</strong> 
					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
					</small></p>  
				<?php endif ?>
			</div>
		</div>
	</div>
	
	
	<!---------------------------DESCRIPTION ------------------------------>
	 <p>The Library has 12 rooms which are available from 7 a.m to 4 p.m. Click on the schedule below to book a study room. Rooms may be checked out by any current UA Little Rock students.</p>
    <p>Rules:</p>
    <ul>
       <li>Reservations will be canceled if you are 15 minutes late or more</li>
       <li>Person who made reservation must present picture ID to check room out</li>
       <li>Card must be handed to the Receptionist</li>
     </ul> 
      <br>
      <br>
    
   <!--------------------------TIMESLOT --------------------------------->
<form name="tableForm" id="tableForm" action="roomtable/roomtimetable.php" method="POST">
  <div class="center">
    <p>Date: <input type="text" name="datepicker" id="datepicker"/></p>
  </div>

<div class="center">
<select id="table-select" name="table-select">
    <option value="">Select Floor</option>
    <option value="tb1" selected>4th Floor</option>
    <option value="tb2">5th Floor</option>
</select>
</div>
<div id="tbl_div">
    <div id="tb1">
  <table id="mytable" class="display">
  <thead>
  	<tr>
  	<th>Time/Rooms</th>
  	<th>7:00 A.M.</th>
  	<th>8:00 A.M.</th>
  	<th>9:00 A.M.</th>
  	<th>10:00 A.M.</th>
  	<th>11:00 A.M.</th>
  	<th>12:00 P.M.</th>
  	<th>1:00 P.M.</th>
  	<th>2:00 P.M.</th>
  	<th>3:00 P.M.</th>
  	<th>4:00 P.M.</th>
  	</tr>
  </thead>
  <tbody>
    <tr>
      <th><div class="tooltip">401<span class="tooltiptext">Projector: No<br>White Board: No<br>Capacity: 4</span></div></th>
        <td><div class="table"><input type="checkbox" id="401070000" name="401[]" value="7:00"/></div></td> 
        <td><div class="table"><input type="checkbox" id="401080000" name="401[]" value="8:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="401090000" name="401[]" value="9:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="401100000" name="401[]" value="10:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="401110000" name="401[]" value="11:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="401120000" name="401[]" value="12:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="401010000" name="401[]" value="1:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="401020000" name="401[]" value="2:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="401030000" name="401[]" value="3:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="401040000" name="401[]" value="4:00"/></div></td>
    </tr>
     <tr>
      <th><div class="tooltip">402<span class="tooltiptext">Projector: No<br>White Board: No<br>Capacity: 8</span></div></th> 
        <td><div class="table"><input type="checkbox" id="402070000" name="402[]" value="7:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="402080000" name="402[]" value="8:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="402090000" name="402[]" value="9:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="402100000" name="402[]" value="10:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="402110000" name="402[]" value="11:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="402120000" name="402[]" value="12:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="402010000" name="402[]" value="1:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="402020000" name="402[]" value="2:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="402030000" name="402[]" value="3:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="402040000" name="402[]" value="4:00"/></div></td>
    </tr> 
    <tr>
      <th><div class="tooltip">403<span class="tooltiptext">Projector: No<br>White Board: Yes<br>Capacity: 4</span></div></th> 
        <td><div class="table"><input type="checkbox" id="403070000" name="403[]" value="7:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="403080000" name="403[]" value="8:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="403090000" name="403[]" value="9:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="403100000" name="403[]" value="10:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="403110000" name="403[]" value="11:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="403120000" name="403[]" value="12:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="403010000" name="403[]" value="1:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="403020000" name="403[]" value="2:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="403030000" name="403[]" value="3:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="403040000" name="403[]" value="4:00"/></div></td>
    </tr>
    <tr>
      <th><div class="tooltip">404<span class="tooltiptext">Projector: No<br>White Board: Yes<br>Capacity: 8</span></div></th> 
        <td><div class="table"><input type="checkbox" id="404070000" name="404[]" value="7:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="404080000" name="404[]" value="8:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="404090000" name="404[]" value="9:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="404100000" name="404[]" value="10:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="404110000" name="404[]" value="11:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="404120000" name="404[]" value="12:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="404010000" name="404[]" value="1:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="404020000" name="404[]" value="2:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="404030000" name="404[]" value="3:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="404040000" name="404[]" value="4:00"/></div></td>
    </tr> 
    <tr>
      <th><div class="tooltip">405<span class="tooltiptext">Projector: No<br>White Board: Yes<br>Capacity: 6</span></div></th> 
        <td><div class="table"><input type="checkbox" id="405070000" name="405[]" value="7:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="405080000" name="405[]" value="8:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="405090000" name="405[]" value="9:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="405100000" name="405[]" value="10:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="405110000" name="405[]" value="11:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="405120000" name="405[]" value="12:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="405010000" name="405[]" value="1:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="405020000" name="405[]" value="2:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="405030000" name="405[]" value="3:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="405040000" name="405[]" value="4:00"/></div></td>
    </tr> 
    <tr>
      <th><div class="tooltip">406<span class="tooltiptext">Projector: Yes<br>White Board: No<br>Capacity: 6</span></div></th> 
        <td><div class="table"><input type="checkbox" id="406070000" name="406[]" value="7:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="406080000" name="406[]" value="8:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="406090000" name="406[]" value="9:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="406100000" name="406[]" value="10:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="406110000" name="406[]" value="11:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="406120000" name="406[]" value="12:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="406010000" name="406[]" value="1:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="406020000" name="406[]" value="2:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="406030000" name="406[]" value="3:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="406040000" name="406[]" value="4:00"/></div></td>
    </tr>
  </tbody>
  </table>
  </div>
  <div id="tb2">
      <table id="mytable" class="display">
  <thead>
  	<tr>
  	<th>Time/Rooms</th>
  	<th>7:00 A.M.</th>
  	<th>8:00 A.M.</th>
  	<th>9:00 A.M.</th>
  	<th>10:00 A.M.</th>
  	<th>11:00 A.M.</th>
  	<th>12:00 P.M.</th>
  	<th>1:00 P.M.</th>
  	<th>2:00 P.M.</th>
  	<th>3:00 P.M.</th>
  	<th>4:00 P.M.</th>
  	</tr>
  </thead>
  <tbody>
    <tr>
      <th><div class="tooltip">501<span class="tooltiptext">Projector: Yes<br>White Board: Yes<br>Capacity: 10</span></div></th>
        <td><div class="table"><input type="checkbox" id="501070000" name="501[]" value="7:00"/></div></td> 
        <td><div class="table"><input type="checkbox" id="501080000" name="501[]" value="8:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="501090000" name="501[]" value="9:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="501100000" name="501[]" value="10:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="501110000" name="501[]" value="11:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="501120000" name="501[]" value="12:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="501010000" name="501[]" value="1:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="501020000" name="501[]" value="2:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="501030000" name="501[]" value="3:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="501040000" name="501[]" value="4:00"/></div></td>
    </tr>
     <tr>
      <th><div class="tooltip">502<span class="tooltiptext">Projector: Yes<br>White Board: Yes<br>Capacity: 12</span></div></th> 
        <td><div class="table"><input type="checkbox" id="502070000" name="502[]" value="7:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="502080000" name="502[]" value="8:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="502090000" name="502[]" value="9:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="502100000" name="502[]" value="10:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="502110000" name="502[]" value="11:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="502120000" name="502[]" value="12:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="502010000" name="502[]" value="1:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="502020000" name="502[]" value="2:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="502030000" name="502[]" value="3:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="502040000" name="502[]" value="4:00"/></div></td>
    </tr> 
    <tr>
      <th><div class="tooltip">503<span class="tooltiptext">Projector: Yes<br>White Board: Yes<br>Capacity: 12</span></div></th> 
        <td><div class="table"><input type="checkbox" id="503070000" name="503[]" value="7:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="503080000" name="503[]" value="8:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="503090000" name="503[]" value="9:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="503100000" name="503[]" value="10:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="503110000" name="503[]" value="11:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="503120000" name="503[]" value="12:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="503010000" name="503[]" value="1:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="503020000" name="503[]" value="2:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="503030000" name="503[]" value="3:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="503040000" name="503[]" value="4:00"/></div></td>
    </tr>
    <tr>
      <th><div class="tooltip">504<span class="tooltiptext">Projector: Yes<br>White Board: Yes<br>Capacity: 14</span></div></th> 
        <td><div class="table"><input type="checkbox" id="504070000" name="504[]" value="7:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="504080000" name="504[]" value="8:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="504090000" name="504[]" value="9:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="504100000" name="504[]" value="10:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="504110000" name="504[]" value="11:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="504120000" name="504[]" value="12:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="504010000" name="504[]" value="1:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="504020000" name="504[]" value="2:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="504030000" name="504[]" value="3:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="504040000" name="504[]" value="4:00"/></div></td>
    </tr> 
    <tr>
      <th><div class="tooltip">505<span class="tooltiptext">Projector: No<br>White Board: Yes<br>Capacity: 12</span></div></th> 
        <td><div class="table"><input type="checkbox" id="505070000" name="505[]" value="7:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="505080000" name="505[]" value="8:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="505090000" name="505[]" value="9:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="505100000" name="505[]" value="10:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="505110000" name="505[]" value="11:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="505120000" name="505[]" value="12:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="505010000" name="505[]" value="1:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="505020000" name="505[]" value="2:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="505030000" name="505[]" value="3:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="505040000" name="505[]" value="4:00"/></div></td>
    </tr> 
    <tr>
      <th><div class="tooltip">506<span class="tooltiptext">Projector: No<br>White Board: No<br>Capacity: 8</span></div></th> 
        <td><div class="table"><input type="checkbox" id="506070000" name="506[]" value="7:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="506080000" name="506[]" value="8:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="506090000" name="506[]" value="9:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="506100000" name="506[]" value="10:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="506110000" name="506[]" value="11:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="506120000" name="506[]" value="12:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="506010000" name="506[]" value="1:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="506020000" name="506[]" value="2:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="506030000" name="506[]" value="3:00"/></div></td>
        <td><div class="table"><input type="checkbox" id="506040000" name="506[]" value="4:00"/></div></td>
    </tr>
  </tbody>
  </table>
  </div>
  </div>
  <input type="submit" id="submit" name="submit" class="submitbtn" value="Submit"/>
  </form>
</body>
</html>