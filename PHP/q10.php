<?php
include("connect.php");

$x = $_GET['class_ID'];

// prepare the database query
$query = "SELECT class.class_ID, class.name,class.date,class.capacity,class.description,instructor.name as instructor_name FROM class LEFT JOIN instructor ON class.instructor_ID = instructor.instructor_ID WHERE class.class_ID='$x' GROUP BY class.class_ID";
$queryB = "SELECT member.member_ID, member.name as member_name, enrollment.class_ID FROM member, enrollment WHERE enrollment.class_ID = '$x' AND member.member_ID = enrollment.member_ID ORDER BY member.member_ID DESC";
$queryC = "SELECT class.name as class_name, member.member_ID, class.class_ID FROM member, class, enrollment WHERE member.member_ID = enrollment.member_ID AND class.class_ID = enrollment.class_ID";

// execute the query
$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));
$resultB = mysqli_query($con,$queryB) or die( "Unable to execute query:".mysqli_error($con));
$resultC = mysqli_query($con,$queryC) or die( "Unable to execute query:".mysqli_error($con));

//echo $x;
echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 10</title>";
echo "</head>";
echo "<body  align=center>";
echo "<h3>Q10 Answer</h3>";

// display the table
echo "<table border='1' align='center'>";
echo "<tr>";
echo "<td>class_ID</td>";
echo "<td>class_name</td>"; 
echo "<td>date</td>";
echo "<td>capacity</td>";
echo "<td>description</td>";
echo "<td>instructor_name</td>";
echo "</tr>";

// print data with HTML
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['class_ID']."</td>";
    echo "<td>".$row['name']."</td>";
	echo "<td>".$row['date']."</td>";
	echo "<td>".$row['capacity']."</td>";
	echo "<td width = '300'>".$row['description']."</td>";
	echo "<td>".$row['instructor_name']."</td>";
    echo "</tr>";
}
 
echo "<table border='1' align='center'>";
echo "<tr>";
echo "<td>member_ID</td>";
echo "<td>member_name</td>"; 
echo "<td>classes_enrolled</td>";
echo "</tr>";

while($row = mysqli_fetch_array($resultB, MYSQLI_ASSOC))
{
	
    echo "<tr>";
    echo "<td>".$row['member_ID']."</td>";
    echo "<td>".$row['member_name']."</td>";
	$resultC = mysqli_query($con,$queryC) or die( "Unable to execute query:".mysqli_error($con));
	echo "<td>";
	while($ro = mysqli_fetch_array($resultC, MYSQLI_ASSOC)){
		if ($row['member_ID'] == $ro['member_ID'] and $row['class_ID'] != $ro['class_ID']){
			echo "<a href = 'q10.php?class_ID=".$ro['class_ID']."'> ".$ro['class_name']." </a>";
			echo "<br>";
		}
	}
    echo "</tr>";
	mysqli_free_result($resultC);
}
echo "<br>";
echo "<br>";

echo "</table>";


echo "<br><a href='<?=?>'>back</a>";
echo "</body>";
echo "</html>";

// last step: free the tuple result and close the MySQL database connection
mysqli_free_result($result);
mysqli_close($con);


?>


