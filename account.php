<?php

session_start();

$login_error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once 'database.php';

    $username = $_POST['uname'];
    $password = $_POST['psw'];

    $stmt = $db->prepare(
        "SELECT * FROM Credentials WHERE Username = ?"
    );

    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if ($user && $password === $user['Password']) {

        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['username'] = $user['Username'];

        header("Location: loggedIn.html");
        exit;

    } else {

        $login_error = "Incorrect username or password.";

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
    <!--Position of the logo-->
		<div class="logo">
		  <a href="index.html"><img class="logo-pic" src="images/Logo.png" alt="TrustedHouseSitters"></a>
		</div>
		
		<!--Section header footer creates a brown background-->
		<section class="header-footer">	
			<br>		
			<div class="navbar">
                <div class="nav-buttons"><button type="button" onclick="document.location='index.html'">Home</button></div>
                <div class="nav-buttons"><button type="button" onclick="document.location='HouseSitters.html'">House sitters</button></div>
                <div class="nav-buttons"><button type="button" onclick="document.location='contact.html'">Contact</button></div>
                <div class="nav-buttons"><button type="button" onclick="document.location='about.html'">About us</button></div>
			</div>
		</section>

        <div class="account">
		    <a href="account.php"><img class="icon" src="images/icon.png" alt="Account"></a>
		</div>

        <div class="banner-box">
            <img class="banner" src="images/bannerAccount.png" alt="Banner">
            <div class="banner-text">
                <h1>Account</h1>
            </div>
        </div>

        <form action="account.php" method="POST">
            <table class="table-center cell-form">
                <tr class="align-left">
                    <td><label for="uname"><b>Username</b></label><br><input class="login-box" type="text" id="uname" placeholder="Enter Username" name="uname" required></td>
                </tr>
                <td><br></td>
                <tr class="align-left">
                    <td><label for="psw"><b>Password</b></label><br><input class="login-box" type="password" id="psw" placeholder="Enter Password" name="psw" required></td>
                </tr>
                <td><br></td>
                <tr class="align-left">
                    <td>
                        <button type="submit">Login</button>
                        <?php if ($login_error): ?>
                            <p class="login-error"><?php echo $login_error; ?></p>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </form>
    </body>
    <footer class="header-footer">
        <table class="socials">
            <tr>
                <td><a href="https://www.instagram.com"><img class="socials-img" src="images/instagram.jpg" alt="Instagram"></a></td>
                <td><a href="https://www.facebook.com"><img class="socials-img" src="images/facebook.jpg" alt="Facebook"></a></td>
            </tr>
        </table>
    </footer>
</html>