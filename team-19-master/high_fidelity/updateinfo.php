<?php
include('session.php');
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>profile page</title>

    <!-- resets browser defaults -->
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <!-- custom styles -->
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <!-- Leaflet: OK to use either downloaded resources or CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />

    <!-- Font Awesome-->
    <script src="https://kit.fontawesome.com/3680edfbdb.js" crossorigin="anonymous"></script>

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
            <i class="fas fa-bars fa-2x"></i>
            <!--Menu Icon-->
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




    <div class="container_main">
        <div class="side_section">
            <section class="container_side">
                <article>
                    <p> <b>Update Your info please fill out here</b> </p>
                    <form action="updateinfo_config.php" method="post">
                        <p><b>Update Picture </b></p>
                        <label for="img">Select image:</label>
                        <input type="file" id="img" name="img" accept="image/*">

                        <p> <b>Skills / Hobby </b></p>
                        <p>
                            <label>Select skills</label>
                            <select id="sporttype" name="sporttype">
                                <option value="soccer">soccer</option>
                                <option value="basketball">basketball</option>
                                <option value="tennis">tennis</option>
                                <option value="badminton">badminton</option>
                                <option value="golf">golf</option>
                            </select>
                        </p>

                        <button type="submit" name="update info" >Update</button>
                    </form>

                </article>
            </section>


            </div>

    </body>
</html>
