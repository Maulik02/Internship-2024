<?php
require_once "../config/funtion.php";

if (isset($_POST["saveUser"])) {
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $role = validate($_POST['role']);
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;

    if ($name != '' && $email != '' && $phone != '' && $password != '' && $role != '') {
        $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password, is_ban, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssis", $name, $phone, $email, $password, $is_ban, $role);

        if ($stmt->execute()) {
            redirect('users.php', 'User/Admin Added Successfully...');
        } else {
            redirect('users-create.php', 'Something went wrong');
        }

        $stmt->close();
    } else {
        redirect('users-create.php', 'Please fill all the input fields...');
    }
}

if (isset($_POST['updateUser'])) {
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $role = validate($_POST['role']);
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;
    $userId = validate($_POST['userId']);

    $user = getById('users', $userId);
    if ($user['status'] != 200) {
        redirect('users-edit.php?id=' . $userId, 'No Such id found');
    }

    if ($name != '' && $email != '' && $phone != '' && $role != '') {
        if ($password != '') {
            $query = "UPDATE users SET name='$name', phone='$phone', email='$email', password='$password', is_ban='$is_ban', role='$role' WHERE id='$userId'";
        } else {
            $query = "UPDATE users SET name='$name', phone='$phone', email='$email', is_ban='$is_ban', role='$role' WHERE id='$userId'";
        }
        $result = mysqli_query($conn, $query);

        if ($result) {
            redirect('users.php', 'User/Admin Updated Successfully...');
        } else {
            redirect('users-edit.php?id=' . $userId, 'Something went wrong');
        }
    } else {
        redirect('users-edit.php?id=' . $userId, 'Please fill all the input fields...');
    }
}


session_start();
require_once '../config/funtion.php';
require_once '../config/dbcon.php';

if (isset($_POST['saveSetting'])) {
    $title = validate($_POST['title']);
    $slug = validate($_POST['slug']);
    $small_description = validate($_POST['small_description']);
    $meta_description = validate($_POST['meta_description']);
    $meta_keyword = validate($_POST['meta_keyword']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $address = validate($_POST['address']);
    $settingId = validate($_POST['settingId']);

    if ($settingId == 'insert') {
        $query = "INSERT INTO settings (title, slug, small_description, meta_description, meta_keyword, email, phone, address) VALUES ('$title', '$slug', '$small_description', '$meta_description', '$meta_keyword', '$email', '$phone', '$address')";
    } else {
        $query = "UPDATE settings SET title='$title', slug='$slug', small_description='$small_description', meta_description='$meta_description', meta_keyword='$meta_keyword', email='$email', phone='$phone', address='$address' WHERE id='$settingId'";
    }

    $result = mysqli_query($conn, $query);

    if ($result) {
        redirect('settings.php', 'Settings Saved...');
    } else {
        redirect('settings.php', 'Something went wrong...');
    }
}


if (isset($_POST['saveSocialMedia'])) {
    $name = validate($_POST['name']);
    $url = validate($_POST['url']);
    $status = isset($_POST['status']) ? 1 : 0;

    $query = "INSERT INTO social_medias (name, url, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $name, $url, $status);

    if ($stmt->execute()) {
        redirect('social-media.php', 'Social Media Added Successfully');
    } else {
        redirect('social-media-create.php', 'Something went wrong');
    }
}

if (isset($_POST['updateSocialMedia'])) {
    $id = validate($_POST['socialMediaId']);
    $name = validate($_POST['name']);
    $url = validate($_POST['url']);
    $status = isset($_POST['status']) ? 1 : 0;

    $query = "UPDATE social_medias SET name=?, url=?, status=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssii', $name, $url, $status, $id);

    if ($stmt->execute()) {
        redirect('social-media.php', 'Social Media Updated Successfully');
    } else {
        redirect('social-media-edit.php?id='.$id, 'Something went wrong');
    }
}

if (isset($_POST['saveService'])) {
    $name = validate($_POST['name']);
    $slug = str_replace(' ', '-', strtolower($name));
    $small_description = validate($_POST['small_description']);
    $long_description = validate($_POST['long_description']);
    $meta_title = validate($_POST['meta_title']);
    $meta_description = validate($_POST['meta_description']);
    $meta_keyword = validate($_POST['meta_keyword']);
    $status = isset($_POST['status']) ? 1 : 0;

    $image_path = null;
    if ($_FILES['image']['size'] > 0) {
        $upload_result = uploadImage($_FILES['image']);
        if (isset($upload_result['error'])) {
            redirect('services-create.php', $upload_result['error']);
        }
        $image_path = $upload_result['path'];
    }

    $query = "INSERT INTO services (name, slug, small_description, long_description, image, meta_title, meta_description, meta_keyword, status) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssssssi', $name, $slug, $small_description, $long_description, $image_path, $meta_title, $meta_description, $meta_keyword, $status);

    if ($stmt->execute()) {
        redirect('services.php', 'Service Added Successfully');
    } else {
        redirect('services-create.php', 'Something went wrong');
    }
}

if (isset($_POST['updateService'])) {
    $id = validate($_POST['serviceId']);
    $name = validate($_POST['name']);
    $slug = str_replace(' ', '-', strtolower($name));
    $small_description = validate($_POST['small_description']);
    $long_description = validate($_POST['long_description']);
    $meta_title = validate($_POST['meta_title']);
    $meta_description = validate($_POST['meta_description']);
    $meta_keyword = validate($_POST['meta_keyword']);
    $status = isset($_POST['status']) ? 1 : 0;

    $image_path = null;
    if ($_FILES['image']['size'] > 0) {
        $upload_result = uploadImage($_FILES['image']);
        if (isset($upload_result['error'])) {
            redirect('services-edit.php?id=' . $id, $upload_result['error']);
        }
        $image_path = $upload_result['path'];
    }

    if ($image_path) {
        $query = "UPDATE services SET name=?, slug=?, small_description=?, long_description=?, image=?, meta_title=?, meta_description=?, meta_keyword=?, status=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssssssii', $name, $slug, $small_description, $long_description, $image_path, $meta_title, $meta_description, $meta_keyword, $status, $id);
    } else {
        $query = "UPDATE services SET name=?, slug=?, small_description=?, long_description=?, meta_title=?, meta_description=?, meta_keyword=?, status=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssssii', $name, $slug, $small_description, $long_description, $meta_title, $meta_description, $meta_keyword, $status, $id);
    }

    if ($stmt->execute()) {
        redirect('services.php', 'Service Updated Successfully');
    } else {
        redirect('services-edit.php?id=' . $id, 'Something went wrong');
    }
}

if (isset($_POST['saveSocialMedia'])) {
    $name = validate($_POST['name']);
    $url = validate($_POST['url']);
    $status = isset($_POST['status']) ? 1 : 0;

    $query = "INSERT INTO social_medias (name, url, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $name, $url, $status);

    if ($stmt->execute()) {
        redirect('social-media.php', 'Social Media Added Successfully');
    } else {
        redirect('social-media-create.php', 'Something went wrong');
    }
}
?>
