<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Homepage of UrbanPulse Dynamics">
    <meta name="keywords" content="UrbanPulse Dynamics, smart city, urban, consultancy, technology, innovation">
    <meta name="author" content="Dorar Alodhailah">
    <title>UrbanPulse Dynamics</title>
    <link rel="stylesheet" href="CSS/Main.css">
    <link rel="icon" href="images/UrbanPulseDynamicslogo.png"> <!-- ai generated logo -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        .hero { /* hero section */
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
    <?php include 'include/header_index.inc'; ?>
    
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

    
<?php include 'include/footer.inc'; ?>