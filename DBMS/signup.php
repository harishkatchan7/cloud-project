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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO signup (id, name, dob, age, gender, address, designation, company, email, mobile, password, payment_status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['dob'], "date"),
                       GetSQLValueString($_POST['age'], "int"),
                       GetSQLValueString($_POST['Gender'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['desgn'], "text"),
                       GetSQLValueString($_POST['company'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['mob_no'], "text"),
                       GetSQLValueString($_POST['pass'], "text"),
                       GetSQLValueString($_POST['value_null'], "text"));

  mysql_select_db($database_new, $new);
  $Result1 = mysql_query($insertSQL, $new) or die(mysql_error());

  $insertGoTo = "login.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO income_details (id, salary, HRA, medical_expense, housing_loan, capital_gains, agricultural_income, other_income) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['value_null'], "double"),
                       GetSQLValueString($_POST['value_null'], "double"),
                       GetSQLValueString($_POST['value_null'], "double"),
                       GetSQLValueString($_POST['value_null'], "double"),
                       GetSQLValueString($_POST['value_null'], "double"),
                       GetSQLValueString($_POST['value_null'], "double"),
                       GetSQLValueString($_POST['value_null'], "double"));

  mysql_select_db($database_new, $new);
  $Result1 = mysql_query($insertSQL, $new) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tax_calc (id, total_income, deductions, taxable_income, tax) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['value_null'], "double"),
                       GetSQLValueString($_POST['value_null'], "double"),
                       GetSQLValueString($_POST['value_null'], "double"),
                       GetSQLValueString($_POST['value_null'], "double"));

  mysql_select_db($database_new, $new);
  $Result1 = mysql_query($insertSQL, $new) or die(mysql_error());

  $insertGoTo = "id_display.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_new, $new);
$query_Recordset1 = "SELECT * FROM signup";
$Recordset1 = mysql_query($query_Recordset1, $new) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_new, $new);
$query_Recordset2 = "SELECT max(id)+1 FROM signup";
$Recordset2 = mysql_query($query_Recordset2, $new) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
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
				<li><a href="home.html" accesskey="1" title="">Homepage</a></li>
				<li><a href="login.php" accesskey="2" title="">Login</a></li>
				<li class="current_page_item"><a href="signup.php" accesskey="3" title="">Sign Up</a></li>
			</ul>
		</div>
	</div>
    </div>
    </div>
    <div class="container">
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST" class="form form--login">
  <p>&nbsp;    </p>
  <p>
    <input name="value_null" type="hidden" id="value_null" value="0" />
  </p>
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td style="color: #000000">ID:</td>
      <td><input name="id" type="text" id="id" value="<?php echo $row_Recordset2['max(id)+1']; ?>" readonly/></td>
    </tr>
    <tr>
      <td style="color: #000000">Name :</td>
      <td><input type="text" name="name" id="name" /></td>
    </tr>
    <tr>
      <td style="color: #000000">Date of Birth:</td>
      <td><input name="dob" type="date" id="dob" value="yyyy/mm/dd" /></td>
    </tr>
    <tr>
      <td style="color: #000000"><label for="age">Age: </label>
&nbsp;</td>
      <td><input type="text" name="age" id="age" /></td>
    </tr>
    <tr>
      <td style="color: #000000">Gender:&nbsp;</td>
      <td><label>
      <input type="radio" name="Gender" value="M" id="Gender_0" />
      Male</label>
    <br />
    <label>
      <input type="radio" name="Gender" value="F" id="Gender_1" />
      Female</label></td>
    </tr>
    <tr>
      <td style="color: #000000">Address:</td>
      <td><textarea name="address" cols="45" rows="5" id="address"></textarea></td>
    </tr>
    <tr>
      <td style="color: #000000">Designation:&nbsp;&nbsp;</td>
      <td><input type="text" name="desgn" id="desgn" /></td>
    </tr>
    <tr>
      <td style="color: #000000">Company name:</td>
      <td><input type="text" name="company" id="company" /></td>
    </tr>
    <tr>
      <td style="color: #000000">Email:</td>
      <td><input type="email" name="email" id="email" /></td>
    </tr>
    <tr>
      <td style="color: #000000">Password:</td>
      <td><input type="password" name="pass" id="pass" /></td>
    </tr>
    <tr>
      <td style="color: #000000">Mobile No:</td>
      <td><input type="text" name="mob_no" id="mob_no" /></td>
    </tr>
    
  </table>
  <p>
    <label for="id"></label>
  </p>
  <p>&nbsp;</p>
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="51">&nbsp;</td>
      <td width="119"><input type="submit" name="submit" id="submit" value="Submit" /></td>
      <td width="212"><input type="reset" name="reset" id="reset" value="Reset" /></td>
      <td width="53">&nbsp;</td>
    </tr>
  </table>
  <p>
    <label for="mob_no"></label>
    <input type="hidden" name="MM_insert" value="form1" />
</p>
</form>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
