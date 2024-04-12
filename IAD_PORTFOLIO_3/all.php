<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <style>@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Tilt+Neon&display=swap');</style>
        <style>@import url('https://fonts.googleapis.com/css2?family=Varela&display=swap');</style>
        <link rel="shortcut icon" href="../Images/logo-s-png.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../CSS/allsearch-style.css">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
		<script src="JS/all.js"></script>
        <title>Search Results</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="nav">
                <?php
            		session_start();
                    if(isset($_SESSION["uid"])){
                        echo <<<HTML
                        <ul>
                       		<li><img src="Images/logo-png.png" alt="" class="nav-img"></li>
                            <li><a href="../dashboard.php" class="hover">DASHBOARD</a></li>
                            <li><a href="../index.php" class="hover">HOME</a></li>
                            <li>
                            	<form action="PHP/logout.php" method="post">
                                <input type="hidden" name="logout" value="true">
                                <button type="submit" class="hover button">LOG OUT</button>
                            	</form>
                            </li>
                        </ul>
                    HTML;
                    } else {
                        echo <<<HTML
                        <ul>
                            <li><a href="../index.php" class="hover">HOME</a></li>
                            <li><img src="../Images/logo-png.png" alt="" class="nav-img"></li>
                        </ul>
                    HTML;
                    }
                ?>
            </div>
            <div class="search">
                <div class="results">
                    <h1>All Projects In The Database</h1>
                    <?php
                    $db_host = "localhost";
                    $db_name = "u_220213303_portfolio3";
                    $db_user = "u-220213303";
                    $db_password = "axLESwFgJz0bpg5";

                    try {
                        $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch(PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    $sql = "SELECT * FROM projects";

                    // Prepare the SQL statement
                    $stmt = $conn->prepare($sql);

                    // Execute the statement
                    $stmt->execute();

                    // Fetch all the project records as an associative array
                    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // If there are no projects, display a message
                    if (count($projects) == 0) {
                    echo "<p>No projects found.</p>";
                    } else {
                    foreach ($projects as $project) {
                       		echo "<div class='project'>";
                          	echo "<h3>{$project['title']}</h3>";
                    		echo "<p><strong>UID:</strong> {$project['uid']}</p>";
                           	echo "<hr>";
                            echo "<p><strong>Description:</strong> {$project['description']}</p>";
                    		echo "<div class='hide'>";
                            echo "<p><strong>Start Date:</strong> {$project['start_date']} | <strong>End Date:</strong> {$project['end_date']}</p>";
                            echo "<p><strong>Phase:</strong> {$project['phase']}</p>";
							echo "</div>";
                    		echo "<button type='button' class='popup'>View More</button>";
                    		echo "<button type='button' class='popless'>View Less</button>";
                          	echo "</div>";
                    	}
                    }

                    // Close the database connection
                    $conn = null;

                    ?>
                </div>
            </div>
            <div class="footer">
                <p>Made with &#129505; by Prakhar Pandey</p>
            </div>
        </div>
    </body>
</html>