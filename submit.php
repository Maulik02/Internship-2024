<?php
$con = mysqli_connect("localhost","root","","forms");
if(!$con){
    my_log_error('mysql connection', 'failed to connect to mysql.');
}
if(isset($_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpass = $_POST['cpass'];
    $dob = $_POST['dob'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $q = "INSERT INTO sign values('$email','$password','$cpass','$dob','$country','$state','$city','$address')";
    if(!$qu=mysqli_query($con,$q)){
        my_log_error('mysql query', 'failed to insert into mysql.');
    }
}

?>
<?php

/**
 * log error entries
 * 
 * @param string $category 
 * @param string $message
 * @return void
 */
function my_log_error($category, $message)
{
    $back_trace = debug_backtrace();

    // unset($back_trace[0]['args']);

    $fp = fopen('logs/' . date('d-m-Y') . '.txt', 'a');

    fwrite($fp, date('h:i:s') . "\n");
    fwrite($fp, "\t" . $category . "\t" . $message  . "\n");
    fwrite($fp, "\t" . json_encode($back_trace) . "\n");
    fwrite($fp, "-----------------------------------------------\n\n");
    
    fclose($fp);
}