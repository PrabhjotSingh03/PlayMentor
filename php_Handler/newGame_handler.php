<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $platform = $_POST['platform'];
    $company = $_POST['company'];
    $release_date = $_POST['release_date'];
    $rating = $_POST['rating'];
    $price = $_POST['price'];
    $category_id = $_POST['Category_id'];

    //upload image
    //folder dicretory
    $targetDir = '../images/';
    // create path for images
    $targetFile = $targetDir . basename($_FILES['uploadImage']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    // Becasue we decided the images path - ./images/imagefile
    $imageUpload = str_replace('../images/', '',$targetFile);
    // Move image into the image folder if it is successful , save in folers , then insert data into database.
    if (move_uploaded_file($_FILES['uploadImage']['tmp_name'], $targetFile)) {
        $hostname = 'sql109.epizy.com';
        $username = 'epiz_34301171';
        $password = 'JtQuL2g5nw';
        $database = 'epiz_34301171_playmentor';
        $con = mysqli_connect($hostname, $username, $password, $database);

        $sql =
            'INSERT INTO GameTable (Title, Description, Platform, Company, Release_date, Rating, Image, Price, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->bind_param(
            'sssssdssi',
            $title,
            $description,
            $platform,
            $company,
            $release_date,
            $rating,
            $imageUpload,
            $price,
            $category_id
        );
        if ($stmt->execute()) {
            echo 'Inserted successfully.';
            // Redirect to another page
            header(
                'Location: ../pages/admin.php'
            );
            exit();
        } else {
            echo 'Error inserting game entry: ' . $stmt->error;
        }
    }else{
         header(
                'Location: ../pages/admin.php'
            );
            exit();
    }
}

?>
