<?php
include("connect.php");

// prepare the database query

$query = "SELECT class.instructor_ID, instructor.name, COUNT(class.instructor_id) as num_of_classes FROM class LEFT JOIN instructor ON class.instructor_ID = instructor.instructor_ID GROUP BY instructor.instructor_ID HAVING num_of_classes > 3 ORDER BY class.instructor_ID DESC";

// execute the query
$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 6</title>";
echo "</head>";
echo "<body  align=center>";
echo "<h3>Q6 Answer</h3>";

// display the table
echo "<table border='1' align='center'>";
echo "<tr>";
echo "<td>instructor_ID</td>";
echo "<td>name</td>";
echo "<td>num_of_classes</td>";
echo "</tr>";

// print data with HTML
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['instructor_ID']."</td>";
    echo "<td>".$row['name']."</td>";
	echo "<td>".$row['num_of_classes']."</td>";
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


