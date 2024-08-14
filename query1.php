<?php 
        $error=0;
        include 'connection.php';
        if(isset($_POST['submit']))
            {
            $name = $_POST['name'];
            $dob  = $_POST['dob'];
            $email= $_POST['email'];
            $phone= $_POST['phone'];
            $country= $_POST['country'];
            $state= $_POST['state'];
            $city= $_POST['city'];

            if(empty($name))
            {
                $name_error = "*Name is required.";
                $error=1;
            }
            else if(!preg_match("/^[a-zA-Z ]*$/",$name)){
                $name_error = "*Only letters are allowed.";
                $error=1;
            }
            if(empty($dob))
            {
                $dob_error = "*Date of Birth is required.";
                $error=1;
            }
            if(empty($email))
            {
                $email_error = "*Email is required.";
                $error=1;
            }
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $email_error = "*Invalid Email Address.";
                $error=1;
            }
            if(empty($phone))
            {
                $phone_error = "*phone no is required.";
                $error=1;
            }
            if($error==0)
            {
            $q="insert into tbl_student values('$name','$dob','$email','$phone','$country','$state','$city')";
            if($insert_query= mysqli_query($con,$q))
            {
                $msg = "Registration successfully";
            }
            else
            {
                $msg = "*Registration failed";
            }
        }
        else{
            $msg = "*Please fill all fields.";
        }
    }
    ?>