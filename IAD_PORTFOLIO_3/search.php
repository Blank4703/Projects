<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <style>@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Tilt+Neon&display=swap');</style>
        <style>@import url('https://fonts.googleapis.com/css2?family=Varela&display=swap');</style>
        <link rel="shortcut icon" href="../Images/logo-s-png.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../CSS/search-style.css">
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
				<h1>Search Results</h1>
                <div class="results">
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

                    if(isset($_GET['search']) || isset($_GET['end'])) {
                        if(isset($_GET['search'])) {
                            $search_query = $_GET['search'];

                            if(!empty($search_query)) {
                                $stmt = $conn->prepare("SELECT * FROM projects WHERE title LIKE :search_query");
                                $stmt->bindValue(':search_query', "%$search_query%", PDO::PARAM_STR);
                                $stmt->execute();
                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if(count($results) > 0) {
                                    foreach ($results as $project) {
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
                                } else {
                                    echo "<p>No results found.</p>";
                                }
                            } else {
                                echo "<p>Please enter a search query.</p>";
                            }
                        }

                        if(isset($_GET['end'])) {
                            $end_date = $_GET['end'];

                            if(!empty($end_date)) {
                                $stmt = $conn->prepare("SELECT * FROM projects WHERE end_date = :end_date");
                                $stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
                                $stmt->execute();
                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if(count($results) > 0) {
                                    foreach ($results as $project) {
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
                                } else {
                                    echo "<p>No results found.</p>";
                                }
                            } else {
                                echo "<p>Please enter a search query or select a date.</p>";
                            }
                        }
                    } else {
                        echo "<p>Please enter a search query or select a date.</p>";
                    }
                ?>
                </div>
            </div>
            <div class="footer">
                <p>Made with &#129505; by Prakhar Pandey</p>
            </div>
        </div>
    </body>
</html>