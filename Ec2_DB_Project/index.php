<?php

$servername = "YOUR-RDS-ENDPOINT";
$username   = "admin";
$password   = "YOUR-RDS-PASSWORD";
$dbname     = "guestbook";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $message = $conn->real_escape_string($_POST['message']);
    $conn->query("INSERT INTO entries (name, message) VALUES ('$name', '$message')");
    $success = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>☁️ Unlox- Cloud/Devops Course Feedback Form </title>
    <style>
        body { font-family: Arial, sans-serif; background:#f4f6f9; margin:0; }
        .container { max-width:700px; margin:40px auto; background:#fff; padding:20px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
        input, textarea { width:100%; margin:10px 0; padding:10px; border-radius:5px; border:1px solid #ccc; }
        button { background:#0073e6; color:white; padding:10px 15px; border:none; border-radius:5px; cursor:pointer; margin-top:10px; }
        button:hover { background:#005bb5; }
        .alert { background:#d4edda; color:#155724; padding:12px; border-radius:5px; margin-bottom:15px; border:1px solid #c3e6cb; }
        .messages-section { margin-top:30px; padding-top:15px; border-top:2px solid #eee; }
        .messages { margin-top:15px; max-height:0; overflow:hidden; transition:max-height 0.5s ease-out, padding 0.3s; }
        .messages.show { max-height:1000px; padding:10px 0; }
        .message-card { background:#f9f9f9; border:1px solid #ddd; border-radius:5px; padding:10px; margin-bottom:10px; }
        .message-card strong { color:#0073e6; }
    </style>
</head>
<body>
    <div class="container">
        <h1>☁️ Cloud Guestbook</h1>
        
        <?php if ($success): ?>
            <div class="alert">✅ Message added successfully!</div>
        <?php endif; ?>

        <!-- Form Section -->
        <form method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <textarea name="message" placeholder="Write your message..." required></textarea>
            <button type="submit">Submit</button>
        </form>

        <!-- Messages Section -->
        <?php if ($success): ?>
        <div class="messages-section">
            <p><strong>Message stored and then retrieved from the DB:</strong></p>
            <button id="toggleMessages">📜 View Messages</button>

            <div class="messages" id="messagesSection">
                <h2>📜 Messages</h2>
                <?php
                $result = $conn->query("SELECT name, message, created_at FROM entries ORDER BY created_at DESC");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='message-card'>
                                <strong>" . htmlspecialchars($row['name']) . "</strong><br>" .
                                htmlspecialchars($row['message']) . "<br>
                                <small><i>" . $row['created_at'] . "</i></small>
                              </div>";
                    }
                } else {
                    echo "<p>No messages yet.</p>";
                }
                ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script>
    const toggleBtn = document.getElementById("toggleMessages");
    const msgSection = document.getElementById("messagesSection");

    if (toggleBtn) {
        msgSection.classList.remove("show"); // hidden by default
        toggleBtn.addEventListener("click", function() {
            msgSection.classList.toggle("show");
            if (msgSection.classList.contains("show")) {
                toggleBtn.textContent = "❌ Hide Messages";
            } else {
                toggleBtn.textContent = "📜 View Messages";
            }
        });
    }
    </script>
</body>
</html>

