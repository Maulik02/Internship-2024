<?php
require_once 'dbcon.php';

// Check if a session is not already started before calling session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('validate')) {
    function validate($inputData){
        global $conn;
        $validatedData = mysqli_real_escape_string($conn, trim($inputData));
        return $validatedData;
    }
}

if (!function_exists('redirect')) {
    function redirect($url, $status){
        $_SESSION['status'] = $status;
        header('Location: ' . $url);
        exit(0);
    }
}

if (!function_exists('alertMessage')) {
    function alertMessage(){
        if (isset($_SESSION['status'])) {
            echo '<div class="alert alert-success">
                <h6>' . htmlspecialchars($_SESSION['status']) . '</h6>
            </div>';
            unset($_SESSION['status']);
        }
    }
}

if (!function_exists('getAll')) {
    function getAll($tableName){
        global $conn;
        $table = validate($tableName);
        $query = "SELECT * FROM $table";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die("Query Failed: " . $stmt->error);
        }
        return $result;
    }
}

if (!function_exists('checkParamId')) {
    function checkParamId($paramType){
        return isset($_GET[$paramType]) && !empty($_GET[$paramType]) ? $_GET[$paramType] : 'No id given';
    }
}

if (!function_exists('getById')) {
    function getById($tableName, $id){
        global $conn;
        $table = validate($tableName);
        $id = validate($id);
        $query = "SELECT * FROM $table WHERE id=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            return [
                'status' => 500,
                'message' => 'Something went wrong: ' . $stmt->error
            ];
        }

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return [
                'status' => 200,
                'message' => 'Fetched Data',
                'data' => $row
            ];
        } else {
            return [
                'status' => 404,
                'message' => 'No Data Record'
            ];
        }
    }
}

if (!function_exists('deleteById')) {
    function deleteById($tableName, $id){
        global $conn;
        $table = validate($tableName);
        $id = validate($id);
        $query = "DELETE FROM $table WHERE id=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();

        if ($result) {
            return [
                'status' => 200,
                'message' => 'Record Deleted Successfully'
            ];
        } else {
            return [
                'status' => 500,
                'message' => 'Something went wrong: ' . $stmt->error
            ];
        }
    }
}

if (!function_exists('logoutSession')) {
    function logoutSession(){
        session_unset();
        session_destroy();
    }
}

if (!function_exists('webSetting')) {
    function webSetting($columnName){
        $setting = getById('settings', 1);
        if ($setting['status'] == 200) {
            return $setting['data'][$columnName];
        }
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($file) {
        $allowed_types = ['jpg', 'jpeg', 'png'];
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($file_ext, $allowed_types)) {
            return ['error' => 'Only JPG, JPEG, and PNG files are allowed'];
        }
        $filename = time() . '.' . $file_ext;
        $path = '../assets/uploads/services/' . $filename;
        if (move_uploaded_file($file['tmp_name'], $path)) {
            return ['path' => 'assets/uploads/services/' . $filename];
        }
        return ['error' => 'File upload failed'];
    }
}
?>
