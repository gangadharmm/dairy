<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            color: #4CAF50;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Order Payment Successful</h2>
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($_GET['firstname']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($_GET['email']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($_GET['address']); ?></p>
        <p><strong>City:</strong> <?php echo htmlspecialchars($_GET['city']); ?></p>
        <p><strong>State:</strong> <?php echo htmlspecialchars($_GET['state']); ?></p>
        <p><strong>Pincode:</strong> <?php echo htmlspecialchars($_GET['pincode']); ?></p>
        <p><strong>Name on Card:</strong> <?php echo htmlspecialchars($_GET['cardname']); ?></p>
        <p><strong>Credit Card Number:</strong> <?php echo htmlspecialchars($_GET['cardnumber']); ?></p>
        <p><strong>Expiration Month:</strong> <?php echo htmlspecialchars($_GET['expmonth']); ?></p>
        <p><strong>Expiration Year:</strong> <?php echo htmlspecialchars($_GET['expyear']); ?></p>
        <p><strong>CVV:</strong> <?php echo htmlspecialchars($_GET['cvv']); ?></p>
        <a href="main.html" class="btn">Go to Main Page</a>
    </div>
</body>
</html>
