<?php
// Database connection details
$servername = "localhost"; // Or your database server name
$username = "your_db_username"; // Replace with your database username
$password = "your_db_password"; // Replace with your database password
$dbname = "your_db_name"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve all bookings
$sql = "SELECT id, name, email, phone, room_type, num_rooms, num_guests, arrival_date, departure_date FROM bookings";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Bookings</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Booked Rooms</h2>

<?php
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Room Type</th><th>Number of Rooms</th><th>Number of Guests</th><th>Arrival Date</th><th>Departure Date</th></tr>";

    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["name"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["phone"] . "</td>
                <td>" . $row["room_type"] . "</td>
                <td>" . $row["num_rooms"] . "</td>
                <td>" . $row["num_guests"] . "</td>
                <td>" . $row["arrival_date"] . "</td>
                <td>" . $row["departure_date"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No bookings found.</p>";
}

$conn->close();
?>

</body>
</html>
