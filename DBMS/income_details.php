<?php require_once('Connections/new.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE income_details SET salary=%s, HRA=%s, medical_expense=%s, housing_loan=%s, capital_gains=%s, agricultural_income=%s, other_income=%s WHERE id=%s",
                       GetSQLValueString($_POST['salary'], "double"),
                       GetSQLValueString($_POST['hra'], "double"),
                       GetSQLValueString($_POST['med_exp'], "double"),
                       GetSQLValueString($_POST['housing_loan'], "double"),
                       GetSQLValueString($_POST['capital_gain'], "double"),
                       GetSQLValueString($_POST['agri_income'], "double"),
                       GetSQLValueString($_POST['other_income'], "double"),
                       GetSQLValueString($_POST['hiddenid'], "int"));

  mysql_select_db($database_new, $new);
  $Result1 = mysql_query($updateSQL, $new) or die(mysql_error());

  $updateGoTo = "userhome.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_new, $new);
$query_get_inc_det = "SELECT * FROM income_details";
$get_inc_det = mysql_query($query_get_inc_det, $new) or die(mysql_error());
$row_get_inc_det = mysql_fetch_assoc($get_inc_det);
$totalRows_get_inc_det = mysql_num_rows($get_inc_det);

mysql_select_db($database_new, $new);
$query_Recordset1 = "select id from login";
$Recordset1 = mysql_query($query_Recordset1, $new) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_new, $new);
$query_dynamic_form = "SELECT l.id,salary,hra,medical_expense,housing_loan,capital_gains,agricultural_income,other_income FROM login l,income_details i WHERE l.id=i.id ";
$dynamic_form = mysql_query($query_dynamic_form, $new) or die(mysql_error());
$row_dynamic_form = mysql_fetch_assoc($dynamic_form);
$totalRows_dynamic_form = mysql_num_rows($dynamic_form);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
				<li><a href="home.html" accesskey="1" title="">Homepage</a></li>
				<li><a href="login.php" accesskey="2" title="">Login</a></li>
				<li class="current_page_item"><a href="#signup.php" accesskey="3" title="">Sign Up</a></li>
			</ul>
		</div>
	</div>
    </div>
</div>
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <p>
    <input name="hiddenid" type="hidden" id="hiddenid" value="<?php echo $row_Recordset1['id']; ?>" />
  </p>
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td><label for="salary2">Salary:</label></td>
      <td><input type="text" name="salary" id="salary" /></td>
    </tr>
    <tr>
      <td>HRA:</td>
      <td><input type="text" name="hra" id="hra" /></td>
    </tr>
    <tr>
      <td>Medical Expenses: </td>
      <td><input type="text" name="med_exp" id="med_exp" /></td>
    </tr>
    <tr>
      <td>Housing Loan:
      <label for="housing_loan2"></label></td>
      <td><input type="text" name="housing_loan" id="housing_loan" /></td>
    </tr>
    <tr>
      <td>Capital Gain:
      <label for="capital_gain2"></label></td>
      <td><input type="text" name="capital_gain" id="capital_gain" /></td>
    </tr>
    <tr>
      <td>Agricultural Income:
      <label for="agri_income2"></label></td>
      <td><input type="text" name="agri_income" id="agri_income" /></td>
    </tr>
    <tr>
      <td>Other Income:
      <label for="other_income2"></label></td>
      <td><input type="text" name="other_income" id="other_income" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="102">&nbsp;</td>
      <td width="104"><input type="submit" name="submit" id="submit" value="Submit" /></td>
      <td width="194"> <input type="reset" name="reset" id="reset" value="Reset" /></td>
      <td width="35">&nbsp;</td>
    </tr>
  </table>
  <p>
    <input type="hidden" name="MM_update" value="form1" />
</p>
</form>
</body>
</html>
<?php
mysql_free_result($get_inc_det);

mysql_free_result($Recordset1);

mysql_free_result($dynamic_form);

mysql_free_result($get_inc_det);
?>
