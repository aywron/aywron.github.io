<?php
include("../conn1/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['note_title'], $_POST['note_content'])) {
        $noteTitle = $_POST['note_title'];
        $noteContent = $_POST['note_content'];
        $dateUploaded = date("Y-m-d H:i:s"); 

        try {
            $stmt = $conn->prepare("INSERT INTO tbl_note (note_title, note_content, date_posted) VALUES (:note_title, :note_content, :date_posted)");

            $stmt->bindParam(':note_title', $noteTitle);
            $stmt->bindParam(':note_content', $noteContent);
            $stmt->bindParam(':date_posted', $dateUploaded);

            $stmt->execute();

            echo "
            <script>
                alert('Added Successfully!');
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
