<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- sets the character encoding for the document to UTF-8, which supports a wide range of characters and symbols -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- ensures the website is responsive and displays correctly on all devices -->
    <meta name="description" content="Homepage of UrbanPulse Dynamics">
    <meta name="keywords" content="UrbanPulse Dynamics, smart city, urban, consultancy, technology, innovation">
    <meta name="author" content="Dorar Alodhailah">
    <title>UrbanPulse Dynamics</title>
    <link rel="stylesheet" href="CSS/Main.css"> <!-- links the main CSS file that contains styles for the entire website, ensuring a consistent look and feel across all pages -->
    <link rel="icon" href="images/UrbanPulseDynamicslogo.png"> <!-- ai generated logo -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!-- links the Boxicons library for using a wide range of icons throughout the website, enhancing visual appeal and user experience -->

    <style>
        .hero { /* hero section */
            border-bottom: 3px solid #c9922a; /* adds a gold border at the bottom of the hero section for visual separation */
            align-items: flex-start;
            padding-top: 40px; /* adds extra space at the top of the hero section for better visual balance */
        }
            .hero h1 { /* main title */
                font-size: 52px;
                margin-bottom: 15px; /* adds space below the main title for better separation from the slogan */
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
                line-height: 1.8; /* increases the line height for better readability of the company description */
                max-width: 520px;
                margin-bottom: 30px;
                border-left: 3px solid #c9922a; /* adds a gold vertical line to the left of the company description for visual emphasis */
                padding-left: 16px; /* adds padding to the left of the company description to create space between the text and the vertical line */
            }
    </style> <!-- inline styles specific to the index page, added for quick adjustments without affecting other pages -->


</head>

<body>
    <?php include 'include/header_index.inc'; ?> <!-- includes the header file for the index page, which contains the navigation bar and logo -->
    
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

            <div class="hero-buttons"> <!-- container for the call-to-action buttons in the hero section -->
                <a href="../Jobs/jobs.html" class="btn-gold">Discover More</a>
                <a href="../Apply/Apply.html" class="btn-outline">Apply Now</a>
            </div>
        </div>

        <div class="hero-image"> <!-- container for the hero image, which is a city skyline at night to visually represent the concept of a smart city -->
            <img src="images/CityImage.jpeg" alt="City Skyline at Night">
        </div>
    </section>

    <section class ="jobs-section"> <!-- section for displaying current job listings, added to the index page to immediately engage visitors with available opportunities -->
        <h2>Current <span class="gold-text">Job Listings</span></h2>
        <table class="jobs-table"> <!-- table to display job listings in a structured format -->
            <thead> <!-- table header defining the columns for job listings -->
                <tr>
                    <th>Job Title</th>
                    <th>Salary</th>
                    <th>Reports To</th>
                    <th>Location</th>
                    <th>Job Type</th>
                    <th>Apply By</th>
                </tr>
            </thead>
        <tbody> <!-- table body containing the actual job listings, with two example positions that are relevant to the company's focus on smart city solutions -->
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

    
<?php include 'include/footer.inc'; ?> <!-- includes the footer file, which contains contact information and social media links, ensuring consistency across all pages of the website -->