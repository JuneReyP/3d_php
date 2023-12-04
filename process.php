<?php
include 'conn.php';

// create
if (isset($_POST['create'])) {
    $id = $_POST['userID'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // INSERT INTO table_name (column1, column2, column3, ...)VALUES (value1, value2, value3, ...);
    $createPOST = $conn->prepare("INSERT INTO postings(user_id, title, content) VALUES(?, ?, ?)");
    $createPOST->execute([$id, $title, $content]);

    $msg = "Data Inserted!";
    header("Location: index.php?msg=$msg");
}

// update postings
if (isset($_POST['update'])) {
    $id = $_POST['posting_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // UPDATE table_name SET column1 = value1, column2 = value2, ... WHERE condition;
    $update = $conn->prepare("UPDATE postings SET title = ?, content = ? WHERE postingID = ?");
    $update->execute([$title, $content, $id]);

    $msg = "Data Updated!";
    header("Location: index.php?msg=$msg");
}

if (isset($_GET['delete'])) {
    $id = $_GET['id'];

    // DELETE FROM table_name WHERE condition;
    $delete = $conn->prepare("DELETE FROM postings WHERE postingID = ?");
    $delete->execute([$id]);

    $msg = "Data Deleted!";
    header("Location: index.php?msg=$msg");
}

// add users
if (isset($_POST['registerUser'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass1'];
    $confirmPass = $_POST['pass2'];

    if ($pass == $confirmPass) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        // INSERT INTO table_name (column1, column2, column3, ...)VALUES (value1, value2, value3, ...);
        $addUser = $conn->prepare("INSERT INTO users (user_fname, user_lname, user_email, user_pass) VALUES(?, ?, ?, ?)");
        $addUser->execute([
            $fname,
            $lname,
            $email,
            $hash
        ]);

        $msg = "User registered succesfully!";
        header("Location: register.php?msg=$msg");
    } else {
        $msg = "Password do not match!";
        header("Location: register.php?msg=$msg");
    }
}

// login user
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // get the data on the database using the email input
    $getData = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
    $getData->execute([$email]);

    foreach ($getData as $data) {
        if ($data['user_email'] == $email && password_verify($pass, $data['user_pass'])) {
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $data['user_id'];

            $msg = "User logged-in successfully!";
            header("Location: index.php?msg=$msg");
        } else {
            $msg = "Email or Password do not match";
            header("Location: login.php?msg=$msg");
        }
    }
}

// for logout
if (isset($_GET['logout'])) {
    session_start();
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_id']); 
    
    header("Location: login.php");
}
