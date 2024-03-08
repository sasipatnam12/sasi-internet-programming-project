<!DOCTYPE html>
<html>
<head>
    <title>Cake Order Form</title>
</head>
<body>
    <centre>
    <h2>Order Your Cake</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="customer_name">Customer Name:</label><br>
        <input type="text" id="customer_name" name="customer_name"><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone"><br><br>
        
        <label for="cake_type">Cake Type:</label><br>
        <input type="text" id="cake_type" name="cake_type"><br><br>
        
        <label for="delivery_date">Delivery Date:</label><br>
        <input type="date" id="delivery_date" name="delivery_date"><br><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message"></textarea><br><br>
        
        <input type="submit" name="submit" value="Place Order">
    </form>

    <?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = "orders";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer_name = isset($_POST['customer_name']) ? $_POST['customer_name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $cake_type = isset($_POST['cake_type']) ? $_POST['cake_type'] : '';
        $delivery_date = isset($_POST['delivery_date']) ? $_POST['delivery_date'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO cake (customer_name, email, phone, cake_type, delivery_date, message) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $customer_name, $email, $phone, $cake_type, $delivery_date, $message);

        // Execute
        $stmt->execute();

        echo "Order placed successfully!";
        
        $stmt->close();
    }

    $conn->close();
    ?>
    </centre>
</body>
</html>
