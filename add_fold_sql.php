 <?php
 global $conn;

$name_fold = getParameter($_POST['name_fold'], 'String');
$notes = getParameter($_POST['note'], 'String');

$sql = "INSERT INTO folder(name_folder, note) 
            VALUES ('$name_fold', '$notes');";


if ($conn->query($sql) === TRUE) {
    echo "Teczka dodana<br>";
    header('Location: folders.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    echo "<br><br>Możliwe że taka teczka już istnieje.";
    echo "<br><a href='?action=add_fold'>Cofnij</a>";
}
?>