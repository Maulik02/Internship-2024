<?php
ini_set('display_errors', 1);
$con=mysqli_connect("localhost","root","","forms");

$que = 'select * from countries';
$res = $con->query($que);

?>
<html>
<head>
    <title>Server Side Validation</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    var _hmt = _hmt || [];
    (function() {
    var hm = document.createElement("script");
    hm.src = "//hm.baidu.com/hm.js?73c27e26f610eb3c9f3feb0c75b03925";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
    })();
    </script>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        background-image: url('9.jpg');
        padding: 8px;
        background-size: cover;
    }
    .box {
        width: 100%;
        max-width: 600px;
        background-color: #f9f9f9;
        border: 2px solid #efa31d;
        border-radius: 5px;
        padding: 16px;
        margin-left:420px;
        box-shadow: 0px 0px 29px 40px rgba(0, 0, 6, 0.2);
    }
    .error {
        color:red;
    }
    
    .btn {
        background-color: #64a4e0;
        border: none;
        border-radius:9px;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        margin-left:225px;
        -webkit-transition-duration: 0.4s;
        transition-duration: 0.4s;
    }
    .btn:hover{
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
    }
    input[type=text], select, textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid   blue;
        border-radius: 4px;
        resize: vertical;
    }
    input[type=date] {
        width: 100%;
        padding: 12px;
        border: 1px solid blue;
        border-radius: 4px;
        resize: vertical;
    }
    input[type=email] {
        width: 100%;
        padding: 12px;
        border: 1px solid blue;
        border-radius: 4px;
    }
    .text-danger {
        color:red;
    }

    </style>
    <?php 
        $error=0;
        include 'connection.php';
        if(isset($_POST['submit']))
            {
            $name = $_POST['name'];
            $dob  = $_POST['dob'];
            $email= $_POST['email'];
            $country= $_POST['country'];
            $state= $_POST['state'];
            $city= $_POST['city'];
            $address= $_POST['address'];

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
            if(empty($address))
            {
                $address_error = "*address is required.";
                $error=1;
            }
            if($error==0)
            {
            $q="insert into tbl_student values('id','$name','$dob','$email','$country','$state','$city','$address')";
            if($insert_query= mysqli_query($con,$q))
            {
                $msg = "Registration successfully";
                header("location:success.php");
                exit();
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
<body >
    <div class="container">
        <div class="table-responsive">
            <div class="box">
                <form id="validate_form" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name...">
                        <br><span class="text-danger"><?php if(!empty($name_error)){ echo $name_error; } ?></span>
                    </div><br>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control">
                        <br><span class="text-danger"><?php if(!empty($dob_error)){ echo $dob_error; } ?></span>
                    </div><br>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email...">
                        <br><span class="text-danger"><?php if(!empty($email_error)){ echo $email_error; } ?></span>
                    </div><br>
                    <div class="form-group">
                        <label>Country</label>
                        <select name="country" id="country" class="form-control">
                            <option value="-1">--Select Country--</option>
                            <?php while ($row = $res->fetch_assoc()) { ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div> <br>
                    <div class="form-group">
                        <label>State</label>
                        <select name="state" id="state" class="form-control">
                            <option value="-1">--Select State--</option>
                        </select>
                    </div> <br>
                    <div class="form-group">
                        <label>City</label>
                        <select name="city" id="city" class="form-control">
                            <option value="-1">--Select City--</option>
                        </select>
                    </div>    <br> 
                    
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address...">
                        <br><span class="text-danger"><?php if(!empty($address_error)){ echo $address_error; } ?></span>
                    </div><br>                                                                                          

                    <div class="fbut">
                        <input  type="submit" name="submit" value="Submit" class="btn">
                    </div>
                </form>
                <div class="error"><?php if(!empty($msg)){echo $msg;}?></div>
            </div>
            <br><br>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $('#country').change(function() {
                var id = $(this).val();
                
                $.ajax({
                    url: "data.php",
                    type: "POST",
                    data: {
                        id: id,
                        type: "state"
                    },
                    success: function(response) {
                        
                        $('#state').html(response);
                        debugger;
                    }
                });
            });


            $('#state').change(function() {

                var id = $(this).val();

                $.ajax({
                    url: "data.php",
                    type: "POST",
                    data: {
                        id: id,
                        type: "city"
                    },
                    success: function(response) {
                        $('#city').html(response);
                    }
                });
            });
        });
    </script>
</body>
<script>
    function seterror(id,error){
        element = document.getElementById(id);
        element.getElementSById('email')[0].innerHTML = error;
    }
    function validateForm(){
        var returnval =  true;
        var name = document.forms['myform']['email'].value;
        if(email.lenght() < 35){
            seterror("Please enter a valid email address");
        returnval = false;
        }
        return returnval;
    }
</script>
</html>