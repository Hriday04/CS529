<?php
session_start();
require 'db.php';
$projects = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
$experiences = $conn->query("SELECT * FROM experience ORDER BY start_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Hriday Raj</title>
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div id="particles-js"></div>

    <header>
        <div class="links">
            <a href="https://github.com/Hriday04/Hriday04.github.io" target="_blank">
                <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="GitHub" width="20">
                GitHub
            </a>
            <a href="https://linkedin.com/in/hridayraj" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt="LinkedIn" width="20">
                LinkedIn
            </a>
            <a href="https://docs.google.com/document/d/1Cbm7mj-tb3KaA7aNEvSaHptxa1bw0266vUUhpjlyewY/edit?tab=t.0" download="https://docs.google.com/document/d/1Cbm7mj-tb3KaA7aNEvSaHptxa1bw0266vUUhpjlyewY/edit?tab=t.0">Resume</a>
        </div>
        <nav>
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#experience">Experience</a>
            <a href="#projects">Projects</a>
            <a href="#education">Education</a>
        </nav>
        <?php if (!isset($_SESSION['role'])): ?>
            <a href="/github/login.php" class="resume-button" style="margin-left: 1rem;">Login</a>

        <?php elseif ($_SESSION['role'] === 'admin'): ?>
            <a href="/github/admin/dashboard.php" class="resume-button" style="margin-left: 1rem;">Admin Dashboard</a>
            <a href="/github/logout.php" class="resume-button" style="margin-left: 1rem;">Logout</a>

        <?php else: ?>
            <a href="/github/logout.php" class="resume-button" style="margin-left: 1rem;">Logout</a>
        <?php endif; ?>




        <div class="menu-icon" onclick="toggleMenu()">☰</div>
    </header>
    
    <section id="home" class="intro">
        <h1>Hello, I'm <span>Hriday.</span></h1>
        <p>Currently pursuing a Data Science and Computer Science double major and a Computer Science Masters.</p>
        <a class="resume-button" href="https://docs.google.com/document/d/1Cbm7mj-tb3KaA7aNEvSaHptxa1bw0266vUUhpjlyewY/edit?tab=t.0" download="https://docs.google.com/document/d/1Cbm7mj-tb3KaA7aNEvSaHptxa1bw0266vUUhpjlyewY/edit?tab=t.0">View Resume</a>
    </section>

    <div id="about" class="about-skills">
        <div class="about">
            <img src="images/football.jpeg" alt="Personal Image" class="about-image">
            <h2>About Me</h2>
            <p>
                Hello! My name is Hriday Raj and I am a student-athlete (Football) at Willamette University with experience in AI, Machine Learning, and Data Visualization. I’m passionate about solving problems with technology, whether it's through building recommender systems or visualizing complex datasets.
            </p>
        </div>
        <div class="skills">
            <div class="skill">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c3/Python-logo-notext.svg" alt="Python">
            </div>
            <div class="skill">
                <img src="images/R_logo.png" alt="R Logo">
            </div>
            <div class="skill">
                <img src="images/SQL_DB_logo.png" alt="SQL Logo">
            </div>
            <div class="skill">
                <img src="images/C_Logo.png" alt="C Logo">
            </div>
            <div class="skill">
                <img src="images/reactjs_logo.png" alt="React Logo">
            </div>
            <div class="skill">
                <img src="images/Git_logo.png" alt="Git Logo">
            </div>
            <div class="skill">
                <img src="images/Jira_Logo.png" alt="Jira Logo">
            </div>
            <div class="skill">
                <img src="images/Confluence_Logo.png" alt="Confluence Logo">
            </div>
            <div class="skill">
                <img src="images/powerpoint.png" alt="PowerPoint Logo">
            </div>
            <div class="skill">
                <img src="images/Excel-Logo.png" alt="Excel Logo">
            </div>
        </div>
    </div>



    <section id="experience" class="experience">
        <h2>Experience</h2>
        <div class="experience-list">
            <?php if ($experiences->num_rows > 0): ?>
            <?php while($exp = $experiences->fetch_assoc()): ?>
                <div class="experience-item">
                <h3><?= htmlspecialchars($exp['title']) ?> – <?= htmlspecialchars($exp['company']) ?></h3>
                <p><em><?= htmlspecialchars($exp['start_date']) ?> - <?= htmlspecialchars($exp['end_date']) ?> | <?= htmlspecialchars($exp['location']) ?></em></p>
                <p><?= nl2br(htmlspecialchars($exp['description'])) ?></p>
                </div>
            <?php endwhile; ?>
            <?php else: ?>
            <p>No experience added yet.</p>
            <?php endif; ?>
        </div>
    </section>

    <section id="projects" class="projects">
        <h2>Projects</h2>
            <div class="project-list">
                <?php if ($projects->num_rows > 0): ?>
                <?php while($row = $projects->fetch_assoc()): ?>
                    <div class="project-item">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                    <?php if ($row['link_code']): ?>
                        <a href="<?= htmlspecialchars($row['link_code']) ?>" target="_blank">View Code</a>
                    <?php endif; ?>
                    <?php if ($row['link_demo']): ?>
                        <a href="<?= htmlspecialchars($row['link_demo']) ?>" target="_blank">Live Demo</a>
                    <?php endif; ?>
                    </div>
                <?php endwhile; ?>
                <?php else: ?>
                <p>No projects available right now. Check back soon!</p>
                <?php endif; ?>
            </div>
    </section>
    <section id = "education" class="education">
        <h2>Education</h2>
        <div class="education-list">
            <div class="education-item">
                <h3>Willamette University</h3>
                <p>Aug 2022 - Aug 2025</p>
                <p>
                    <strong>Degrees:</strong> M.S. Computer Science | B.S. Computer Science | B.S. Data Science | Minor in Mathematics and Statistics
                </p>
                <p>
                    <strong>Activities:</strong> NCAA Division III Football, Statistics Teacher’s Assistant, Peer Tutor
                </p>
                
            </div>        
            <img src="images/prom.jpg" alt="Willamette Grad Photo" class="education-image">

        </div>
    </section>
    <section id="contact" class="contact">
        <h2>Contact Me</h2>
        <p>If you'd like to connect or have any questions, feel free to reach out!</p>
        <?php if (isset($_GET['message']) && $_GET['message'] === 'sent'): ?>
            <p class="success-msg" style="text-align: center; margin-bottom: 1.5rem;">
                Your message has been sent successfully. I’ll get back to you soon!
            </p>
        <?php endif; ?>

        <form action="/github/contact.php" method="POST" class="contact-form">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required placeholder="Your Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Your Email">
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required placeholder="Subject">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required placeholder="Your Message"></textarea>
            </div>
            <button type="submit" class="submit-button">Send Message</button>
        </form>
        
    </section>

    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>

    <script src="scripts.js"></script>
    <script src="particles-config.js"></script>
</body>
</html>
