<!DOCTYPE html>
<html lang="en" title="Apply Page">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8" />
  <meta name="description" content="Apply for job" />
  <meta name="keywords" content="HTML5, CSS layout" />
  <meta name="author" content="Christopher"  />
  <title>CSS Layout</title>
  <!-- References to external CSS files -->
 <!--<link rel = "stylesheet" type = "text/CSS" href = "/../CSS/ApplyPage.css"></link>--> 
<link rel = "stylesheet" type = "text/CSS" href = "../CSS/ApplyPage.css">
<link rel = "stylesheet" type = "text/CSS" href = "../CSS/Main.css">

<body>
    <header>
    <div class="nav-logo">
            <img src="../images/UrbanPulseDynamicslogo.png" alt="UrbanPulse Dynamics Logo" style="margin-right: 10px;">
                <div>
                    <span class="logo-main">UrbanPulse</span>
                    <span class="logo-sub">Dynamics</span>
                </div>
        </div>
        <nav>
            <a href="../Index/index.html">HOME</a>
            <a href="../Jobs/jobs.html">JOBS</a>
            <a href="../Apply/Apply.html" class = "nav-link active">APPLY</a>
            <a href="../About/about.html">ABOUT</a>
        </nav>
</header>
    <main>
        <div  id = "belowheader">
            <h1>Apply With <span class = "colorchange">Us</span></h1>
            <p><em>"We are a great company to work for."</em></p>
        </div>
        
        <div class = "ExpressionOfInterest">
            <h2>Expression of Interest</h2>
            <form>
                <input></input>
            </form>
        </div>
        <h2>Application form:</h2>
        <div class = "parent_div" id = "formDiv">
        <form action = "Process_eoi.php" method="post">
            <section id = "nav">
            <label for = "jobReferenceNumber">Job reference number:</label>
            <input id = "jobReferenceNumber" name = "jobReferenceNumber" type = "text">
            <br>

            <label for = "firstName">First name:</label>
            <input id = "firstName" name = "firstName" type = "text">
            <br>
            <label for = "lastName">Last name:</label>
            <input id = "lastName" name = "lastName" type = "text">
            <br>

            <label for = "DOB">Date of birth:</label>
            <input id = "DOB" name = "DOB" type = "date">
            <br>
            
            <fieldset>
                <legend>Gender:</legend>
                <input type="radio" name="gender" value="gender">
                <label>Male</label>
                <input type="radio" name="gender" value="gender">
                <label>Female</label>
                <input type="radio" name="gender" value="gender">
                <label>Other</label>
            </fieldset>
            <br>

            <label for = "streetAddress">Street Address:</label>
            <input id = "streetAddress" name = "streetAddress" type = "text">
            <br>

            <label for = "suburbAndTown">Suburb/Town:</label>
            <input id = "suburbAndTown" name = "suburbAndTown" type = "text">
            <br>

            <label for = "state">State:</label>
            <select id = "state" name = "state">
                <option value="" disabled selected>Please choose an option</option>
                <option value="Victoria">VIC</option>
                <option value="NewSouthWales">NSW</option>
                <option value="Tasmania">TAS</option>
                <option value="SouthAustralia">SA</option>
                <option value="WesternAustralia">WA</option>
                <option value="Canberra">ACT</option>
                <option value="Queensland">QLD</option>
                <option value="NorthernTerritory">NT</option>
            </select>
            <br>

            <label for = "postcode">Postcode:</label>
            <input id = "postcode" name = "postcode" type = "text">
            <br>

            <label for = "email">Email:</label>
            <input id = "email" name = "email" type = "email">
            <br>

            <label for = "phoneNumber">Phone number:</label>
            <input id = "phoneNumber" name = "phoneNumber" type = "text">
            <br>
            <fieldset>
                <legend>Skills list:</legend>
                <br>
                <input type="checkbox" id = "communication" name="communication" value="communication">
                <label>Communication</label>
                <input type="checkbox" id = "css" name="css" value="css">
                <label>CSS</label>
                <input type="checkbox" id = "javascript" name="javascript" value="javascript">
                <label>javascript</label>
                <input type="checkbox" id = "php" name="php" value="php">
                <label>PHP</label>
                <input type="checkbox" id = "my_sql" name="my_sql" value="my_sql">
                <label>MySQL</label>
            </fieldset>
            <br>

            <label for = "otherSkills">Other Skills:</label>
            <textarea id = "otherSkills" name = "otherSkills" rows = "4" cols = "30"></textarea>
            <br>

            <input id = "submitButton" type = "submit" value = "submit">
            <input id = "resetButton" type = "reset" value = "reset">
            </section>
        </form>
        </div>
    </main>
    <footer>
        <p> &copy; 2026 UrbanPulse Dynamics <a href="https://lamiaahmedkhan.atlassian.net/jira/software/projects/WTP1/boards/3/backlog">Jira Project</a>|
            <a href="https://github.com/Skelelord/WebCraftersProject">GitHub Repository</a>|
            <a href="mailto:lamiakhanoff@gmail.com">Contact Us</a>
        </p>
    </footer>
</body>
