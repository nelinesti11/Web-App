<?php
$servername = "localhost";
$username = "FIDEL CHIMWANI"; 
$password = "your_password"; 
$dbname = "obituary_platform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
// SQL query to retrieve all obituaries
$sql = "SELECT * FROM obituaries";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<html><head><style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        </style></head><body>";

    echo "<table><tr><th>Name</th><th>Date of Birth</th><th>Date of Death</th><th>Content</th><th>Author</th></tr>";
    
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["dob"]."</td><td>".$row["dod"]."</td><td>".$row["content"]."</td><td>".$row["author"]."</td></tr>";
    }
    echo "</table></body></html>";
} else {
    echo "0 results";
}

$conn->close();
?>

<?php
// Pagination settings
$results_per_page = 10;

// SQL query to retrieve total number of records
$sql_count = "SELECT COUNT(*) AS total FROM obituaries";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_records = $row_count['total'];

// Determine number of pages
$total_pages = ceil($total_records / $results_per_page);

// Current page (default to page 1)
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_index = ($current_page - 1) * $results_per_page;

// SQL query with LIMIT for pagination
$sql_pagination = "SELECT * FROM obituaries LIMIT $start_index, $results_per_page";
$result_pagination = $conn->query($sql_pagination);

if ($result_pagination->num_rows > 0) {
    echo "<html><head><style>/* CSS styling remains the same */</style></head><body>";

    echo "<table><tr><th>Name</th><th>Date of Birth</th><th>Date of Death</th><th>Content</th><th>Author</th></tr>";
    
    // Output data of each row
    while($row = $result_pagination->fetch_assoc()) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["dob"]."</td><td>".$row["dod"]."</td><td>".$row["content"]."</td><td>".$row["author"]."</td></tr>";
    }
    echo "</table>";

    // Pagination links
    echo "<div>";
    for ($page = 1; $page <= $total_pages; $page++) {
        echo "<a href='view_obituaries.php?page=".$page."'>".$page."</a> ";
    }
    echo "</div></body></html>";
} else {
    echo "0 results";
}

$conn->close();
?>
<?php
// Assuming $obituary is an associative array containing obituary details
$title = htmlspecialchars($obituary['name'] . ' Obituary');
$description = htmlspecialchars(substr($obituary['content'], 0, 160)); // Limit description length
$keywords = htmlspecialchars('obituary, memorial, ' . $obituary['name']);

echo "<head>";
echo "<title>$title</title>";
echo "<meta name='description' content='$description'>";
echo "<meta name='keywords' content='$keywords'>";
// Other meta tags as needed (author, etc.)
echo "</head>";
?>
