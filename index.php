<?php
require_once "controller.php";
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
$status = $_GET["status"] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechTalk 2026 | Registration</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .notice { padding:12px 16px; margin:18px 0; border-radius:8px; }
        .success { background:#123d31; color:#b8ffe5; }
        .error { background:#4a2028; color:#ffd5dc; }
        .records { margin:35px 0; overflow-x:auto; }
        .records h2 { color:#00d9ff; margin-bottom:15px; }
        .records table { width:100%; border-collapse:collapse; min-width:720px; }
        .records th,.records td { border:1px solid #263e63; padding:12px; text-align:left; }
        .records th { background:#102343; color:#00d9ff; }
        .records td { color:#d7e6fa; }
    </style>
</head>
<body>
<div class="container">
    <nav>
        <h2 class="logo">TECH<span>TALK.</span></h2>
        <p>2026 D' INFOSYNC</p>
    </nav>

    <?php if ($status === "success"): ?>
        <p class="notice success">Registration saved successfully!</p>
    <?php elseif ($status === "invalid"): ?>
        <p class="notice error">Please complete all fields and enter a valid email address.</p>
    <?php elseif ($status === "error"): ?>
        <p class="notice error">Registration could not be saved. Please try again.</p>
    <?php endif; ?>

    <section class="content">
        <div class="event-info">
            <p class="tag">● UPCOMING TECHNOLOGY EVENT</p>
            <h1>THE FUTURE<br>IS <span>NOW.</span></h1>
            <p class="description">Discover the latest innovations, explore emerging
            technologies, and connect with the future. Join us for an inspiring technology talk!</p>
            <div class="event-details">
                <div><h3>DATE</h3><p>November 21, 2026</p></div>
                <div><h3>LOCATION</h3><p>N/A</p></div>
            </div>
        </div>

        <div class="form-box" id="registrationBox">
            <h2>REGISTER NOW</h2>
            <p class="subtitle">Secure your spot at TechTalk 2026.</p>
            <form id="registrationForm" action="index.php" method="POST">
                <label for="stuNAME">Full Name</label>
                <input id="stuNAME" type="text" name="stuNAME" placeholder="Enter your full name" maxlength="120" required>

                <label for="stuEMAIL">Email Address</label>
                <input id="stuEMAIL" type="email" name="stuEMAIL" placeholder="Enter your email" maxlength="190" required>

                <label for="stuNUMBER">Contact Number</label>
                <input id="stuNUMBER" type="tel" name="stuNUMBER" placeholder="Enter your phone number" maxlength="30" required>

                <label for="stuDEPARTMENT">Department</label>
                <input id="stuDEPARTMENT" type="text" name="stuDEPARTMENT" placeholder="Enter your school or organization" maxlength="150" required>

                <label for="stuREASON">Why do you want to join?</label>
                <textarea id="stuREASON" name="stuREASON" placeholder="Tell us something about yourself..." rows="3" maxlength="2000" required></textarea>

                <button type="submit" name="submitform">COMPLETE REGISTRATION →</button>
            </form>
            <p class="privacy">By registering, you agree to participate in our event.</p>
        </div>
    </section>

    <section class="records">
        <h2>REGISTERED PARTICIPANTS</h2>
        <table>
            <thead>
                <tr>
                    <th>stuID</th><th>stuNAME</th><th>stuEMAIL</th>
                    <th>stuNUMBER</th><th>stuDEPARTMENT</th><th>stuREASON</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($registrations)): ?>
                <?php foreach ($registrations as $student): ?>
                    <tr>
                        <td><?= e($student["stuID"]) ?></td>
                        <td><?= e($student["stuNAME"]) ?></td>
                        <td><?= e($student["stuEMAIL"]) ?></td>
                        <td><?= e($student["stuNUMBER"]) ?></td>
                        <td><?= e($student["stuDEPARTMENT"]) ?></td>
                        <td><?= e($student["stuREASON"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">No registrations yet.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </section>

    <footer>
        <p>© 2026 TECHTALK - D 'INFOSYNC'. ALL RIGHTS RESERVED.</p>
        <p>INNOVATE. CONNECT. INSPIRE.</p>
    </footer>
</div>
</body>
</html>
