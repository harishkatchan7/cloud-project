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
$query_Recordset1 = "SELECT l.id,name, dob, age, gender, address, designation, company, email, mobile, payment_status FROM signup s,login l where l.id=s.id";
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
<style type="text/css">
body,td,th {
	font-family: Varela, sans-serif;
}
</style>
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
				<li class="current_page_item"><a href="userhome.php" accesskey="1" title="">User Home</a></li>
				<li><a href="contactus.php" accesskey="3" title="">Contact Us</a></li>
                <li><a href="logout.php" accesskey="2" title="">Logout</a></li>
			</ul>
		</div>
	</div>
    </div>
</div>
<div class="container">
<p>&nbsp;</p>
<div class="container">
<div class="table-wrapper">	
<table width="700" border="4" cellpadding="2" cellspacing="2" class="alt">
  <tr>
    <td>id</td>
    <td><?php echo $row_Recordset1['id']; ?></td></tr><tr>
    <td>name</td>
    <td><?php echo $row_Recordset1['name']; ?></td></tr><tr>
    <td>dob</td>
    <td><?php echo $row_Recordset1['dob']; ?></td></tr><tr>
    <td>age</td>
    <td><?php echo $row_Recordset1['age']; ?></td></tr><tr>
    <td>gender</td>
    <td><?php echo $row_Recordset1['gender']; ?></td></tr><tr>
    <td>address</td>
    <td><?php echo $row_Recordset1['address']; ?></td></tr><tr>
    <td>designation</td>
    <td><?php echo $row_Recordset1['designation']; ?></td></tr><tr>
    <td>company</td>
    <td><?php echo $row_Recordset1['company']; ?></td></tr><tr>
    <td>email</td>
    <td><?php echo $row_Recordset1['email']; ?></td></tr><tr>
    <td>mobile</td>
    <td><?php echo $row_Recordset1['mobile']; ?></td></tr><tr>
    <td>payment_status</td>
    <td><?php echo $row_Recordset1['payment_status']; ?></td>
  </tr>
</table>
</div>
</div>
</p>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
