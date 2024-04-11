<?php
include("../conn1/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['note_title'], $_POST['note_content'])) {
        $noteID = $_POST['tbl_note_id'];
        $noteTitle = $_POST['note_title'];
        $noteContent = $_POST['note_content'];
        $datePosted = date("Y-m-d H:i:s"); 

        try {
            $stmt = $conn->prepare("UPDATE `tbl_note` SET `note_title` = :note_title, `note_content` = :note_content, `date_posted` = :date_posted WHERE `tbl_note_id` = :tbl_note_id");

            $stmt->bindParam(':tbl_note_id', $noteID);
            $stmt->bindParam(':note_title', $noteTitle);
            $stmt->bindParam(':note_content', $noteContent);
            $stmt->bindParam(':date_posted', $datePosted);

            $stmt->execute();

            echo "
            <script>
                alert('Updated Successfully!');
                window.location.href = 'http://localhost/schedule/snotes.php';
            </script>
            ";
            exit();
        } catch (PDOException $e) {
            echo 'Database Error: ' . $e->getMessage();
        }
    } else {
        echo "
        <script>
            alert('Please fill in both the title and content fields.');
            window.location.href = 'http://localhost/schedule/snotes.php';
        </script>
        ";
    }
}
?>
