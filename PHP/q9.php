<?php
include("connect.php");

// prepare the database query
if (isset ($_POST['branch_ID'])){
	$query = "SELECT class.class_ID, class.name,class.date,class.capacity,COUNT(enrollment.class_ID) as num_of_enrollment FROM class LEFT JOIN enrollment ON class.class_ID = enrollment.class_ID WHERE class.branch_ID='".$_POST['branch_ID']."' GROUP BY enrollment.class_ID ORDER BY class.class_ID DESC";
}else{ //delete POST
	$query = "SELECT class.class_ID, class.name,class.date,class.capacity,COUNT(enrollment.class_ID) as num_of_enrollment FROM class LEFT JOIN enrollment ON class.class_ID = enrollment.class_ID GROUP BY enrollment.class_ID ORDER BY class.class_ID DESC";
}

// execute the query
$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 9_2</title>";
echo "</head>";
echo "<body  align=center>";
echo "<h3>Q9_2 Answer</h3>";

// display the table
echo "<table border='1' align='center'>";
echo "<tr>";
echo "<td>class_ID</td>";
echo "<td>name</td>";
echo "<td>date</td>";
echo "<td>capacity</td>";
echo "<td>num_of_enrollment</td>";
echo "</tr>";

// print data with HTML
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['class_ID']."</td>";
    echo "<td>".$row['name']."</td>";
	echo "<td>".$row['date']."</td>";
	echo "<td>".$row['capacity']."</td>";
	echo "<td>".$row['num_of_enrollment']."</td>";
    echo "</tr>";
}
echo "</table>";
echo "<br><a href='index.html'>back</a>";
echo "</body>";
echo "</html>";

// last step: free the tuple result and close the MySQL database connection
mysqli_free_result($result);
mysqli_close($con);

?>


