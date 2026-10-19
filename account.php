<?php

// Start the session
session_start();

$login_error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Include the database connection
    require_once 'database.php';

    // Get the submitted username and password and store in their individual variables
    $username = $_POST['uname'];
    $password = $_POST['psw'];

    // Prepare and execute the SQL statement to fetch the user from the database
    $stmt = $db->prepare(
        "SELECT * FROM Credentials WHERE Username = ?"
    );

    // Execute the statement with the provided username
    $stmt->execute([$username]);

    // Fetch the user data
    $user = $stmt->fetch();

    // Check if the user exists and the password matches
    if ($user && $password === $user['Password']) {

        // Store user information in session variables
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['username'] = $user['Username'];

        // Send user to the logged-in page
        header("Location: loggedIn.html");
        exit;

    } else {

        // If the username or password is incorrect, set an error message
        $login_error = "Invalid username or password.";

    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trusted House sitters</title>
        <link rel="stylesheet" href="style.css">
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Sora' rel='stylesheet'>
    </head>
    <body>
    <!--Logo in the top left corner-->
		<div class="logo">
		  <a href="index.html"><img class="logo-pic" src="images/Logo.png" alt="TrustedHouseSitters"></a>
		</div>

		<!--Account icon in the top right corner-->
		<div class="account">
		    <a href="account.php"><img class="icon" src="images/icon.png" alt="Account"></a>
		</div>

		<!--Section header footer creates a blue background-->
		<section class="header-footer">	
			<br>	
            <!--Navigation bar with buttons to different pages-->	
			<div class="navbar">
                <div class="nav-buttons"><button type="button" onclick="document.location='index.html'">Home</button></div>
                <div class="nav-buttons"><button type="button" onclick="document.location='houseSitters.html'">House sitters</button></div>
                <div class="nav-buttons"><button type="button" onclick="document.location='contact.html'">Contact</button></div>
                <div class="nav-buttons"><button type="button" onclick="document.location='about.html'">About us</button></div>
			</div>
		</section>

        <div class="account-header">
            <h1>Account</h1>
        </div>

        <!--Login form-->
        <form action="account.php" method="POST">
            <table class="table-center cell-form">
                <tr class="align-left">
                    <!-- Username input field -->
                    <td><label for="uname"><b>Username</b></label><br><input class="login-box" type="text" id="uname" placeholder="Enter Username" name="uname" required></td>
                </tr>
                <td><br></td>
                <tr class="align-left">
                    <!-- Password input field -->
                    <td><label for="psw"><b>Password</b></label><br><input class="login-box" type="password" id="psw" placeholder="Enter Password" name="psw" required></td>
                </tr>
                <td><br></td>
                <tr class="align-left">
                    <td>
                        <!-- Submit button for the login form -->
                        <button type="submit">Login</button>
                        <!-- Display login error message if applicable -->
                        <?php if ($login_error): ?>
                            <p class="login-error"><?php echo $login_error; ?></p>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </form>
    </body>
    <!--Footer section with social media links-->
    <footer>
        <section class="header-footer">
            <div class="footer">
                <div class="socials">
                    <table>
                        <tr>
                            <td><a href="https://www.instagram.com"><img class="socials-img" src="images/instagram.jpg" alt="Instagram"></a></td>
                            <td><a href="https://www.facebook.com"><img class="socials-img" src="images/facebook.jpg" alt="Facebook"></a></td>
                        </tr>
                    </table>
                </div>
                <div class="footer-links">
                    <table class="footer-table">
                        <tr>
                            <td><a href="index.html">Home</a></td>
                            <td><a href="houseSitters.html">House sitters</a></td>
                            <td><a href="contact.html">Contact</a></td>
                            <td><a href="about.html">About us</a></td>
                        </tr>
                    </table>
                </div>
                <div class="footer-text">
                    <p>© 2024 Trusted House Sitters. All rights reserved.</p>
                </div>
            </div>
        </section>
    </footer>
</html>