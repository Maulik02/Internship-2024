<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forms";

$conn = mysqli_connect($servername, $username, $password, $dbname);

?>

<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Load jQuery first -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Then load Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </head>
    <style>
        *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }   
        .a {
            margin-top: 20px;
            text-align: center;
        }
        .a {
            display: inline-block;
            padding: 5px 10px;
            background-color: #f4f4f4;
            margin-right: 5px;
            text-decoration: none;
            color: #333;
        }   
        .a:hover:not(.active) {background-color: #ddd;}
        
        /* Table styling */
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
        .filter {
            margin-top: 20px;
            padding: 10px 10px;
            width: 20%;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
        }
        .search-form {
            margin-left: 370px;
        }
    </style>
<body>
<div class="search-form">
        <!-- Search form -->
        <form method="get" action="">
        
        <select name="country" id="country_filter" class="js-example-basic-single filter" onchange="
                document.getElementById('state_filter').value = '';
                document.getElementById('city_filter').value = ''; 
                this.form.submit()
            " class="count" id="country-filter">
                    <option value="">--Select Country--</option>
                    <?php
                    $con = mysqli_connect($servername, $username, $password, $dbname);
                    $selected_country = isset($_GET['country']) ? $_GET['country'] : '';
                    $selected_state = isset($_GET['state']) ? $_GET['state'] : '';
                    $selected_city = isset($_GET['city']) ? $_GET['city'] : '';

                    $country_query = "SELECT id,name FROM countries";
                    $result1 = $con->query($country_query);
                    while ($row1 = $result1->fetch_row()) {
                        $selected = $selected_country == $row1[0] ? 'selected' : '';
                        echo "<option value='$row1[0]' $selected>$row1[1]</option>";
                    }
                    
                    ?>
                    
                </select>
                <select name="state" id="state_filter" class="js-example-basic-single filter" 
                onchange="
                    document.getElementById('city_filter').value = '';
                    this.form.submit()
                " class="count" id="country-filter">
                    <option value="">--Select State--</option>
                    <?php
                    if (!empty($selected_country)) {
                        $state_query = "SELECT id,name FROM states WHERE country_id = $selected_country ORDER BY `name`";
                        $result2 = $con->query($state_query);
                        while ($row2 = $result2->fetch_row()) {
                            $selected = $selected_state == $row2[0] ? 'selected' : '';
                            echo "<option value='$row2[0]' $selected>$row2[1]</option>";
                        }
                    }
                    ?>
                </select>
                <select name="city" id="city_filter" class="js-example-basic-single filter" onchange="this.form.submit()" class="count" id="country-filter">
                    <option value="">--Select City--</option>
                    <?php
                    if (!empty($selected_state)) {
                        $city_query = "SELECT id,name FROM cities WHERE state_id = $selected_state ORDER BY `name`  ";
                        $result3 = $con->query($city_query);
                        while ($row3 = $result3->fetch_row()) {
                            $selected = $selected_city == $row3[0] ? 'selected' : '';
                            echo "<option value='$row3[0]' $selected>$row3[1]</option>";
                        }
                    }
                    ?>
                </select>
    </form>
</div>     
    </div>
    <!--select2 script-->                
    <script>
        $(document).ready(function() {
        $('.js-example-basic-single').select2();
        });
    </script>
    <?php
// Database connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get data from other tables based on IDs
function getId($query)
{
    global $conn;
    if ($row = mysqli_fetch_row($conn->query($query))) {
        return $row[0];
    } else {
        return '';
    }
}

$limit = 8; 
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$start = ($page - 1) * $limit;
$searchEmail = isset($_GET['email']) ? $_GET['email'] : ''; // Initialize $searchEmail
$searchName = isset($_GET['name']) ? $_GET['name'] : ''; // Initialize $searchName

// Construct the SQL query based on search criteria
$where = [
    'search'     => (!empty($_GET['search'])  ? $_GET['search']  : 0),
    'country_id' => (!empty($_GET['country']) ? $_GET['country'] : 0),
    'state_id'   => (!empty($_GET['state'])   ? $_GET['state']   : 0),
    'city_id'    => (!empty($_GET['city'])    ? $_GET['city']    : 0)
];

$where = array_filter($where);

$and_where = [];
foreach($where as $field => $value)
{
    if($field == 'search')
    {
        $and_where[] = '(`name` LIKE "%' . $value . '%" OR `email` LIKE "%' . $value . '%")';
    }
    else 
    {
        $and_where[] = '`' . $field . '` = "' . $value . '"';
    }
}

$where = implode(' AND ' , $and_where);

if(!empty($where)){
    $where = 'WHERE '. $where;
}
// Add limit to the SQL query for pagination
$sql = 'SELECT * FROM tbl_student ' . $where . ' LIMIT ' . $start . ',' . $limit . '';

// Fetch data from database
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    echo "<table class='table'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Address</th>
            </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["Name"]."</td>
                <td>".$row["Email"]."</td>";
                $mytimestamp = gmdate('m-d-Y', $row['Date_of_Birth']);
                echo "<td>$mytimestamp</td>";
                $country = "SELECT name FROM countries WHERE id = " . $row['country_id'];
                echo "<td>" . getId($country) . "</td>";

                $state = "SELECT name FROM states WHERE id = " . $row['state_id'];
                echo "<td>" . getId($state) . "</td>";

                $city = "SELECT name FROM cities WHERE id = " . $row['city_id'];
                echo "<td>" . getId($city) . "</td>";
               echo " <td>".$row["Address"]."</td>
            </tr>";
    }
    echo "</table>";

    // Pagination links
    $sql_total = "SELECT COUNT(id) AS total FROM tbl_student";
    $result_total = $conn->query($sql_total);
    $row_total = $result_total->fetch_assoc();
    $total_pages = ceil($row_total["total"] / $limit);
    echo  '<center>'; 
    if($page > 1) {
        echo '<a class="a" href="?page='.($page-1).'&email='.$searchEmail.'&name='.$searchName.'">Prev</a>';
    }

    for ($i=1; $i <= $total_pages; $i++) {
        echo "<a class='a' href='?page=".$i."&email=".$searchEmail."&name=".$searchName."'>".$i."</a> ";
    }

    if($total_pages > $page){
        echo '<a class="a" href="?page='.($page+1).'&email='.$searchEmail.'&name='.$searchName.'">Next</a>';
    }
} else {
    echo "0 results";
}
echo "</center>";

$conn->close();
?>