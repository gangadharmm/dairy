```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/payment.css" />
    <style>
      /* Popup styles */
      .popup {
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
      }
      .popup-content {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
      }
      .popup-content button {
        background: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div class="row">
      <div class="col-75">
        <div class="container">
          <form id="paymentForm">
            <div class="row">
              <div class="col-50">
                <h3>Billing Address</h3>
                <!-- Your billing address fields here -->
              </div>
              <div class="col-50">
                <h3>Payment</h3>
                <!-- Your payment fields here -->
              </div>
            </div>
            <label>
              <input type="checkbox" checked="checked" name="sameadr" />
              Shipping Address same as Billing
            </label>
            <input type="submit" value="Continue to Payment" class="btn" />
          </form>
        </div>
      </div>
    </div>

    <!-- Popup -->
    <div id="popup" class="popup">
      <div class="popup-content">
        <h2>Payment Details</h2>
        <p id="popupMessage"></p>
        <button onclick="window.location.href='main.html'">Go to Home</button>
      </div>
    </div>

    <script>
      document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);
        fetch('payment.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          var popup = document.getElementById('popup');
          var message = document.getElementById('popupMessage');

          if (data.status === 'success') {
            message.innerHTML = `
              <strong>Success!</strong><br>
              Name: ${data.data.firstname}<br>
              Email: ${data.data.email}<br>
              Address: ${data.data.address}<br>
              City: ${data.data.city}<br>
              State: ${data.data.state}<br>
              Pincode: ${data.data.pincode}<br>
              Card Name: ${data.data.cardname}<br>
              Card Number: ${data.data.cardnumber}<br>
              Expiration: ${data.data.expmonth}/${data.data.expyear}<br>
              CVV: ${data.data.cvv}
            `;
            popup.style.display = 'flex';
          } else {
            message.innerHTML = <strong>Error!</strong><br>${data.message};
            popup.style.display = 'flex';
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
      });
    </script>
  </body>
</html>
```

```php
<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Change this to your database password
$dbname = "your_database"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO payments (firstname, email, address, city, state, pincode, cardname, cardnumber, expmonth, expyear, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssss", $firstname, $email, $address, $city, $state, $pincode, $cardname, $cardnumber, $expmonth, $expyear, $cvv);

// Set parameters and execute
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

if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Payment details submitted successfully.',
        'data' => [
            'firstname' => $firstname,
            'email' => $email,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'pincode' => $pincode,
            'cardname' => $cardname,
            'cardnumber' => $cardnumber,
            'expmonth' => $expmonth,
            'expyear' => $expyear,
            'cvv' => $cvv
        ]
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to submit payment details.'
    ]);
}

$stmt->close();
$conn->close();
?>
```

```sql
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    pincode VARCHAR(10) NOT NULL,
    cardname VARCHAR(255) NOT NULL,
    cardnumber VARCHAR(19) NOT NULL,
    expmonth CHAR(2) NOT NULL,
    expyear CHAR(4) NOT NULL,
    cvv CHAR(4) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
