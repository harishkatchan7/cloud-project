<?php require_once('Connections/new.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_new, $new);
$query_Recordset1 = "select * from log";
$Recordset1 = mysql_query($query_Recordset1, $new) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<div id="wrapper">
	<div id="header-wrapper">
<div id="header" class="container" >
		<div id="logo">
			<h1><a href="#">Income Tax of India</a></h1>
		</div>
		<div id="menu">
			<ul>
			  <li class="current_page_item"><a href="admin_portal.php" accesskey="1" title="">Admin Home</a></li>
				<li><a href="home.html" accesskey="2" title="">Logout</a></li>
			</ul>
		</div>
	</div>
    </div>
</div>
<div class="container">
<p>
<h2>Log </h2>
<p>&nbsp;</p>
<table>
  <tr>
    <td>Year</td> <td><?php echo $row_Recordset1['end_year']; ?></td></tr><tr>
    <td>No. of registered users</td><td><?php echo $row_Recordset1['no_of_users_registered']; ?></td></tr><tr>
    <td>Paid users</td><td><?php echo $row_Recordset1['no_of_paid_users']; ?></td></tr><tr>
    <td>Unpaid Users</td><td><?php echo $row_Recordset1['no_of_unpaid_users']; ?></td></tr><tr>
    <td>Total Tax amouunt recieved</td><td><?php echo $row_Recordset1['total_tax_amt_recieved']; ?></td></tr><tr>
    <td>Highest Tax amount Recieved</td><td><?php echo $row_Recordset1['highest_tax_amt']; ?></td>
  </tr>
 
  <tr>
   
    
    
    
    
    
  </tr>
</table>



<p>
</p>
</p>
</div>
<div class="container">
<h3>To view the chart <a href="Graph/graphs.php">click here</a></h3></div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
