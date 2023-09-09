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
    <div class="flex_Container">
        <h1>Game Entry Form</h1>
        <form method="POST" action="../php_Handler/newGame_handler.php" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>

        <label for="platform">Platform:</label>
        <input type="text" name="platform" required>

        <label for="company">Company:</label>
        <input type="text" name="company" required>

        <label for="release_date">Release Date:</label>
        <input type="date" name="release_date" required>

        <label for="rating">Rating:</label>
        <input type="text" name="rating" step="1" min="0" max="5" required>

        <label for="uploadImage">Image:</label>
        <input type="file" name="uploadImage" required>
        <output></output>

        <label for="price">Price:</label>
        <input type="text" name="price" step="1" min="0" required>

        <label for="category_id">Category:</label>
        <div class="checkbox_container">
        <?php
        $hostname = 'sql109.epizy.com';
        $username = 'epiz_34301171';
        $password = 'JtQuL2g5nw';
        $database = 'epiz_34301171_playmentor';
        $con = mysqli_connect($hostname, $username, $password, $database);

        $sql = 'SELECT * FROM CategoryTable';

        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<input type="radio" name="Category_id" value="' .
                    $row['category_id'] .
                    '"> ' .
                    $row['Category_type'];
            }
        }
        ?>
     
        </div>
        <input type="submit" value="Submit">
    </form>
    </div>

</body>

</html>