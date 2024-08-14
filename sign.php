<?php

$con=mysqli_connect("localhost","root","","forms");

$que = 'select * from countries';
$res = $con->query($que);

?>

<html>

<head>
    <title>Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="sign.css">
</head>
<style src="sign.css"></style>

<body id="body">
    <div id="form">
    <form action="submit.php" method="post" action="myaction.php" name="myform" onsubmit="return validateForm()">

        <label id="text">Email:</label>
        <input type="email" name="email" required>
        <span id="val"></span>
        <br><br>
        

        <label id="text">Password:</label> 
        <input type="password" name="password" required><br><br>

        <label id="text">Confing Password:</label> 
        <input type="password" name="cpass" required><br><br>

        <label id="text">D.O.B:</label> 
        <input type="date" name="dob" required><br><br>

        <label id="text">Country:</label>
        <select name="country" id="country" required>
            <option value="-1">--Select Country--</option>
            <?php while ($row = $res->fetch_assoc()) { ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
            <?php } ?>
        </select>

        <br><br>

        <label id="text">State: </label>
        <select name="state" id="state" required>
            <option value="-1">--Select State--</option>
        </select>

        <br><br>

        <label id="text">City: </label>
        <select name="city" id="city" required>
            <option value="-1">--Select City--</option>
        </select>
        <br><br>
        <label id ="text">Address:</label> 
        <textarea name="address" required></textarea><br><br>
        <center><input type="submit" name="submit" id="but"></center><br>
    </form>
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