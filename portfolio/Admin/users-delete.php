<?php
require '../config/funtion.php';

$paramResult = checkParamId('id');
if(is_numeric($paramResult)){
    $userId = validate($paramResult);
    $user = getById('users',$userId);
    if($user['status'] == 200){
        $userDeleteRes = deleteById('users', $userId);
        if($userDeleteRes){
            redirect('users.php','User Deleted successfully');
        }
        else{
            redirect('users.php','Something went wrong');
        }
    }
    else{
        redirect('users.php',$user['message']);
    }
}
else{
    redirect('users.php',$paramResult);
}
?>