<?php
// XAMPP: create the database "tech_talk" in phpMyAdmin first.
$servername = "localhost";
$username = "root";
$password = "";
$database = "tech_talk";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed. Check your XAMPP MySQL settings.");
}
$conn->set_charset("utf8mb4");

// Create the table if it does not exist.
$conn->query("CREATE TABLE IF NOT EXISTS registrations (
    stuID INT AUTO_INCREMENT PRIMARY KEY,
    stuNAME VARCHAR(120) NOT NULL,
    stuEMAIL VARCHAR(190) NOT NULL,
    stuNUMBER VARCHAR(30) NOT NULL,
    stuDEPARTMENT VARCHAR(150) NOT NULL,
    stuREASON TEXT NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submitform"])) {
    $stuNAME = trim($_POST["stuNAME"] ?? "");
    $stuEMAIL = trim($_POST["stuEMAIL"] ?? "");
    $stuNUMBER = trim($_POST["stuNUMBER"] ?? "");
    $stuDEPARTMENT = trim($_POST["stuDEPARTMENT"] ?? "");
    $stuREASON = trim($_POST["stuREASON"] ?? "");

    if ($stuNAME === "" || !filter_var($stuEMAIL, FILTER_VALIDATE_EMAIL)
        || $stuNUMBER === "" || $stuDEPARTMENT === "" || $stuREASON === "") {
        header("Location: index.php?status=invalid");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO registrations
        (stuNAME, stuEMAIL, stuNUMBER, stuDEPARTMENT, stuREASON)
        VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        error_log($conn->error);
        header("Location: index.php?status=error");
        exit;
    }

    $stmt->bind_param("sssss", $stuNAME, $stuEMAIL, $stuNUMBER, $stuDEPARTMENT, $stuREASON);
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: index.php?status=success");
        exit;
    }

    error_log($stmt->error);
    $stmt->close();
    header("Location: index.php?status=error");
    exit;
}

// Load records to display in index.php.
$registrations = [];
$result = $conn->query("SELECT stuID, stuNAME, stuEMAIL, stuNUMBER,
    stuDEPARTMENT, stuREASON FROM registrations ORDER BY stuID DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $registrations[] = $row;
    }
    $result->free();
}
?>
