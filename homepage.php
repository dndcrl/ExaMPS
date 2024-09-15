<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header styling */
        header {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            margin-left: 60px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        /* Hero Section */
        .hero {
            height: 100vh; /* Full viewport height */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            color: white;
            text-align: center;
            padding: 0 20px;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('photos/greenbg.jfif') no-repeat center center/cover; /* Replace with your background image path */
            filter: blur(1px); /* Adjust the blur amount */
            z-index: -1;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h2 {
            font-size: 80px;
            margin-bottom: 20px;
            font-weight: 700;
            color: white;
        }

        .hero p {
            font-size: 18px;
            line-height: 1.6;
            max-width: 800px;
            margin-bottom: 30px;
            color: #333;
            font-weight: bold;
        }

        .hero a.button {
            background-color: #28a745;
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            display: inline-block;
        }

        .hero a.button:hover {
            background-color: #218838;
        }

        /* About Us Section */
        #about-us {
            width: 97%;
            
            padding: 20px;
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            text-align: center;
            
        }

        #about-us h2 {
            font-size: 50px;
            margin-bottom: 20px;
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
        }

       #about-us a.button:hover {
       background-color: #218838;
       }


        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #28a745;
            color: white;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
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

    <!-- Hero Section -->
    <div id="main-content" class="hero">
        <div class="hero-content">
            <h2>Welcome to ExaMPS!</h2>
            <p>
                This platform allows teachers to create, manage, and administer exams online with the feature of Automated MPS (Mean Score Percentage System). The system is designed to be user-friendly, secure, and efficient. Whether you're a teacher managing exams or a student taking them, this platform provides everything you need.
            </p>
            <a href="login.php" class="button">Get Started</a>
        </div>
    </div>

    <!-- About Us Section -->
    <div id="about-us">
        <h2>About Us</h2>
        <p>
        At ExaMPS, we understand the challenges educators face when it comes to designing, managing, and analyzing exams.
        <br>That's why we've developed a comprehensive platform that simplifies the entire process.
        </p>
        <br>
        <p>
        ExaMPS is a cutting-edge platform designed to simplify the process of creating, managing, and analyzing exams online.<br>
        Our platform is tailored for educators, making it easier to generate tests, administer them to students, and record exam results,<br>
        including the Mean Percentage Score (MPS). This ensures efficient, accurate, and reliable assessments.
        </p>
        <p>
        Our mission is to provide educators with the tools they need to deliver top-quality exams with minimal hassle.<br>
        We focus on user-friendly interfaces and a streamlined experience to empower both teachers and students.
        </p>

        <a href="aboutus.php" class="button">Read More...</a>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; ExaMPS. All rights reserved.</p>
    </footer>

</body>
</html>
