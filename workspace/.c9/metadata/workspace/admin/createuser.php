{"filter":false,"title":"createuser.php","tooltip":"/admin/createuser.php","undoManager":{"mark":0,"position":0,"stack":[[{"start":{"row":0,"column":0},"end":{"row":120,"column":7},"action":"remove","lines":["<?php  include('../server.php'); ","","","  ","?>","","<!DOCTYPE html>","<html>","<head>","\t<title>Registration system PHP and MySQL - Create user</title>","\t<link rel=\"stylesheet\" type=\"text/css\" href=\"css_form/styles.css\">","\t<style>","\t","         .top-header{","            padding: 20px;","            text-align: center;","            background-color: #541823;","            color: white;","            margin: auto;","        }","        ","      .top-header img {","             float: left;","             width: 100px;","             height: 100px;","             border: 4px solid #ddd;","             border-radius: 4px;","             }","        ","        ","   ","\t\t.header {","\t\t\ttext-align: center;","\t\t}","\t\t","\t\t.table{","\t\tfont-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;","         border-collapse: collapse;","         width: 100%;","\t\t}","\t\t","\t\t.table td, .table th {","         border: 1px solid #ddd;","         padding: 8px;","        }","        ","        .table tr:nth-child(even){background-color: #f2f2f2;}","        ","        .table tr:hover {background-color: #ddd;}","        ","        .table th{","        \tpadding-top: 12px;","            padding-bottom: 12px;","            text-align: left;","            background-color: #541823;","            color: white;","        }","\t\t","</style>","\t","\t","</head>","<body>","\t<div class=\"top-header\">","          <a href=\"https://library-space-kxshukla.c9users.io/homepage/index.html\"><img src = \"../images/logo.png\" alt=\"logo\"></a>","          <h1>Ottenhiemer Library</h1>","        </div>","        ","       ","\t","\t<div class=\"header\">","\t\t<h2>Admin - create user</h2>","\t</div>","\t","\t<?php","\t$sql = 'select * from admin_table';","\t$query = mysqli_query($db, $sql);","\t","\tif (!$query)","\t{","\t\tdie('error found' . mysqli_error($conn));","\t}","\t","\t","\techo \"","\t<table class='table'>","\t<tr>","\t<th>FirstName</th>","\t<th>LastName</th>","\t<th>Email</th>","\t<th>Major</th>","\t<th>BirthDate</th>","\t<th>Telephone</th>","\t<th>Address</th>","\t<th>City</th>","\t<th>State</th>","\t<th>Zip</th>","\t</tr>\";","\t","\twhile ($row = mysqli_fetch_array($query))","\t{","\t\techo '<tr>","\t\t<td>'.$row['FirstName'].'</td>","\t\t<td>'.$row['LastName'].'</td>","\t\t<td>'.$row['Email'].'</td>","\t\t<td>'.$row['Major'].'</td>","\t\t<td>'.$row['BirthDate'].'</td>","\t\t<td>'.$row['Telephone'].'</td>","\t\t<td>'.$row['Address'].'</td>\t","\t\t<td>'.$row['City'].'</td>\t","\t\t<td>'.$row['State'].'</td>\t","     \t<td>'.$row['Zip'].'</td>","     \t</tr>';","\t}","\t","\techo \"</table>\";","\t?>","","","</body>","</html>"],"id":2},{"start":{"row":0,"column":0},"end":{"row":89,"column":0},"action":"insert","lines":["<?php include('../server.php') ?>","","<!DOCTYPE html>","<html>","<head>","\t<title>Admin Registration</title>","\t<link rel=\"stylesheet\" type=\"text/css\" href=\"../styles.css\">","\t<style>","\t\t.header {","\t\t\tbackground: #003366;","\t\t\tcolor: white;","\t\t\ttext-align: center;","\t\t}","\t\tbutton[name=register] {","\t\t\tbackground: #003366;","\t\t\tcolor: white;","\t\t}","\t","        .top-header{","            padding: 20px;","            text-align: center;","            background-color: #541823;","            color: white;","            margin: auto;","        }","        ","      .top-header img {","             float: left;","             width: 100px;","             height: 100px;","             border: 4px solid #ddd;","             border-radius: 4px;","             }","            ","   ","\t</style>","</head>","<body>","\t <div class=\"top-header\">","          <a href=\"https://capstone-kxshukla.c9users.io/workspace/homepage/index.html\"><img src = \"../images/logo.png\" alt=\"logo\"></a>","          <h1>Ottenhiemer Library</h1>","     </div>","     ","\t<div class=\"header\">","\t\t<h2>Admin - create user</h2>","\t</div>","\t","\t<form method=\"post\" action=\"createuser.php\">","","\t\t<?php echo display_error(); ?>","","\t\t<div class=\"input-group\">","\t\t\t<label>Username</label>","\t\t\t<input type=\"text\" name=\"username\" value=\"<?php echo $username; ?>\">","\t\t</div>","\t\t<div class=\"input-group\">","            <label>First Name</label>","            <input type=\"text\" name=\"first_name\" value=\"<?php echo $first_name; ?>\">","        </div>","     <div class=\"input-group\">","            <label>Last Name</label>","            <input type=\"text\" name=\"last_name\" value=\"<?php echo $last_name; ?>\">","        </div>","\t\t<div class=\"input-group\">","\t\t\t<label>Email</label>","\t\t\t<input type=\"email\" name=\"email\" value=\"<?php echo $email; ?>\">","\t\t</div>","\t\t<div class=\"input-group\">","\t\t\t<label>User type</label>","\t\t\t<select name=\"user_type\" id=\"user_type\" >","\t\t\t\t<option value=\"\"></option>","\t\t\t\t<option value=\"admin\">Admin</option>","\t\t\t\t<option value=\"user\">User</option>","\t\t\t</select>","\t\t</div>","\t\t<div class=\"input-group\">","\t\t\t<label>Password</label>","\t\t\t<input type=\"password\" name=\"password_1\">","\t\t</div>","\t\t<div class=\"input-group\">","\t\t\t<label>Confirm password</label>","\t\t\t<input type=\"password\" name=\"password_2\">","\t\t</div>","\t\t<div class=\"input-group\">","\t\t\t<button type=\"submit\" class=\"btn\" name=\"register\"> + Create Admin</button>","\t\t</div>","\t</form>","</body>","</html>",""]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":10,"column":16},"end":{"row":10,"column":16},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1557184372725,"hash":"f09238ee4c69e9a1d883a60158564e447e7d435a"}