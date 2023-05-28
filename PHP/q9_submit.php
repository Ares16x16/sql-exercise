<?php
include("connect.php");

$query = "SELECT branch.branch_ID,branch.name,COUNT(*) as class_num FROM branch, class WHERE class.branch_ID = branch.branch_ID GROUP BY class.branch_ID ORDER BY branch.branch_ID DESC";

$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error());

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 9</title>";
echo "</head>";
echo "<body  align=center>";
echo "<h3>Q9_1 Answer</h3>";

// display the table
//echo "<table border='1' align='center'>";
//echo "<tr>";
//echo "<td>member_ID</td>";
//echo "<td>name</td>";
//echo "<td>num_of_referee</td>";
//echo "</tr>";


echo "<form action='q9.php' method='POST'>";
echo "<select name='branch_ID'>";
$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error());

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<option value ='".$row['branch_ID']."'>";
	echo $row['name'];
	echo ': ';
	echo $row['class_num'];
    echo "</option>";
}


echo "</select>";
echo "<input type='submit'>";
echo "</form>";



echo "</table>";
echo "<br><a href='index.html'>back</a>";
echo "</body>";
echo "</html>";

// last step: free the tuple result and close the MySQL database connection
mysqli_free_result($result);
mysqli_close($con);

?>


