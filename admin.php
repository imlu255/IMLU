<?php
session_start();
require_once "auth.php";

if (!is_logged_in()) {
    header("Location: index.html");
    exit;
}

if (!has_role("admin",)) {
    echo "You do not have permission to access this page";
    exit;
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Imamia Mission London UK</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            .mid {
                text-align: center;
                align-items: center;
                justify-content: center;
            }

            .mid>.btn {
                width: 200px;
            }
            @media only screen and (min-width: 1480px) and (max-width: 1548px) {
                .navbar-nav {
                    margin-left: 700px;
                }
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Imamia Mission London UK</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./admin.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./View_ECM.php">Committee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./View_Jaloos.php">Jaloos Volunteers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./View_Contact.php">Contact Responses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.html">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <br>
        <div class="mid">
            <form action="send-notification.php" method="post" id="notificationForm">
                <label for="notificationTitle">Title:</label>
                <input type="text" id="notificationTitle" name="title" required>
                <label for="notificationBody">Message:</label>
                <textarea id="notificationBody" name="body" required></textarea>
                <label for="notificationLink">Link:</label>
                <input type="text" id="notificationLink" name="link" required>
                <button type="submit">Send Notification</button>
            </form>

            <script>
                document.getElementById('notificationForm').addEventListener('submit', function(event) {
                    event.preventDefault();
                    const title = document.getElementById('notificationTitle').value;
                    const body = document.getElementById('notificationBody').value;
                    const link = document.getElementById('notificationLink').value;

                    fetch('/send-notification.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ title, body, link })
                    }).then(response => response.json()).then(data => {
                    alert('Notification sent successfully');
                    }).catch(error => {
                    console.error('Error sending notification:', error);
                    });
                });
            </script>
        </div>
        <!-- Firebase App (required) -->
        <script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js"></script>
        <!-- Firebase Cloud Messaging (for push notifications) -->
        <script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script type="module">
            // Import the functions you need from the SDKs you need
            import { initializeApp } from "https://www.gstatic.com/firebasejs/11.3.1/firebase-app.js";
            import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.3.1/firebase-analytics.js";
            // TODO: Add SDKs for Firebase products that you want to use
            // https://firebase.google.com/docs/web/setup#available-libraries

            // Your web app's Firebase configuration
            // For Firebase JS SDK v7.20.0 and later, measurementId is optional
            const firebaseConfig = {
                apiKey: "AIzaSyAY-wqgEluXDTRd8-xTmqizxEyozpss3G0",
                authDomain: "imamia-mission-london-uk-ec4a7.firebaseapp.com",
                projectId: "imamia-mission-london-uk-ec4a7",
                storageBucket: "imamia-mission-london-uk-ec4a7.firebasestorage.app",
                messagingSenderId: "10244547939",
                appId: "1:10244547939:web:990e313b74e0d9a6aa9f56",
                measurementId: "G-3SJX802TPL"
            };

            // Initialize Firebase
            const app = initializeApp(firebaseConfig);
            const analytics = getAnalytics(app);
        </script>
        <script src="script.js"></script>
    </body>
</html>