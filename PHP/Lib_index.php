
<?php
    //include("Connect_To_DB.php");
    $servername = "192.168.64.2";
    $username = "Stephen";
    $password = "CONNECT";
    $database = "Library";

    // Create connection
    $connection = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }


    echo "Connected to Database Successfully - User: $username - Database: $database - Server: $servername <br><hr>";


    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // define variables and set to empty values
        $usernameEntry = $passwordEntry = "";
        
        $usernameEntry = test_input($_POST["userName"]);
        $passwordEntry = test_input($_POST["password"]);
        
        //initialise returns
        $row["userName"] = ' ';
        $rowB["userPassword"] = ' ';
        
        $VerifiedUser = false;
        $SQL_QueryOne = "SELECT userName , userPassword FROM USERS";

        $Query_ReturnOne = $connection->query($SQL_QueryOne);
        
        if ($Query_ReturnOne->num_rows > 0) 
        {
            while($row = $Query_ReturnOne->fetch_assoc()) 
            {
                $realPassword = $row["userPassword"];
                $realUsername= $row["userName"];
                
                if (strcmp($usernameEntry, $realUsername)==0 && strcmp($passwordEntry, $realPassword)==0)
                {
                    $VerifiedUser = true;
                    echo "WELCOME- $usernameEntry";
                } //end if
                
                
                echo ("TABLE: NAME [$realUsername] - PASS [$realPassword]<br>");
                    
            }//end while
            
            if ($VerifiedUser == false)
            {
                echo "<br>WRONG: $usernameEntry && $passwordEntry ARE INCORRECT.<br>";
            }
        } //end if
    } //end if

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>


<html>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    Username: 
    <input type="text" name="userName">
    <br><br>
    Password:
    <input type="password" name="password">
    <br><br>
    <input type="submit" name="Login" value="Submit"> 

    </form>


</html>