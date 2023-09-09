<!DOCTYPE html>
<html>
<head>
    <title>My PHP Web App</title>
<style>
    .flex_Container{
        display:flex;
        justify-content:center;
        flex-direction:column;
        align-items: center;
    }
    form {
            width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }
        label, input {
            display: block;
            font-weight:bold;
            margin-bottom: 10px;
        } 
        input[type="text"]{
            width:250px;
            padding:5px 10px;
        }
        input[type="submit"] {
            display:block;
            margin:auto;
            background-color: #4CAF50;
            color: white;
            padding: 10px 35px;
            border: none;
            border-radius: 5px;
            margin-top:15px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .checkbox_container{
             display: flex;
        }
        input[type="radio"]{
            margin-left:15px;
        }
        textarea{
            width:350px;
            height:150px;
        }
</style>
</head>
<body>
    <?php
       $hostname = 'sql109.epizy.com';
       $username = 'epiz_34301171';
       $password = 'JtQuL2g5nw';
       $database = 'epiz_34301171_playmentor';
        $con = mysqli_connect($hostname, $username, $password, $database);

    //$database = 'assignment2';
    $param = $_GET['gameId'];
    // Now Select the database
    //$con->select_db($database);
    $sql = 'SELECT * FROM GameTable WHERE Id = ' . $param;
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); ?>
    <div class="flex_Container">
        <h1><?php echo $row['Title']; ?></h1>
        <form method="POST" action="../php_Handler/UpdateGame_handler.php" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="hidden" name="id" value="<?php echo $param; ?> ">
        <input type="text" name="title" value="<?php echo $row[
            'Title'
        ]; ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" required>
        <?php echo $row['Description']; ?>
        </textarea>
        <label for="platform">Platform:</label>
        <input type="text" name="platform" value="<?php echo $row[
            'Platform'
        ]; ?>" required>

        <label for="company">Company:</label>
        <input type="text" name="company" value="<?php echo $row[
            'Company'
        ]; ?>" required>

        <label for="release_date">Release Date:</label>
        <input type="date" name="release_date" value="<?php
        $release_date = $row['Release_date'];
        // Format the date to 'YYYY-MM-DD' format
        $formatted_date = date('Y-m-d', strtotime($release_date));

        echo $formatted_date;
        ?>" required>

        <label for="rating">Rating:</label>
        <input type="text" name="rating" step="1" min="0" max="5" value="<?php echo $row[
            'Rating'
        ]; ?>" required>

        <label for="uploadImage">Image:</label>
        <input type="file" name="uploadImage">
        <output><?php
        $filename = basename($row['Image']);
        echo $filename;
        ?></output>

        <label for="price">Price:</label>
        <input type="text" name="price" step="1" min="0" value="<?php echo $row[
            'Price'
        ]; ?>"required>

        <label for="category_id">Category ID:</label>
        <div class="checkbox_container">
        <?php
        $hostname = 'sql109.epizy.com';
        $username = 'epiz_34301171';
        $password = 'JtQuL2g5nw';
        $database = 'epiz_34301171_playmentor';
            $con = mysqli_connect($hostname, $username, $password, $database);

        $sql = 'SELECT * FROM CategoryTable';
        //$database = 'assignment2';
        $categoryId = $row['category_id'];
        // Now Select the database
        //$con->select_db($database);
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // If the category ID  = 2 then set checked
                if ($categoryId == $row['category_id']) {
                    echo '<input type="radio" name="category_id" value="' .
                        $row['category_id'] .
                        '" checked> ' .
                        $row['Category_type'];
                } else {
                    echo '<input type="radio" name="category_id" value="' .
                        $row['category_id'] .
                        '"> ' .
                        $row['Category_type'];
                }
            }
        }
        ?>
     
        </div>
        <input type="submit" value="Update">
    </form>
    <?php
    } else {
        echo "No game found with ID: $param";
    }
    ?>
    </div>

</body>

</html>