<?php
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";
//$store_url = "http://localhost/phpinventory/";
// db connection
$conn = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($conn->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  //echo "Successfully connected";
}
// Check if studentId is set and not empty
 
?>
<style>
.success-message {
    background-color: lightgreen;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}
</style>
<div class="recentOrders">
   <?php
    // Check if the session variables are set
    if (isset($_SESSION['role']) && isset($_SESSION['cust_fullName'])) {
        // Display the message with green background for 4 seconds
        echo '<div class="success-message" id="messagee">Hello, this is ' . $_SESSION['role'] . ' <b>' . $_SESSION['cust_fullName'] . '</b> page</div>';
    }
    ?><div class="cardHeader">
    <h2>Recent Orders</h2>
    <a href="#" class="btn">View All</a>
</div>

<table>
    <thead>
        <tr>
            <td>Cnt</td>
            <td>Car Image</td>
            <td>User Name</td>
            <td>Status</td>
        </tr>
    </thead>

    <tbody>
        <?php
        // Fetch recent orders from the database
        $sql = "SELECT * FROM orders ORDER BY date DESC LIMIT 5"; // Assuming you want to display 5 recent orders
        $result = $conn->query($sql);
        $x = 0;

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                $x++;
                echo "<tr>";
                echo "<td>".$x."</td>"; // Display the count
                echo "<td><img src='allImages/".$row["carImage"]."' alt='Car Image' style='width: 100px; height: 100px;'></td>"; // Display the carImage
                echo "<td>".$row["customerName"]."</td>"; // Display the customerName
                echo "<td>".$row["status"]."</td>"; // Display the status
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No recent orders found</td></tr>";
        }
        ?>
    </tbody>
 

</table>
</div>
<script>
    // JavaScript to hide success message after 4 seconds
    setTimeout(function() {
        var successMessage = document.getElementById('messagee');
        if (successMessage) {
            successMessage.style.opacity = '0';
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 1000);
        }
    }, 4000);
</script>