<!DOCTYPE html>
<html>
<head>
    <title>My PHP Web App</title>
    <link href="./admin.css" type='text/css' rel="stylesheet">

<style>
    h1{
        font-size:3em;
    }
    .flex_container {
        display: flex;
        width: 100vw;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 2em;
    }
    .searchBar_Container{
        display: flex;
        justify-content: center;
    }
    .searchBar_Container input[type="text"] {
        flex: 1;
        border-radius:15px;
        padding:10px;
        width:350px;
        border: 3px solid black;
        outline: none;
    }
    .searchBar_Container button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
    }
    .searchBar_Container button:hover {
    background-color: #45a049;
    }
    button{
        display:block;
        padding: 0.5em 1.3em;
    }
    .searchBar_Container .submit{
        display:block;
        margin-top:10px;
        margin-left : auto;
        border-radius:15px;
        padding : 1.2em;
        gap: 1em;
    }
    .listGame_Container{
        display:flex;
        flex-direction:column;
        border:3px solid black;
        padding:2.5em;
        gap:2em;
        width: 70%;
        height:20em;
        overflow-y: scroll;
        position: relative;
      
    }
    .flex_item{
        display:flex;
        flex-direction:row;
        gap:30px;
    }
    .flex_item_title{
        display:flex;
        flex-basis: calc(70% - 1em);
        font-size:1.5em;
        font-weight:bold;
    }
    .flex_item_btn{
        display:flex;
        justify-content:center;
        flex-basis: calc(30% - 2em);
    }
    .flex_item_btn a{
        text-align: center;
        text-decoration:none;
        color:black;
        padding:5px 15px;
        margin-left:20px;
        border:2px solid black;
        border-radius:15px;
    }
    .flex_item_btn a:hover{
        background-color:green;
        color:white;
    }
    .btn_Add{
        display:block;
    }
    .HomePage_btn{
        color:black;
        text-decoration:none;
        font-size:3em;
        font-weight:bold;
        padding:0.15em;
        margin:1em;
    }
    .HomePage_btn:hover{
        color:red;
    }
</style>
</head>
<body>
    <a class="HomePage_btn" href=".."> < </a>
    <div class="flex_container">
        <h1>Admin Panel</h1>
        <form method="GET" action="../php_Handler/create_schema.php">
            <button type="submit">Create Database and Table</button>
        </form>
        <!--Search Bar -->
        <div class="searchBar_Container">
            <form  method="GET" action="./admin.php" >
                <input type="text" name="search_game" placeholder="Search...">
                <button class ="submit"type="submit">Search</button>
            </form>
        </div>
        <div>
            <form method="POST" action="./admin_newGame.php">
            <button class="btn_Add" type="submit">Add New Game</button>
            </form>
        </div>
        
        <!--List of Games -->
        <div class="listGame_Container">
            <?php
            $hostname = 'sql109.epizy.com';
            $username = 'epiz_34301171';
            $password = 'JtQuL2g5nw';
            $database = 'epiz_34301171_playmentor';
            $con = mysqli_connect($hostname, $username, $password, $database);

            $sql = 'SELECT * FROM GameTable';
            // Check if search bar button was click;
            if (isset($_GET['search_game'])) {
                //sanitize input using mysql escape string.
                $searchQuery = mysqli_real_escape_string(
                    $con,
                    $_GET['search_game']
                );
                $sql = "SELECT * FROM GameTable WHERE Title LIKE '%$searchQuery%'";
            }
            $result = mysqli_query($con,$sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="flex_item">';
                    echo '<div class="flex_item_title">';
                    echo $row['Title'];
                    echo '</div>';
                    echo '<div class="flex_item_btn">' .
                        '<a href="./GameEdit.php?gameId=' .
                        $row['Id'] .
                        '">Edit</a>' .
                        '<a href="../php_Handler/DeleteGame_handler.php?gameId=' .
                        $row['Id'] .
                        '">Delete</a></div>';
                    echo '</div>';
                }
            }
            
            $con->close();
            ?>
        </div>
    </div>
    

</body>

</html>