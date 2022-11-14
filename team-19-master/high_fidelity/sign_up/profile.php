<?php
    include('session.php') ;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>profile page</title>

        <!-- Bootstrape css -->
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    	<!-- Bootstrape javascript -->
    	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    <body>

        <div id="tag"></div>
        <section class="menu_section">
            <!-- NAVIGATION -->
            <nav id="mySidenav" class="sidenav">
                <a class="closebtn">&times;</a>
                <a href="index.html">Home</a>
                <a href="account.html">Account</a>
                <a href="host.html">Host Match</a>
                <a href="team.html">Team</a>
    			<a href="matchmaking.html">MatchMaking</a>
                <a href="logout.php">Sign Out</a>
            </nav>

            <div class="openbtn">
                <i class="fas fa-bars fa-2x"></i> <!--Menu Icon-->
                <span class="menu-text">menu</span>
            </div>
            <div class="all-over-bkg"></div>
            <header>
                <!--
                <figure class="logo">
                    <img src="images/YounghwaNa-white-high-res.png" alt="Young Hwan Na Logo">
                    <figcaption class="sr-only">YoungHwan Na Logo</figcaption>
                </figure>
                -->
                <h1> welcome to Inviter: <?php echo$login_session; ?> </h1>

                </header>
                </section>

                <div class="container2">
                <div class="side_section">
                <section class="container_side">
                    <article>
                    <p> <b>Update Your info please fill out here</b> </p>
                    <button type="button" name="update info" onclick="window.location.href = 'updateinfo.php';">Update Info</button>

                        <!-- <figure class="profile">
                            <img src="images/YoungNa.png" alt="Profile Photo">
                            <figcaption>Young Na</figcaption>
                        </figure> -->

                    </article>
                </section>
                <section class="container_side">
                    <article>
                        <p>Skills / Hobbies
                        </p>
                        <ul>
                            <li>Soccer</li>
                        </ul>
                    </article>
                </section>
                <section class="container_side">
                    <article>
                        <p>Member / Team
                        </p>
                        <ul>
                            <li>IU Badminton Club</li>
                        </ul>
                    </article>
                </section>
                <section class="container_side">
                    <article>
                        <p>Upcoming Match</p>
                        <figure class="calendar">
                            <img src="images/calendar.PNG" alt="Calendar">
                        </figure>
                    </article>
                </section>
                </div>
    </body>
</html>
