<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['gameId'];
    $hostname = 'sql109.epizy.com';
    $username = 'epiz_34301171';
    $password = 'JtQuL2g5nw';
    $database = 'epiz_34301171_playmentor';
    $con = mysqli_connect($hostname, $username, $password, $database);

    //$database = 'assignment2';
    /// Now Select the database
    //$con->select_db($database);
    $sql = 'DELETE FROM GameTable WHERE Id = ?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        echo 'Row deleted successfully.';
        header(
            'Location: ../pages/admin.php'
        );
        exit();
    } else {
        echo 'Error deleting row: ' . $con->error;
    }
}
echo $id;
?>
