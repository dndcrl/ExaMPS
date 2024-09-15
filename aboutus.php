<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - ExaMPS</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            margin-left: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        /* Main content styling */
        .content {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #28a745;
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            text-align: center;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .team-section-wrapper {
        overflow: hidden;
        width: 100%;
        position: relative;
        }

        .team-section {
        display: flex;
        white-space: nowrap;
        padding-bottom: 20px;
        animation: slide 100s linear infinite;
        }

        @keyframes slide {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-5400px);
    }
}

        .team-section .member {
        flex: 0 0 auto;
        background: white;
        padding: 20px;
        margin: 20px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        width: 220px;
        }


        .team-section .member {
        display: block;
        }

        .team-section img {
        border-radius: 50%;
        width: 150px;
        height: 150px;
        object-fit: cover;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .team-section h3 {
        margin-top: 10px;
        font-size: 18px;
        color: #333;
        }

       .team-section p {
       color: #555;
       font-size: 14px;
       }

       /* Footer */
       footer {
       text-align: center;
       padding: 20px;
       background-color: #28a745;
       color: white;
       }

    </style>
</head>
<body>

<header>
    <h1>ExaMPS</h1>
    <nav>
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<div class="content">
    <h2>About ExaMPS</h2>
    <div class="section">
        <p>
            ExaMPS is a cutting-edge platform designed to simplify the process of creating, managing, and analyzing exams online. 
            Our platform is tailored for educators, making it easier to generate tests, administer them to students, and record exam results, 
            including the Mean Percentage Score (MPS). This ensures efficient, accurate, and reliable assessments.
        </p>
        <p>
            Our mission is to provide educators with the tools they need to deliver top-quality exams with minimal hassle. 
            We focus on user-friendly interfaces and a streamlined experience to empower both teachers and students.
        </p>
    </div>

    <h2>Meet the Team</h2>
    <div class="team-section-wrapper">
        <div class="team-section">
            <div class="member">
                <img src="photos/members/carletteid.png" alt="Team Member 1">
                <h3>Carlette Ann Dwayne<br>
                R. Santos</h3>
                <p>Lead Developer</p>
            </div>
            <div class="member">
                <img src="photos/member2.jpg" alt="Team Member 2">
                <h3>Cian Saverdo</h3>
                <p>UI/UX Designer</p>
            </div>
            <div class="member">
                <img src="photos/members/patid.jpg" alt="Team Member 3">
                <h3>John Patrick Refraccion</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/members/gingerid.png" alt="Team Member 4">
                <h3>Ginger A. Aguilar</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/members/lovelyid.png" alt="Team Member 5">
                <h3>Lovely Mercado</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/member6.jpg" alt="Team Member 6">
                <h3>Clement Dela Cruz</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/member7.jpg" alt="Team Member 7">
                <h3>John Paulo Dela Cruz</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/members/webbid.jpg" alt="Team Member 8">
                <h3>Webb Saimon Fadul</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/members/macid.jpg" alt="Team Member 9">
                <h3>Mark Andrew Fernandez</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/member10.jpg" alt="Team Member 10">
                <h3>Carl Lawrence Revilla</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/member11.jpg" alt="Team Member 11">
                <h3>Jhon Ellis Tibay</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/members/carletteid.png" alt="Team Member 1">
                <h3>Carlette Ann Dwayne<br>
                R. Santos</h3>
                <p>Lead Developer</p>
            </div>
            <div class="member">
                <img src="photos/member2.jpg" alt="Team Member 2">
                <h3>Cian Saverdo</h3>
                <p>UI/UX Designer</p>
            </div>
            <div class="member">
                <img src="photos/members/patid.jpg" alt="Team Member 3">
                <h3>John Patrick Refraccion</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/members/gingerid.png" alt="Team Member 4">
                <h3>Ginger A. Aguilar</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/members/lovelyid.png" alt="Team Member 5">
                <h3>Lovely Mercado</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/member6.jpg" alt="Team Member 6">
                <h3>Clement Dela Cruz</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/member7.jpg" alt="Team Member 7">
                <h3>John Paulo Dela Cruz</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/members/webbid.jpg" alt="Team Member 8">
                <h3>Webb Saimon Fadul</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/members/macid.jpg" alt="Team Member 9">
                <h3>Mark Andrew Fernandez</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/member10.jpg" alt="Team Member 10">
                <h3>Carl Lawrence Revilla</h3>
                <p>Project Manager</p>
            </div>
            <div class="member">
                <img src="photos/member11.jpg" alt="Team Member 11">
                <h3>Jhon Ellis Tibay</h3>
                <p>Project Manager</p>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>&copy; ExaMPS. All rights reserved.</p>
</footer>

</body>
</html>
