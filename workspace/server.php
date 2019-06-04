<?php 
session_start();

// connect to database
       $db = mysqli_connect('localhost', 'root', '', 'library_space');

// variable declaration
       $username = "";
       $email    = "";
       $errors   = array(); 

// call the register() function if register_btn is clicked
       if (isset($_POST['register'])) {
        	register();
        }

// REGISTER USER
   function register()
 {
	// call these variables with the global keyword to make them available in function
    	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $first_name = mysqli_real_escape_string($db,$_POST['first_name']);
        $last_name = mysqli_real_escape_string($db,$_POST['last_name']);
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db,$_POST['password_2']);
    
	// form validation: ensure that the form is correctly filled
	    if (empty($username)) 
	    { 
	    	array_push($errors, "Username is required"); 
    	}
    	if (empty($first_name)) 
    	{ 
		    array_push($errors, "First Name is required"); 
    	}
    	if (empty($last_name)) 
    	{ 
	    	array_push($errors, "Last Name is required"); 
    	}
    	if (empty($email)) 
    	{ 
	    	array_push($errors, "Email is required"); 
     	}
    	if (empty($password_1)) 
    	{ 
	    	array_push($errors, "Password is required"); 
    	}
    	if ($password_1 != $password_2) 
    	{
	    	array_push($errors, "The two passwords do not match");
    	}
	
	//Access to ualr email only
    	$allowed_hostnames = array("@ualr.edu");
        $good_hostname = false;
        foreach ($allowed_hostnames as $hn)
        {
            if (strstr($_POST['email'], $hn))
          {
               $good_hostname = true;
          }else{
                if ($good_hostname==false)
                {
                    $good_hostname = false; // Set it to false anyway
                }
             }
        }
             if (($good_hostname==true)==false)
             {
                $errors[] = "Only UA Little Rock students are allowed!!!";
             }
    


	// register user if there are no errors in the form
        	if (count($errors) == 0) 
        	{
	        	$password = md5($password_1);//encrypt the password before saving in the database

	         	if (isset($_POST['user_type'])) {
	     	    	$user_type = mysqli_real_escape_string($db,$_POST['user_type']);
		    	    $query = "INSERT INTO user_registration (username, first_name,last_name,email,password,user_type) 
		     		    	  VALUES('$username', '$first_name','$last_name','$email', '$password','$user_type')";
		    	    mysqli_query($db, $query);
		    	    $_SESSION['success']  = "New user successfully created!!";
		    	    header('location: admin_home.php');
	    	   }else{
			    	$query = "INSERT INTO user_registration (username, first_name,last_name,email,password,user_type) 
				        	  VALUES('$username', '$first_name','$last_name','$email', '$password','user')";
			        mysqli_query($db, $query);

			    //get id of the created user
		        	$logged_in_user_id = mysqli_insert_id($db);
		        	$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			        $_SESSION['success']  = "You are now logged in";
			        header('location: index.php');				
		       }
	        }
  }

// return user array from their id
   function getUserById($id)
   {
    	global $db;
	    $query = "SELECT * FROM user_registration WHERE id=" . $id;
	    $result = mysqli_query($db, $query);
	    $user = mysqli_fetch_assoc($result);
	    return $user;
   }

// escape string
    function e($val)
  {
	global $db;
	return mysqli_real_escape_string($db, trim($val));
  } 

    function display_error() 
    {
	   global $errors;
	   if (count($errors) > 0)
	   {
	    	echo '<div class="error">';
			foreach ($errors as $error)
			{
				echo $error .'<br>';
			}
		echo '</div>';
       }
    }	

   function isLoggedIn()
   {
    	if (isset($_SESSION['user'])) 
    	{
    		return true;
	    }else{
	    	return false;
    	}
    }

    if (isset($_GET['logout'])) 
    {
    	session_destroy();
	    unset($_SESSION['user']);
	    header("location: login.php");
    }

// call the login() function if register_btn is clicked
    if (isset($_POST['login'])) 
    {
    	login();
    }

// LOGIN USER
    function login()
  {
	     global $db, $username, $errors;

	// grap form values
	    $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

	// make sure form is filled properly
    	if (empty($username)) 
    	{
	    	array_push($errors, "Username is required");
     	}
    	if (empty($password)) 
    	{
	    	array_push($errors, "Password is required");
    	}

	// attempt login if no errors on form
     	if (count($errors) == 0) 
     	{
		    $password = md5($password);
	    	$query = "SELECT * FROM user_registration WHERE username='$username' AND password='$password' LIMIT 1";
	     	$results = mysqli_query($db, $query);

	     	if (mysqli_num_rows($results) == 1) 
	    	{ // user found
			     // check if user is admin or user
		        	$logged_in_user = mysqli_fetch_assoc($results);
		        	if ($logged_in_user['user_type'] == 'admin') 
		        	{
				      $_SESSION['user'] = $logged_in_user;
				      $_SESSION['success']  = "You are now logged in";
				        header('location: admin/admin_home.php');		  
			        }else{
				       $_SESSION['user'] = $logged_in_user;
				       $_SESSION['success']  = "You are now logged in";
				         header('location: index.php');
			         }
		    }else{
			      array_push($errors, "Wrong username/password combination");
		      }
	    }
   }

//Admin Restriction
    function isAdmin()
  {
    	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) 
    	{
	    	return true;
	    }else{
		    return false;
	    }
   }


// call the register() function if register_btn is clicked
     if (isset($_POST['register_btn'])) 
     {
	     reg();
     }

// REGISTER USER
    function reg()
{
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;
	      // receive all input values from the form. Call the e() function
         // defined below to escape form values
	           $first    =  mysqli_real_escape_string($db,$_POST['first']);
	           $last    =  mysqli_real_escape_string($db,$_POST['last']);
	           $Email  =  mysqli_real_escape_string($db,$_POST['Email']);
	           $Major  =  mysqli_real_escape_string($db,$_POST['Major']);
	           $Birth  =  mysqli_real_escape_string($db,$_POST['Birth']);
	           $Phone =  mysqli_real_escape_string($db,$_POST['Phone']);

		 // Finally, register user if there are no errors in the form
              if (count($errors) == 0) 
             {
     	        $query = "INSERT INTO admin_table (first, last, Email, Major, Birth, Phone) 
  	    		  VALUES('$first', '$last','$last_name','$Email', '$Major','$Birth','$Phone')";
            	mysqli_query($db, $query);
  	            $_SESSION['username'] = $username;
  	            $_SESSION['success'] = "You are now logged in";
  	               header('location: admin_home.php');
             }
             
             //Access to ualr email only
            	$allowed_hostnames = array("ualr.edu");
                $good_hostname = false;
                 foreach ($allowed_hostnames as $hn)
                 {
                      if (strstr($_POST['email'], $hn))
                      {
                       $good_hostname = true;
                       }else{
                       if ($good_hostname==false)
                       {
                          $good_hostname = false; // Set it to false anyway
                       }
                     }  
                 }
                if (($good_hostname==true)==false)
                  {
                     $errors[] = "Only UA Little Rock students are allowed!!!";
                  }
	
}
?>
