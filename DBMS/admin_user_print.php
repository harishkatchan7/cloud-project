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

$maxRows_user_det_get = 10;
$pageNum_user_det_get = 0;
if (isset($_GET['pageNum_user_det_get'])) {
  $pageNum_user_det_get = $_GET['pageNum_user_det_get'];
}
$startRow_user_det_get = $pageNum_user_det_get * $maxRows_user_det_get;

mysql_select_db($database_new, $new);
$query_user_det_get = "SELECT id, name, dob, age, gender, address, designation, company, email, mobile FROM signup";
$query_limit_user_det_get = sprintf("%s LIMIT %d, %d", $query_user_det_get, $startRow_user_det_get, $maxRows_user_det_get);
$user_det_get = mysql_query($query_limit_user_det_get, $new) or die(mysql_error());
$row_user_det_get = mysql_fetch_assoc($user_det_get);

if (isset($_GET['totalRows_user_det_get'])) {
  $totalRows_user_det_get = $_GET['totalRows_user_det_get'];
} else {
  $all_user_det_get = mysql_query($query_user_det_get);
  $totalRows_user_det_get = mysql_num_rows($all_user_det_get);
}
$totalPages_user_det_get = ceil($totalRows_user_det_get/$maxRows_user_det_get)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
<title>Untitled Document</title>
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
<div class="table-wrapper">


<div class="container">
<p>&nbsp;&nbsp;&nbsp;<h1>User Details</h1>
<p>&nbsp;</p>
<table class="alt" width=80% border="4" cellspacing="2" cellpadding="2">
  <tr>
    <td>ID</td>
    <td>Name</td>
    <td>DOB</td>
    <td>Age</td>
    <td>Gender</td>
    <td>Address</td>
    <td>Designation</td>
    <td>Company</td>
    <td>Email</td>
    <td>Mobile Number</td>
  </tr>
<?php do { ?>
  <tr><td><?php echo $row_user_det_get['id']; ?></td>
  <td><?php echo $row_user_det_get['name']; ?></td>
  <td><?php echo $row_user_det_get['dob']; ?></td>
  <td><?php echo $row_user_det_get['age']; ?></td>
  <td><?php echo $row_user_det_get['gender']; ?></td>
  <td><?php echo $row_user_det_get['address']; ?></td>
  <td><?php echo $row_user_det_get['designation']; ?></td>
  <td><?php echo $row_user_det_get['company']; ?></td>
  <td><?php echo $row_user_det_get['email']; ?></td>
  <td><?php echo $row_user_det_get['mobile']; ?></td>
  </tr>
  
  <?php } while ($row_user_det_get = mysql_fetch_assoc($user_det_get)); ?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>To view users' income detail <a href="admin_individual_user_view.php">click here</a></p>
  </div>
</div>

</body>
</html>
<?php
mysql_free_result($user_det_get);
?>
