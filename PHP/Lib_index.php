
<?php
    //include("Connect_To_DB.php");
    $servername = "192.168.64.2";
    $username = "Stephen";
    $password = "CONNECT";
    $database = "Library";

    //Create connection to database
    $connection = mysqli_connect($servername, $username, $password, $database);

    // Check connection to database & deal with it appropriately
    if (!$connection) 
    {
        die("Connection failed: " . mysqli_connect_error());
    } //end if

    //Otherwise provide feedback about connection status
    else 
    {
        echo "Connected to Database Successfully - User: $username - Database: $database - Server: $servername <br><hr>";
    }//end else
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //define variables and initiliase which store user input
        $usernameEntry = $passwordEntry = " ";
        
        //define & initialise variables used to temporaily to check the correct passwords stored in the database
        $realPassword = $realUsername = " ";
        
        //Call proprietary function which deals with data input and assign the returned (cleaned up) data to two variables.
        $usernameEntry = test_input($_POST["userName"]);
        $passwordEntry = test_input($_POST["password"]);
    
        //Declare and assign false to the boolean switch which deals with correct and incorrect user access attempts.
        $VerifiedUser = false;
        
        //store the SQL query we wish to make
        $SQL_QueryOne = "SELECT userName , userPassword FROM USERS";

        //assign the return of this query when we apply the query
        $Query_ReturnOne = $connection->query($SQL_QueryOne);
        
        //Standard check if there are any rows in the database tables we have selected - this is partially redundant as Table data is controlled behind the scenes but good practise nonetheless.
        if ($Query_ReturnOne->num_rows > 0) 
        {
            //iterate between each row of the two columns we currently have access to - (usernames and passwords)
            while($row = $Query_ReturnOne->fetch_assoc()) 
            {
                //take a temporary copy of the corresponding username and password of the selected row.  
                $realPassword = $row["userPassword"];
                $realUsername= $row["userName"];
                
                //implement a simple string compare on the user's validated and sanitised username and password entries and compoare them to the selected row of data.
                if (strcmp($usernameEntry, $realUsername)==0 && strcmp($passwordEntry, $realPassword)==0)
                {
                    //assign true to the boolean switch which deals with correct and incorrect user access attempts.
                    $VerifiedUser = true;
                    //provide user feedback
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

    //Implement Data sanitisation, validation and security using built in php functions
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    } //end test_input

    $connection->close();

?>


<html>
    <hr><br><h1>Login</h1>
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