<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrbanPulse Dynamics</title>
    <link rel="stylesheet" href="../indexCSS/index.css">
    <link rel="icon" href="../images/UrbanPulseDynamicslogo.png"> <!-- ai generated logo -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        .hero { /* hero section */
            background: linear-gradient(135deg, #0a0f2c 0%, #0d1a3a 50%, #0a1628 100%);
            border-bottom: 3px solid #c9922a;
            align-items: flex-start;
            padding-top: 40px;
        }
            .hero h1 { /* main title */
                font-size: 52px;
                margin-bottom: 15px;
            }
            .hero-slogan { /* slogan */
                font-style: italic;
                font-size: 18px;
                color: #38bdf8;
                margin-bottom: 20px;
            }
            .hero-company-description { /* company description */
                color: #8898bb;
                font-size: 15px;
                line-height: 1.8;
                max-width: 520px;
                margin-bottom: 30px;
                border-left: 3px solid #c9922a;
                padding-left: 16px;
            }
    </style>


</head>

<body>
    <nav class="navbar"> <!-- navigation bar -->
        <div style="display: flex;  flex-direction: column; gap: 8px; align-items: flex-start;"> <!-- logo and search container -->
            <div class="nav-logo"> <!-- logo section -->
            <img src="../images/UrbanPulseDynamicslogo.png" alt="UrbanPulse Dynamics Logo" style="margin-right: 10px;">
                <div> 
                    <span class="logo-main">UrbanPulse</span>
                    <span class="logo-sub">Dynamics</span>
                </div>
            </div>

            <div class="search-bar"> <!-- search bar -->
                <label for="search" class="sr-only">Search</label>
                <input type="text" id="search" placeholder="Search...">
                <button aria-label="Search"><i class='bx bx-search'></i></button>
            </div>
        </div>

        <nav>
            <a href="../Index/index.html" class="nav-link active">HOME</a>
            <a href="../Jobs/jobs.html" class="nav-link">JOBS</a>
            <a href="../Apply/Apply.html" class="nav-link">APPLY</a>
            <a href="../About/about.html" class="nav-link">ABOUT</a>
        </nav>
    </nav>
    
    <section class="hero" id="home">
        <div class="hero-content"> <!-- hero content container -->
            <p class="hero-eyebrow">Welcome to</p> <!-- a small introductory text above the main title -->
            <h1>
                <span class="white-text">UrbanPulse </span>
                <span class="gold-text">Dynamics</span>
            </h1>
            <p class="hero-slogan">"Architecting the Intelligence of Tomorrow's Cities"</p>
            <p class="hero-company-description">
                The future of UrbanPulse dynamics is data driven. At noble strategic, we specialise
                in orchestrating the digital transformation of modern cities. Our consultancy empowers 
                self optimising transit networks to real-time energy analytics. We don't just plan
                infrastructure, we engineer the intellegnce that brings cities to life.
                <!-- ai generated description only -->
            </p>

            <div class="hero-buttons"> 
                <a href="../Jobs/jobs.html" class="btn-gold">Discover More</a>
                <a href="../Apply/Apply.html" class="btn-outline">Apply Now</a>
            </div>
        </div>

        <div class="hero-image">
            <img src="../images/CityImage.jpeg" alt="City Skyline at Night">
        </div>
    </section>

    <section class ="jobs-section">
        <h2>Current <span class="gold-text">Job Listings</span></h2>
        <table class="jobs-table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Salary</th>
                    <th>Reports To</th>
                    <th>Location</th>
                    <th>Job Type</th>
                    <th>Apply By</th>
                </tr>
            </thead>
        <tbody>
            <tr>
                <td>Smart Transport Systems Developer</td>
                <td>$85,000 - $100,000</td>
                <td>Senior Smart City Solutions Manager</td>
                <td rowspan="2">Melbourne, VIC</td> <!-- merged location for two jobs -->
                <td>Full-Time</td>
                <td>30 April 2026</td>
            </tr>
            <tr>
                <td>Energy Monitoring Platform Engineer</td>
                <td>$90,000 - $110,000</td>
                <td>Head of Urban Digital Services</td>
                <td>Full-Time</td>
                <td>30 April 2026</td>
            </tr>
        </tbody>
        </table>
    </section>

    
<footer class="footer"> <!-- footer section -->
    <div class="footer-inner"> <!-- container for footer content -->

        <div class="footer-brand">
            <img src="../images/UrbanPulseDynamicslogo.png" alt="UrbanPulse Dynamics Logo">
            <div>
                <p class="footer-name">UrbanPulse Dynamics</p>
                <p class="footer-tagline">Architecting the Intelligence of Tomorrow's Cities</p>
            </div>
        </div>
        <div class="footer-contact">
            <p> &copy; 2026 UrbanPulse Dynamics    <a href="https://lamiaahmedkhan.atlassian.net/jira/software/projects/WTP1/boards/3/backlog">Jira Project </a>|
            <a href="https://github.com/Skelelord/WebCraftersProject">GitHub Repository </a>|
            <a href="mailto:info@urbanpulsedynamics.com">Contact Us</a>
        </p>
        </div>
    </div>
</footer>

</body>
</html>