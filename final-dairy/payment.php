<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";  // Replace with your database username
        $password = "";      // Replace with your database password
        $dbname = "dairy";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $cardname = $_POST['cardname'];
        $cardnumber = $_POST['cardnumber'];
        $expmonth = $_POST['expmonth'];
        $expyear = $_POST['expyear'];
        $cvv = $_POST['cvv'];

        $sql = "INSERT INTO payments (firstname, email, address, city, state, zip, cardname, cardnumber, expmonth, expyear, cvv)
        VALUES ('$firstname', '$email', '$address', '$city', '$state', '$pincode', '$cardname', '$cardnumber', '$expmonth', '$expyear', '$cvv')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Order payment successful');
                    window.location.href='success.php?firstname=$firstname&email=$email&address=$address&city=$city&state=$state&pincode=$pincode&cardname=$cardname&cardnumber=$cardnumber&expmonth=$expmonth&expyear=$expyear&cvv=$cvv';
                  </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>