<?php
include('../conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete'])) {
    $noteID = $_GET['delete'];


    $stmt = $conn->prepare("DELETE FROM `tbl_notes` WHERE tbl_notes_id = :note_id");
    $stmt->bindParam(':note_id', $noteID);

    if ($stmt->execute()) {

        header("Location: http://localhost/schedule/notet.php");
        exit();
    } else {

        header("Location: http://localhost/schedule/notet.php");
        exit();
    }
} else {

    header("Location: http://localhost/schedule/notet.php");
    exit();
}
?>
