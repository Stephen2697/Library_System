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

    //Create Error Response Messages:
    $usernameError = $passwordError = $firstnameError = $surnameError = $address1Error = $address2Error = $cityError = $mobileError = $telephoneError = " ";

    //define & initiliase variables which store user input
    $usernameEntry = $passwordEntry = $firstnameEntry = $surnameEntry = $address1Entry = $address2Entry = $cityEntry = $mobileEntry = $telephoneEntry = "";
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
         
        
        if (empty($_POST["userName"])) 
        {
            $usernameError = "A Unique User Name is Required";
            
        } //end if
        
        else 
        {
            
            //$usernameEntry = test_input($_POST["userName"]);
            $usernameEntry = mysqli_real_escape_string($connection, test_input($_POST["userName"]));
            
        } //end else
        
        if (empty($_POST["password"])) 
        {
            $passwordError = "A 6 Digit Password is Required";
            
        } //end if
        
        else 
        {
            
            $passwordEntry =  mysqli_real_escape_string($connection,test_input($_POST["password"]));
            
        } //end else
        
        if (empty($_POST["firstName"])) 
        {
            $firstnameError = "Please Enter Your Firstname";
            
        } //end if
        
        else 
        {
            
            $firstnameEntry =  mysqli_real_escape_string($connection,test_input($_POST["firstName"]));
            
        } //end else
        
        if (empty($_POST["secondName"])) 
        {
            $surnameError = "Please Enter Your Surname";
            
        } //end if
        
        else 
        {
            
            $surnameEntry =  mysqli_real_escape_string($connection,test_input($_POST["secondName"]));
            
        } //end else
        
        if (empty($_POST["addressLine1"])) 
        {
            $address1Error = "Please Enter Line One of your Address";
            
        } //end if
        
        else 
        {
            
            $address1Entry =  mysqli_real_escape_string($connection,test_input($_POST["addressLine1"]));
            
        } //end else
        
        if (empty($_POST["addressLine2"])) 
        {
            $address2Error = "Please Enter Line Two of your Address";
            
        } //end if
        
        else 
        {
            
            $address2Entry =  mysqli_real_escape_string($connection,test_input($_POST["addressLine2"]));
            
        } //end else
        
        if (empty($_POST["cityName"])) 
        {
            $cityError = "Please Enter the Name of your City";
            
        } //end if
        
        else 
        {
            
            $cityEntry =  mysqli_real_escape_string($connection,test_input($_POST["cityName"]));
            
        } //end else
        
        if (empty($_POST["mobilePhone"])) 
        {
            $mobileError = "Please Enter a 10 digit Mobile Phone Number";
            
        } //end if
        
        else 
        {
            
            $mobileEntry =  mysqli_real_escape_string($connection,test_input($_POST["mobilePhone"]));
            
        } //end else
        
        if (empty($_POST["telephone"])) 
        {
            $telephoneError = "Please Enter a Telephone Number";
            
        } //end if
        
        else 
        {
            
            $telephoneEntry =  mysqli_real_escape_string($connection,test_input($_POST["telephone"]));
            
        } //end else
        
        
        //store the SQL query we wish to make
        $SQL_Query = "INSERT INTO USERS (userName , userPassword, firstName, secondName, addressLine1, addressLine2, cityName, telephone, mobilePhone) VALUES ('$usernameEntry','$passwordEntry', '$firstnameEntry', '$surnameEntry', '$address1Entry' , '$address2Entry', '$cityEntry', '$telephoneEntry', '$mobileEntry')";

        
        if ($connection->query($SQL_Query) == TRUE)
        {
            echo "New record created successfully";
        }
        
        else
        {
            echo "New record NOT created";
        }

        
        //check successful
        $SQL_Query = "SELECT userName , userPassword FROM USERS";
        //assign the return of this query when we apply the query
        $Query_Return = $connection->query($SQL_Query);
        
        //Standard check if there are any rows in the database tables we have selected - this is partially redundant as Table data is controlled behind the scenes but good practise nonetheless.
        if ($Query_Return->num_rows > 0) 
        {
            //iterate between each row of the two columns we currently have access to - (usernames and passwords)
            while($row = $Query_Return->fetch_assoc()) 
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
            
            
        } //end if
    } //end if

    //Implement Data sanitisation, validation and security using built in php functions
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
      
        return $data;
    } //end test_input

  $connection->close(); 

?>


<html>
    <hr><br><h1>Register</h1>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        
    Your New Username: <br>
    <input type="text" name="userName" value="<?php echo $usernameEntry;?>">
    <span class="error">* <?php echo $usernameError;?></span>
    <br><br>
        
    Your New Password: <br>
    <input type="password" name="password" value="<?php echo $passwordEntry;?>">
    <span class="error">* <?php echo $passwordError;?></span>
    <br><br>
        
    Firstname: <br>
    <input type="text" name="firstName" value="<?php echo $firstnameEntry;?>">
    <span class="error">* <?php echo $firstnameError;?></span>
    <br><br>
        
    Surname: <br>
    <input type="text" name="secondName" value="<?php echo $surnameEntry;?>">
    <span class="error">* <?php echo $surnameError;?></span>
    <br><br>
        
    Address Line 1: <br>
    <input type="text" name="addressLine1" value="<?php echo $address1Entry;?>">
    <span class="error">* <?php echo $address1Error;?></span>
    <br><br>
        
    Address Line 2: <br>
    <input type="text" name="addressLine2" value="<?php echo $address2Entry;?>">
    <span class="error">* <?php echo $address2Error;?></span>
    <br><br>
        
    City: <br>
    <input type="text" name="cityName" value="<?php echo $cityEntry;?>">
    <span class="error">* <?php echo $cityError;?></span>
    <br><br>
        
    Mobile Phone: <br>
    <input type="text" name="mobilePhone" value="<?php echo $mobileEntry;?>">
    <span class="error">* <?php echo $mobileError;?></span>
    <br><br>
        
    Telephone: <br>
    <input type="text" name="telephone" value="<?php echo $telephoneEntry;?>">
    <span class="error">* <?php echo $telephoneError;?></span>
    <br><br>
        
    <input type="submit" name="Register" value="Submit"> 

    </form>


</html>