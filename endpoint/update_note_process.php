<?php
include('../conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteID = $_POST['note_id'];
    $newTitle = $_POST['note_title'];
    $newContent = $_POST['note_content'];


    $stmt = $conn->prepare("UPDATE `tbl_notes` SET note_title = :title, note = :content WHERE tbl_notes_id = :note_id");
    $stmt->bindParam(':title', $newTitle);
    $stmt->bindParam(':content', $newContent);
    $stmt->bindParam(':note_id', $noteID);

    if ($stmt->execute()) {

        header("Location: http://localhost/schedule/notet.php");
        exit();
    } else {

        header("Location: update_note.php?edit=$noteID&error=1");
        exit();
    }
} else {

    header("Location: http://localhost/schedule/notet.php");
    exit();
}
?>
