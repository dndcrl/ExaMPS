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
            margin-left: 60px;
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

        .section p {
            font-size: 17px;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .our-story {
            padding: 40px 20px;
            text-align: center;
        }

        .our-story h2 {
            color: #28a745;
            font-size: 36px;
            margin-bottom: 20px;
        }

        .our-story p {
            font-size: 17px;
            max-width: 900px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .expandable-container {
            overflow: hidden;
            transition: max-height 0.8s ease-out;
            max-height: 5px; 
        }

        .expandable-content {
            display: block;
            font-size: 19px;
            line-height: 1.6;
        }

        .expandable-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 17px;
            color: #28a745;
            background-color: #fff;
            border: 2px solid #28a745;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin: 20px 0;
            transition: transform 0.5s ease;
        }

        .expandable-button:hover {
            background-color: #28a745;
            color: #fff;
        }

        .expanded {
            max-height: 500px; 
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
            animation: slide 200s linear infinite;
        }

        @keyframes slide {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-5600px);
            }
        }

        .team-section .member {
            flex: 0 0 auto;
            background: whitesmoke;
            padding: 20px;
            margin: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 220px;
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
            ExaMPS is a platform designed to simplify the process of creating, managing, and analyzing exams online. 
            Our platform is tailored for educators, making it easier to generate tests, administer them to students, and record exam results, 
            including the <b>Mean Percentage Score (MPS).</b>
            This ensures efficient, accurate, and reliable assessments.
        </p>
        <br>
        <p>
            Our mission is to provide educators with the tools they need to deliver top-quality exams with minimal hassle. 
            We focus on user-friendly interfaces and a streamlined experience to empower both teachers and students.
        </p>
    </div>

    <div class="our-story">
        <h2>Our Story</h2>
        <p>
        ExaMPS is a research initiative undertaken by Grade 12 - Buoyant, Group 2, as part of their Practical Research 2 course,
        <br>under the guidance of Mrs. Janette G. De Ramos at Famy National Integrated High School for the School Year 
        <br>2024-2025.
        </p>
        <br>
        <div class="expandable-container" id="expandable-container">
            <p class="expandable-content">
                The concept was initially proposed by Mr. Hjalmar Pantaleon, who envisioned creating an effective MPS Recording System. 
                During our title defense, the research team presented two preliminary titles to the panel: "Development of Adaptive Online Examination for Personalized 
                Learning" and "Development of Effective MPS Recording System." Following a comprehensive review, the panelists recommended integrating the two topics. 
                Consequently, the final research title was established as "Development of Effective Online Examination System with MPS Recording System 
                at Famy National Integrated High School."
            </p>
        </div>
        <button class="expandable-button" onclick="toggleContent()">Read More</button>
    </div>

    <h2>Meet the Team that made ExaMPS Possible.</h2>
    <div class="team-section-wrapper">
        <div class="team-section">
        <div class="member">
                <a href="https://www.facebook.com/motherkeyn/" target="_blank">
                <img src="photos/members/carletteid.png" alt="Team Member 1">
                </a>
                <h3>Carlette Ann Dwayne<br>
                R. Santos</h3>
                <p>Project Leader</p>
                <p>Lead Developer</p>
            </div>
            <div class="member">
                <img src="photos/member2.jpg" alt="Team Member 2">
                <h3>Cian Saverdo</h3>
                <p>Project Co-Leader</p>
                <p>Research Editor</p>
            </div>
            <div class="member">
                <img src="photos/members/patid.jpg" alt="Team Member 3">
                <h3>John Patrick Refraccion</h3>
                <p>Project Secretary</p>
            </div>
            <div class="member">
                <img src="photos/members/gingerid.png" alt="Team Member 4">
                <h3>Ginger A. Aguilar</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/members/lovelyid.png" alt="Team Member 5">
                <h3>Lovely Mercado</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/member6.jpg" alt="Team Member 6">
                <h3>Clement Dela Cruz</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/members/jpid.jfif" alt="Team Member 7">
                <h3>John Paulo Dela Cruz</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/members/webbid.jpg" alt="Team Member 8">
                <h3>Webb Saimon Fadul</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/members/macid.jpg" alt="Team Member 9">
                <h3>Mark Andrew Fernandez</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/member10.jpg" alt="Team Member 10">
                <h3>Carl Lawrence Revilla</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/members/eironid.jfif" alt="Team Member 12">
                <h3>Eiron Josh D. Santos</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/member12.jpg" alt="Team Member 13">
                <h3>Jhon Ellis Tibay</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <a href="https://www.facebook.com/motherkeyn/">
                <img src="photos/members/carletteid.png" alt="Team Member 1">
                </a>
                <h3>Carlette Ann Dwayne<br>
                R. Santos</h3>
                <p>Project Leader</p>
                <p>Lead Developer</p>
            </div>
            <div class="member">
                <img src="photos/member2.jpg" alt="Team Member 2">
                <h3>Cian Saverdo</h3>
                <p>Project Co-Leader</p>
                <p>Research Editor</p>
            </div>
            <div class="member">
                <img src="photos/members/patid.jpg" alt="Team Member 3">
                <h3>John Patrick Refraccion</h3>
                <p>Group Secretary</p>
            </div>
            <div class="member">
                <img src="photos/members/gingerid.png" alt="Team Member 4">
                <h3>Ginger A. Aguilar</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/members/lovelyid.png" alt="Team Member 5">
                <h3>Lovely Mercado</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/member6.jpg" alt="Team Member 6">
                <h3>Clement Dela Cruz</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/members/jpid.jfif" alt="Team Member 7">
                <h3>John Paulo Dela Cruz</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/members/webbid.jpg" alt="Team Member 8">
                <h3>Webb Saimon Fadul</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/members/macid.jpg" alt="Team Member 9">
                <h3>Mark Andrew Fernandez</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/member10.jpg" alt="Team Member 10">
                <h3>Carl Lawrence Revilla</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/members/eironid.jfif" alt="Team Member 11">
                <h3>Eiron Josh D. Santos</h3>
                <p>Member</p>
            </div>
            <div class="member">
                <img src="photos/member11.jpg" alt="Team Member 12">
                <h3>Jhon Ellis Tibay</h3>
                <p>Member</p>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>&copy; ExaMPS. All rights reserved.</p>
</footer>

<script>
    function toggleContent() {
        var container = document.getElementById("expandable-container");
        var button = document.querySelector(".expandable-button");

        if (container.classList.contains("expanded")) {
            container.classList.remove("expanded");
            button.textContent = "Read More";
        } else {
            container.classList.add("expanded");
            button.textContent = "Read Less";
        }
    }
</script>

</body>
</html>
