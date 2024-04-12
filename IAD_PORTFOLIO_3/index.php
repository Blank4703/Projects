<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="Images/logo-s-png.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="CSS/style.css">
        <style>@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Tilt+Neon&display=swap');</style>
        <style>@import url('https://fonts.googleapis.com/css2?family=Varela&display=swap');</style>
        <!--<style>@import url('https://fonts.googleapis.com/css2?family=Courier+Prime&display=swap');</style>
        <style>@import url('https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap');</style>-->
        <style>@import url('https://fonts.googleapis.com/css2?family=Cabin&display=swap');</style>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
        <title>AProject</title>
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
                            <li><a href="dashboard.php" class="hover">DASHBOARD</a></li>
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
                            <li><a href="login.html" class="hover">REGISTER</a></li>
                            <li><a href="login.html" class="hover">LOGIN</a></li>
                            <li><img src="Images/logo-png.png" alt="" class="nav-img"></li>
                        </ul>
                    HTML;
                    }
                    ?>
                </div>
            <div class="home">
                <div class="home-content">
                    <h1>Welcome to AProject</h1>
                    <div class="break"></div>
                    <p>The Hub To Share Projects!</p>
                    <div class="break"></div>
                    <h3>Search all projects by title or end date:</h3>
                    <div class="break"></div>
                    <div class="search-container">
                        <div class="searchBar">
                            <form method="GET" action="search.php">
                                <input id="searchQueryInput" type="search" name="search" placeholder="Search" value="" />
                                <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                        <div class="space"></div>
                        <div class="search-date">
                            <form method="GET" action="search.php">
                                <input type="date" id="end" name="end">
                                <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="allprojects">
                        <form method="GET" action="all.php">
                            <button type="submit" class="all" id="all" name="all">View All Projects!</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="about">
                <div class="about-content">
                    <h1>What We're All About</h1>
                    <p>
                        AProject is a place for people to store and share their projects in a safe environment.<br> 
                        We value your safety and security of your projects and that is why we take the necessary<br>
                        precautions and appropriate measures to ensure it.
                    </p>
                    <div class="about-blocks">
                        <div class="blocks">
                            <i class="fa fa-duotone fa fa-user-secret" style="color: #BDBDBD;"></i>
                            <p>
                                As individuals and businesses, we value user<br>
                                security because it promotes trust, loyalty,<br>
                                and protects sensitive information. Prioritizing<br> 
                                user security ensures ethical and responsible<br>
                                use of personal data, and helps to prevent<br>
                                fraud and cybercrime.
                            </p>
                        </div>
                        <div class="blocks">
                            <i class="fa fa-solid fa fa-database" style="color: #BDBDBD;"></i>
                            <p>This website is database-driven, designed for<br>
                                storing and organizing projects. It allows for<br>
                                efficient management and retrieval of project<br> 
                                data, ensuring easy tracking and analysis of<br> 
                                project progress and outcomes.
                            </p>
                        </div>
                        <div class="break"></div>
                        <div class="blocks">
                            <i class="fa fa-search" aria-hidden="true" style="color: #BDBDBD;"></i>
                            <p>
                                Our project storage system simplifies project<br> 
                                retrieval with advanced search options that<br> 
                                allow users to easily filter and view projects<br> 
                                by different parameters such as date, phase,<br> 
                                and project name.
                            </p>
                        </div>
                        <div class="blocks">
                            <i class="fa fa-duotone fa fa-graduation-cap" style="color: #BDBDBD;"></i>
                            <p>
                                Students can benefit from our project storage<br>
                                systemas it provides a centralized location to<br>
                                store and organize their academic projects,<br>
                                making it easier to track progress, meet<br>
                                deadlines, and showcase their work.
                            </p>
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