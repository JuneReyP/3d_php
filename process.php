<?php
include 'conn.php';
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // INSERT INTO table_name (column1, column2, column3, ...)VALUES (value1, value2, value3, ...);
    $createPOST = $conn->prepare("INSERT INTO postings(title, content) VALUES(?, ?)");
    $createPOST->execute([$title, $content]);
    
    $msg = "Data Inserted!";
    header("Location: index.php?msg=$msg");
}

// update postings
if(isset($_POST['update'])){
    $id = $_POST['posting_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // UPDATE table_name SET column1 = value1, column2 = value2, ... WHERE condition;
    $update = $conn->prepare("UPDATE postings SET title = ?, content = ? WHERE postingID = ?");
    $update->execute([$title, $content, $id]);

    $msg = "Data Updated!";
    header("Location: index.php?msg=$msg");
}

if(isset($_GET['delete'])){
    $id = $_GET['id'];

    // DELETE FROM table_name WHERE condition;
    $delete = $conn->prepare("DELETE FROM postings WHERE postingID = ?");
    $delete->execute([$id]);

    $msg = "Data Deleted!";
    header("Location: index.php?msg=$msg");
}
