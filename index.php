<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="rfid.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Login</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .foutmelding {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="field input">
                    <label for="Password">Password</label>
                    <input type="password" name="Password" id="Password" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>
                <div class="links">
                    Don't have an account?  <a href="#">Sign Up Now</a>
                </div>
            </form>
            <?php
            $foutmelding = ""; // Initialize error message

            if(isset($_POST["submit"])){
                $naam = $_POST['username']; // Correct the input name to match HTML form
                $wachtwoord = $_POST['Password']; // Correct the input name to match HTML form
                
                // Create connection
                $conn = new mysqli("localhost", "root", "", "ilkay");
                
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Prepare a SQL statement
                $sql = "SELECT * FROM ilkay WHERE naam=? AND wachtwoord=?";
                $stmt = $conn->prepare($sql);
                
                // Bind parameters
                $stmt->bind_param("ss", $naam, $wachtwoord);
                
                // Execute the statement
                $stmt->execute();
                
                // Get the result
                $result = $stmt->get_result();
                
                // Check if there are any rows returned
                if ($result->num_rows > 0) {

                    // Redirect to home page
                    header("Location: https://localhost/oefening/home.php");
                    exit; // Ensure that no more output is sent
                } else {
                    $foutmelding = "Fout met inloggen";
                }
                
                // Close the statement
                $stmt->close();
                }
            ?>
            <?php if (!empty($foutmelding)): ?>
                <div class="foutmelding"><?php echo $foutmelding; ?></div>
            <?php endif; ?>
        </div> 
    </div>
</body>
</html>
