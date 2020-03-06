<?php

   $con = mysqli_connect("172.26.126.103:3361", "root", "root", "employee");
   $query = "SELECT * FROM employee_info where empuser='jmascarinas'";
   $result = mysqli_query($con, $query);
   $row = mysqli_fetch_assoc($result);
   $rows = mysqli_num_rows($result);

   print_r($row);
   echo "<br><br>";
?>
<?php

$con = mysqli_connect("172.26.126.103:3361", "root", "root", "cpms");
$query = "SELECT * FROM reissuelog";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$rows = mysqli_num_rows($result);

foreach($row as $index => $value)
print_r($row);
echo "<br><br>";
?>