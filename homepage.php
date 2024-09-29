<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            overflow-x: hidden;
            font-family: 'Segoe UI', sans-serif;
            background-color: #ddd;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #28a745;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 97.5%;
            top: 0; 
            z-index: 1000;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-left: 40px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        /* hero */
        .hero {
            width: fit-content;
            height: 100vh;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 80px;
            position: relative;
            background-color: #f9f9f9;
            background: url('photos/greenbg.jfif')  center center/cover;
            filter: brightness(0.9);
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(40, 167, 69, 0.8); 
            z-index: -1;
        }

        .hero-content {
            width: 45%;
            color: white;
        }

        .hero-content h2 {
            font-size: 60px;
            margin-bottom: 20px;
            font-weight: 700;
            line-height: 1.2;
        }

        .hero-content p {
            font-size: 18px;
            line-height: 1.6;
            color: #ddd;
            font-weight: 400;
            margin-bottom: 30px;
        }

        .cta-container {
            width: 40%;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        .cta-container h3 {
            margin-top: 0;
            font-size: 24px;
            color: #28a745;
            font-weight: 600;
        }

        .cta-container p {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .cta-container a.button {
            display: block;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .cta-container a.button:hover {
            background-color: #218838;
        }

        /* aboutus section */
        #about-us {
            width: 97%;
            padding: 20px;
            background: #ddd;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            text-align: center;
        }

        #about-us h2 {
            font-size: 50px;
            margin-bottom: 50px;
            color: #28a745;
            text-align: center;
        }

        #about-us p {
            line-height: 1.6;
            color: #555;
            text-align: center;
            margin: 0 auto; 
            max-width: 1000px; 
            font-size: 17px;
        }

        #about-us a.button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            display: inline-block;
            margin: 20px; 
            margin-top: 60px;
        }

        #about-us a.button:hover {
            background-color: #218838;
        }

  
        footer {
            text-align: center;
            padding: 20px;
            background-color: #28a745;
            color: white;
            margin-top: auto;
        }

        .footercontent .changelogsbtn {
            text-decoration: none;
            color: lightgreen;
        }
    </style>
</head>
<body>

    <!-- header -->
    <header>
        <h1>ExaMPS</h1>
        <nav>
            <ul>
                <li><a href="#main-content">Home</a></li>
                <li><a href="#about-us">About Us</a></li> 
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>


    <!-- hero -->
    <div id="main-content" class="hero">
    <div class="hero-content">
        <h2>Welcome to ExaMPS!</h2>
        <p>
            A user-friendly platform to create, manage, and administer exams with Automated Mean Percentage Score (MPS) System for accurate, efficient assessments.
        </p>
    </div>
    <div class="cta-container">
        <h3>Are you an ExaMPS user?</h3>
        <a href="login.php" class="button">Login here</a>

        <h3>Are you a student taking an exam?</h3>

        <a href="enter_exam_id.php" class="button">Start Exam</a>
    </div>
</div>


    <!-- aboutus -->
    <div id="about-us">
        <h2>About Us</h2>
        <p>
            At ExaMPS, we understand the challenges educators face when it comes to designing, managing, and analyzing exams. That's why we've developed a comprehensive platform that simplifies the entire process.
        </p>
        <p>
            Our platform is tailored for educators, making it easier to generate tests, administer them to students, and record exam results, including the <b>Mean Percentage Score (MPS)</b>. This ensures efficient, accurate, and reliable assessments.
        </p>
        <p>
            Our mission is to provide educators with the tools they need to deliver top-quality exams with minimal hassle. We focus on user-friendly interfaces and a streamlined experience to empower both teachers and students.
        </p>

        <a href="aboutus.php" class="button">Read More...</a>
    </div>

    <!-- footer -->
    <footer>
        <div class="footercontent">
        <p>&copy; ExaMPS. All rights reserved. <a href="changelogs.php" class="changelogsbtn">View Changelogs</a></p>
        </div>
    </footer>

</body>
</html>
