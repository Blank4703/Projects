<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <style>@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Tilt+Neon&display=swap');</style>
        <style>@import url('https://fonts.googleapis.com/css2?family=Varela&display=swap');</style>
        <link rel="shortcut icon" href="Images/logo-s-png.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="CSS/dashboard-style.css">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
        <script src="JS/dashboard-js.js"></script>
        <title>Your Dashboard</title>
    </head>
    <body>
		<?php
		session_start();
		if (!isset($_SESSION['uid'])) {
    		echo"<h2 style='text-align:center;'>You must be logged in to view this page.</h2>";
    		exit();
		}
		?>
        <div class="wrapper">
            <div class="dashboard">
                <div class="sidebar">
                    <img src="Images/logo-png.png" alt="" class="sidebar-img">
					<a class="button1" href="index.php">HOME</a>
                    <button id="b1" class="hover a">View Projects</button>
                    <button id="b2" class="hover a">Add Projects</button>
                    <button id="b3" class="hover a">Edit Projects</button>
                    <form action="PHP/logout.php" method="post">
                        <input type="hidden" name="logout" value="true">
                        <button type="submit" class="button">Log Out</button>
                    </form>
                </div>
                <div class="dash-content">
                    <h1 style="margin: 0;">Welcome To Your Dashboard,</h1>
					<?php
                        	try {
                            	$conn = new PDO("mysql:host=localhost;dbname=u_220213303_portfolio3", "u-220213303", "axLESwFgJz0bpg5");
                            	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        	} catch(PDOException $e) {
                            	echo "Connection failed: " . $e->getMessage();
                        	}
                        	$user_id = $_SESSION["uid"];
                        	$stm = $conn->prepare("SELECT * FROM users WHERE uid = :user_id");
                        	$stm->bindParam(":user_id", $user_id);
                        	$stm->execute();
                        	$use = $stm->fetchAll(PDO::FETCH_ASSOC);
							
							$username = htmlspecialchars($use[0]["username"]);
							echo "<h2 style='margin-top: 0;'>" . $username . "!</h2>";
					?>
                    <div class="info-blocks">
                        <div class="uid">
                            <h3 style='margin: 0;'>Your User ID</h3>
                    		<?php
                    		$id = $_SESSION["uid"];
                    		echo "<p style='margin: 0;'>".$id."</p>";
                    		?>
                        </div>
                        <div class="current-mail">
                            <h3 style='margin: 0;'>Your Email</h3>
                            <?php
                            $user_id = $_SESSION["uid"];
                        	$stm = $conn->prepare("SELECT * FROM users WHERE uid = :user_id");
                        	$stm->bindParam(":user_id", $user_id);
                        	$stm->execute();
                        	$use = $stm->fetchAll(PDO::FETCH_ASSOC);
							
							$em = htmlspecialchars($use[0]["email"]);
							echo "<p style='margin: 0;'>" . $em . "</p>";
                            ?>
                        </div>
                        <div class="project-count">
                            <h3 style="margin: 0;">No. Of Projects</h3>
                            <?php
                            
                            $user_id = $_SESSION["uid"];
                            $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM projects WHERE uid = :user_id");
                            $stmt->bindParam(":user_id", $user_id);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            $count = $result['count'];
                            if ($count > 0) {
                                echo "<p style='margin: 0;'>" . $count . "</p>";
                            } else {
                                echo "<p style='margin: 0;'>No projects found.</p>";
                            }
                            ?>
                        </div>
                    </div>
                    <p id="para" class="para">
                        Your dashboard is a centralized platform that enables you<br>
                        to manage your projects. It allows users to view all their<br>
                        projects, add new ones, and edit existing ones. The dashboard<br>
                        enhances productivity, collaboration, and ensures timely<br>
                        project completion.
                    </p>
                	<div class="view" id="view">
						<h2>Your Projects</h2>
                        <?php
                        	
                        	$user_id = $_SESSION["uid"];
                        	$stmt = $conn->prepare("SELECT * FROM projects WHERE uid = :user_id");
                        	$stmt->bindParam(":user_id", $user_id);
                        	$stmt->execute();
                        	$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        	if (count($projects) > 0) {
                            	foreach ($projects as $project) {
                                	echo "<div class='project'>";
                                	echo "<button class='delete' id='delete' style='float: right;' type='button'><i class='fa fa-solid fa fa-trash' style='color: #fc6b64;'></i></button>";
                                	echo "<h3>{$project['title']}</h3>";
                                	echo "<p><strong>PID:</strong> {$project['pid']}";
                                	echo "<hr>";
                                    echo "<p>{$project['description']}</p>";
                                    echo "<p><strong>Start Date:</strong> {$project['start_date']} | <strong>End Date:</strong> {$project['end_date']}</p>";
                                    echo "<p><strong>Phase:</strong> {$project['phase']}</p>";
                                	echo "</div>";
                                	echo <<<HTML
                                    	<div class='del-hidden' id='del-hidden'>
                                        	<div class='confirm' id='confirm'>
                                            	<h3 style='text-align: center;'>Are you sure you want to delete '{$project['title']}'?</h3>
                                                <button type="button" class="button del-back" id="del-back">Cancel</button>
                                                <form method='post' action='PHP/delete.php'>
                                                	<input type='hidden' value='{$project['pid']}' name='pid'>
                                                	<input type="submit" id="delsub" value="Confirm">
                                                </form>
                                            </div>
                                        </div>
                                    HTML;
                            	}
                        	} else {
                            	echo "<p>No projects found.</p>";
                        	}
                        	?>
                    </div>
                    <div class="add" id="add">
                        <div class="add-cont">
                            <h2>Add A Project!</h2>
                            <form action="PHP/add.php" method="post" class="add-form">
                                <div class="form-col">
                                    <label for="title">Project Title: </label>
                                    <input type="text" placeholder="Title.." id="title" name="title" required>
                                </div>
                                <div class="form-col">
                                    <label for="phase">Select Project Phase: </label>
                                    <select name="phase" id="phase" required>
                                        <option value="Design">Design</option>
                                        <option value="Development">Development</option>
                                        <option value="Testing">Testing</option>
                                        <option value="Deployment">Deployment</option>
                                        <option value="Complete">Complete</option>
                                    </select>
                                </div>
                                <div class="break"></div>
                                <div class="form-col">
                                    <label for="start">Start Date: </label>
                                    <input type="date" id="start" name="start" required>
                                </div>
                                <div class="form-col">
                                    <label for="end">End Date: </label>
                                    <input type="date" id="end" name="end" required>
                                </div>
                                <div class="break"></div>
                                <div class="form-col">
                                    <label for="desc">Give The Project A Description: </label>
                                    <textarea placeholder="Description.." id="desc" name="desc" required></textarea>
                                </div>
                                <div class="break"></div>
                                <input type="submit" id="addsub" value="Submit">
                            </form>
                        </div>
                    </div>
                    <div class="edit" id="edit">
                        <h2>Edit A Project!</h2>
                        <div class="h" id="h">
                        	<div class="edit-cont" id="edit-cont">
                            
                             <?php
                        	$user_id = $_SESSION["uid"];
                        	$stmt = $conn->prepare("SELECT * FROM projects WHERE uid = :user_id");
                        	$stmt->bindParam(":user_id", $user_id);
                        	$stmt->execute();
                        	$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        	if (count($projects) > 0) {
                            	foreach ($projects as $project) {
                                	echo <<<HTML
                                    <div id='x' class='x'>
                                    	<div class='edit-projects'>
                                            <p>{$project['title']}</p>
                                            <strong>PID:</strong>
                                            <p>{$project['pid']}</p>
                                            <form action='' method=''>
                                            	<button class='edit-button' type="button"><i class='fa fas fa-edit' style='color: #fc6b64;'></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class='y' id='y'>
                                    	<div class="hidden-form" id="hidden-form">
                                            <form action="PHP/edit.php" method="post" class="edit-form">
                                            	<input type='hidden' value='{$project['pid']}' name='pid'>
                                                <div class="form-col">
                                                    <label for="ed-title">Edit Title: </label>
                                                    <input type="text" placeholder="Title.." id="ed-title" name="ed-title" value='{$project['title']}'>
                                                </div>
                                                <div class="form-col">
                                                    <label for="ed-phase">Edit Project Phase: </label>
                                                    <select name="ed-phase" id="ed-phase">
                                                        <option value="Design">Design</option>
                                                        <option value="Development">Development</option>
                                                        <option value="Testing">Testing</option>
                                                        <option value="Deployment">Deployment</option>
                                                        <option value="Complete">Complete</option>
                                                    </select>
                                                </div>
                                                <div class="break"></div>
                                                <div class="form-col">
                                                    <label for="ed-start">Edit Start Date: </label>
                                                    <input type="date" id="ed-start" name="ed-start" value='{$project['start_date']}'>
                                                </div>
                                                <div class="form-col">
                                                    <label for="end">Edit End Date: </label>
                                                    <input type="date" id="ed-end" name="ed-end" value='{$project['end_date']}'>
                                                </div>
                                                <div class="break"></div>
                                                <div class="form-col">
                                                    <label for="desc">Edit Description: </label>
                                                    <textarea placeholder="Description.." id="ed-desc" name="ed-desc">{$project['description']}</textarea>
                                                </div>
                                                <div class="break"></div>
                                                <button type="button" class="button back" id="back"><i class="fa fa-solid fa fa-arrow-left" style="color: #ffffff;"></i>  Back</button>
                                                <input type="submit" id="editsub" value="Submit">
                                            </form>
                                        </div>
                                    </div>
                                    HTML;
                            	}
                        	} else {
                            	echo "<p>No projects found.</p>";
                        	}
                        	?>
                       		</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <p>Made with &#129505; by Prakhar Pandey</p>
            </div>
        </div>
    </body>
</html>