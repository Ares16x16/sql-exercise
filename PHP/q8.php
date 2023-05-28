<?php
include("connect.php");

// prepare the database query

$query = "SELECT A.member_ID, A.name, COUNT(B.referrer_ID) as num_of_referee FROM member A LEFT JOIN member B ON A.member_ID = B.referrer_ID GROUP BY A.member_ID HAVING num_of_referee>2 ORDER BY member_ID DESC";

// execute the query
$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 8</title>";
echo "</head>";
echo "<body  align=center>";
echo "<h3>Q8 Answer</h3>";

// display the table
echo "<table border='1' align='center'>";
echo "<tr>";
echo "<td>member_ID</td>";
echo "<td>name</td>";
echo "<td>num_of_referee</td>";
echo "</tr>";

// print data with HTML
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['member_ID']."</td>";
    echo "<td>".$row['name']."</td>";
	echo "<td>".$row['num_of_referee']."</td>";
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


