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
$query_signup_details = "SELECT s.id,name, dob, age, gender, address, designation, company, email, mobile FROM signup s,admin_user_id_get a where s.id=a.user_id;";
$signup_details = mysql_query($query_signup_details, $new) or die(mysql_error());
$row_signup_details = mysql_fetch_assoc($signup_details);
$totalRows_signup_details = mysql_num_rows($signup_details);

mysql_select_db($database_new, $new);
$query_income_details_get = "SELECT i.id,salary, HRA, medical_expense, housing_loan, capital_gains, agricultural_income, other_income FROM income_details i,admin_user_id_get a where i.id=a.user_id";
$income_details_get = mysql_query($query_income_details_get, $new) or die(mysql_error());
$row_income_details_get = mysql_fetch_assoc($income_details_get);
$totalRows_income_details_get = mysql_num_rows($income_details_get);

mysql_select_db($database_new, $new);
$query_tax_details_get = "SELECT t.id,total_income, deductions, taxable_income, tax FROM tax_calc t,admin_user_id_get a where t.id=a.user_id";
$tax_details_get = mysql_query($query_tax_details_get, $new) or die(mysql_error());
$row_tax_details_get = mysql_fetch_assoc($tax_details_get);
$totalRows_tax_details_get = mysql_num_rows($tax_details_get);
$query_signup_details = "SELECT s.id,name, dob, age, gender, address, designation, company, email, mobile FROM signup s,admin_user_id_get a WHERE s.id=a.user_id";
$signup_details = mysql_query($query_signup_details, $new) or die(mysql_error());
$row_signup_details = mysql_fetch_assoc($signup_details);
$totalRows_signup_details = mysql_num_rows($signup_details);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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

<body >
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
<p>&nbsp;</p>
<p>&nbsp;</p>

<div class="container">
<div class="table-wrapper">	
<h2>Personal Details</h2>	
</br>
<table width="1200" border="4" cellpadding="2" cellspacing="2" class="alt">
<tr>
<td width="208">ID</td>
<td width="966"><?php echo $row_signup_details['id']; ?></td>
</tr>
<tr>
<td>Name</td>
<td><?php echo $row_signup_details['name']; ?></td>
</tr>
<tr>
<td>DOB</td>
<td><?php echo $row_signup_details['dob']; ?></td>
</tr>
<tr>
<td>Age</td>
<td><?php echo $row_signup_details['age']; ?></td>
</tr>
<tr>
<td>Gender</td>
<td><?php echo $row_signup_details['gender']; ?></td>
</tr>
<tr>
<td>Address</td>
<td><?php echo $row_signup_details['address']; ?></td>
</tr>
<tr>
<td>Designation</td>
<td><?php echo $row_signup_details['designation']; ?></td>
</tr>
<tr>
<td>Company</td>
<td><?php echo $row_signup_details['company']; ?></td>
</tr>
<tr>
<td>Email</td>
<td><?php echo $row_signup_details['email']; ?></td>
</tr>
<tr>
<td>Mobille</td>
<td><?php echo $row_signup_details['mobile']; ?></td>
</tr>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
<h2>Income Details</h2>	
</br>
<table class="alt" border="4" cellspacing="2" cellpadding="2">
<tr>
<td width="18%">Salary</td>
<td width="82%"><?php echo $row_income_details_get['salary']; ?></td>
</tr>
<tr>
<td>HRA</td>
<td><?php echo $row_income_details_get['HRA']; ?></td>
</tr>
<tr>
<td>Medical Expenses</td>
<td><?php echo $row_income_details_get['medical_expense']; ?></td>
</tr>
<tr>
<td>Housing Loan</td>
<td><?php echo $row_income_details_get['housing_loan']; ?></td>
</tr>
<tr>
<td>Capital Gains</td>
<td><?php echo $row_income_details_get['capital_gains']; ?></td>
</tr>
<tr>
<td>Agricultural Income</td>
<td><?php echo $row_income_details_get['agricultural_income']; ?></td>
</tr>
<tr>
<td>Other Income</td>
<td><?php echo $row_income_details_get['other_income']; ?></td>
</tr>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
<h2>Taxation Details</h2>	
</br>
<table class="alt" border="4" cellspacing="2" cellpadding="2">
<tr>
<td width="18%">Total_income</td>
<td width="82%"><?php echo $row_tax_details_get['total_income']; ?></td>
</tr>
<tr>
<td>Deductions</td>
<td><?php echo $row_tax_details_get['deductions']; ?></td>
</tr>
<tr>
<td>Taxable Income</td>
<td><?php echo $row_tax_details_get['taxable_income']; ?></td>
</tr>
<tr>
<td>Tax</td>
<td><?php echo $row_tax_details_get['tax']; ?></td>
</tr>
</table>
</div>
</div>



</body>
</html>
<?php
mysql_free_result($signup_details);

mysql_free_result($income_details_get);

mysql_free_result($tax_details_get);
?>
