<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changelogs - ExaMPS</title>
    <style>
        body {
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
            width: 97%;
            top: 0;
            z-index: 1000;
        }

        header h1 {
            color: #f4f4f4;
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

        .container {
            max-width: 800px;
            margin: 80px auto 20px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex: 1; /* Allow container to take up available space */
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #28a745;
        }

        .changelog-entry {
            margin-bottom: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .changelog-entry h2 {
            font-size: 20px;
            margin: 0 0 10px;
            color: #333;
        }

        .changelog-entry p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            margin: 0;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #28a745;
            color: white;
        }

        .footercontent .changelogsbtn {
            text-decoration: none;
            color: lightgreen;
        }

        @media (max-width: 768px) {
            header {
            background-color: #28a745;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 89%;
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
            margin-left: 10px;
        }

           nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 12px;
        }
    }
    </style>
</head>
<body>

    <!-- header -->
    <header>
        <h1>ExaMPS</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="under_construction.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- changelogs -->
    <div class="container">
        <h1>Changelogs</h1>

        <div class="changelog-entry">
            <h2>ExaMPS Beta 1.0.0  - September 29, 2024</h2>
            <p><b>Posted by: carlette</b></p>
            <br>
            <p> 
                - Live temporary online website for ExaMPS for testing. <b><i>(examps.rf.gd)</i></b><br>
                - Improved the mobile view to enhance accessibility on mobile devices.<br>
                - Added admins and admin panel to manage the website.
                
            </p>
        </div>

        <div class="changelog-entry">
            <h2>ExaMPS - September 9, 2024</h2>
            <p><b>Posted by: carlette</b></p>
            <br>
            <p>
                - Initial making of the ExaMPS platform.<br>
                - Implemented exam creation, management, and taking functionalities.<br>
                - Added user authentication for teachers and students.
            </p>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="footercontent">
        <p>&copy; ExaMPS. All rights reserved. <a href="changelogs.php" class="changelogsbtn">View Changelogs</a></p>
        </div>
    </footer>

</body>
</html>
