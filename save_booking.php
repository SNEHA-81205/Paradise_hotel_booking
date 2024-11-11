<?php
// Database configuration
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "hotel_booking";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$room_type = $_POST['Rooms'];
$num_rooms = $_POST['number1'];
$num_guests = $_POST['number2'];
$date_range = explode(" to ", $_POST['date1']); // Assuming date format like "YYYY-MM-DD to YYYY-MM-DD"
$arrival_date = $date_range[0];
$departure_date = $date_range[1];

// Insert data into the database
$sql = "INSERT INTO bookings (name, email, phone, room_type, num_rooms, num_guests, arrival_date, departure_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssiiis", $name, $email, $phone, $room_type, $num_rooms, $num_guests, $arrival_date, $departure_date);

if ($stmt->execute()) {
    echo "Booking successful!";
    // Redirect to payment page
    header("Location: " . $_POST['paymentPage']);
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
