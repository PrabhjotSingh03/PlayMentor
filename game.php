<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="style/game.css">
    <title>Game</title>
</head>
<body>
    <main>
        
        <?php
            $userChoise = $_POST ['gameChoise'];

            // Make variables to store the login credentials
            $host = 'sql109.epizy.com';
            $user = 'epiz_34301171';
            $pass = 'JtQuL2g5nw';
            $db = 'epiz_34301171_playmentor';

            // Connect to the database
            $con = mysqli_connect($host, $user, $pass, $db);

            if (mysqli_connect_error()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }


            //get category type name
            $queryCat = "SELECT * FROM CategoryTable WHERE category_id=" . $userChoise;
            $result = mysqli_query($con,$queryCat);
            if(mysqli_num_rows($result)>0){
                while ($row = mysqli_fetch_assoc($result)) {
                echo "<h1 class='header'>You have selected the " . $row['Category_type'] . " game category</h1>";
                }
            }else{
                echo "No data";
            }

            
            echo '<div class="container">';
            //Showing the ranking of specific catalog of games based on realse dates
            //REPLACE the query with game cataloge number & game details
            $query = "SELECT * FROM GameTable JOIN CategoryTable ON GameTable.category_id=CategoryTable.category_id WHERE GameTable.category_id=" . $userChoise . " ORDER BY GameTable.Rating DESC LIMIT 5";
            //echo $query;
            $result = mysqli_query($con,$query);

            echo '<div class="ranking">';
            echo '<h2>Rating Ranking</h2>';
            echo '<p>Discover the top-rated games as our rating rankings showcase the best titles based on player feedback and expert evaluations, ensuring you always find the most exciting and highly regarded gaming experiences!</p>';
            echo '<div class="ranking__Container">';
            if(mysqli_num_rows($result)>0){
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="ranking__Container_game">';
                    echo '<img src="images/' . $row['Image'] . '" width="300">';
                    echo "<h3>Game Name: " . $row['Title'] . "</h3>";
                    echo "<p>Game Description: " . $row['Description'] . "</p>";
                    echo "<p>Platform: " . $row['Platform'] . "</p>";
                    echo "<p>Company: " . $row['Company'] . "</p>";
                    echo "<p>Release Date: " . $row['Release_date'] . "</p>";
                    echo "<p>Rating: " . $row['Rating'] . "/5.0</p>";
                    echo "<p>Price: $" . $row['Price'] . "</p>";
                    echo "</div>";
                }
            }else{
                    echo "No data";
            }
            echo '</div>';
            echo '</div>';
            //Recommendation of games under same catalog
            $query2 = "SELECT * FROM GameTable JOIN CategoryTable ON GameTable.category_id=CategoryTable.category_id WHERE GameTable.category_id =" . $userChoise;
            //echo $query2;
            $result = mysqli_query($con,$query2);

            echo '<div class="recommendation">';
            echo '<h2>Recommendation</h2>';
            echo '<p>Unearth personalized game recommendations tailored to your interests, guiding you to captivating titles for an exciting and tailored gaming experience!</p>';
            echo '<div class="recommendation__Container">';
            //randomly choose the game from the result and output as recommendation
            $numRows = mysqli_num_rows($result);
            $numRowsToDisplay = 5;//define the number of rows want to randomly select
            $randomRow = array_rand(range(0,$numRows -1),$numRowsToDisplay);

            foreach($randomRow as $index){
                mysqli_data_seek($result,$index);
                $row = mysqli_fetch_assoc($result);
                echo '<div class="recommendation__Container_game">';
                echo '<img src="images/' . $row['Image'] . '" width="300">';
                echo "<h3>Game Name: " . $row['Title'] . "</h3>";
                echo "<p>Game Description: " . $row['Description'] . "</p>";
                echo "<p>Platform: " . $row['Platform'] . "</p>";
                echo "<p>Company: " . $row['Company'] . "</p>";
                echo "<p>Release Date: " . $row['Release_date'] . "</p>";
                echo "<p>Rating: " . $row['Rating'] . "/5.0</p>";
                echo "<p>Price: $" . $row['Price'] . "</p>";
                echo "</div>";
            }
            echo '</div>';
            echo '</div>';


            mysqli_close($con);

        
        ?>
        </div>
    </main>
</body>
</html>