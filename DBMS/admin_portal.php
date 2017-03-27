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
  $updateSQL = sprintf("UPDATE log SET no_of_users_registered=%s, no_of_paid_users=%s, no_of_unpaid_users=%s, total_tax_amt_recieved=%s, highest_tax_amt=%s WHERE end_year=%s",
                       GetSQLValueString($_POST['hidden_total'], "int"),
                       GetSQLValueString($_POST['hidden_paid'], "int"),
                       GetSQLValueString($_POST['hidden_unpaid'], "int"),
                       GetSQLValueString($_POST['hidden_total_tax'], "double"),
                       GetSQLValueString($_POST['hidden_max_tax'], "double"),
                       GetSQLValueString($_POST['hidden_year'], "int"));

  mysql_select_db($database_new, $new);
  $Result1 = mysql_query($updateSQL, $new) or die(mysql_error());

  $updateGoTo = "log.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_new, $new);
$query_Recordset1 = "select count(*) from signup";
$Recordset1 = mysql_query($query_Recordset1, $new) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_new, $new);
$query_Recordset2 = "select count(*) from signup where payment_status='Y'";
$Recordset2 = mysql_query($query_Recordset2, $new) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_new, $new);
$query_Recordset3 = "select count(*) from signup where payment_status='N'";
$Recordset3 = mysql_query($query_Recordset3, $new) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_new, $new);
$query_Recordset4 = "select sum(tax_amt) from paid_customers";
$Recordset4 = mysql_query($query_Recordset4, $new) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

mysql_select_db($database_new, $new);
$query_Recordset5 = "select max(tax_amt) from paid_customers";
$Recordset5 = mysql_query($query_Recordset5, $new) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body BACKGROUND="taxes71.jpg">
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
<p><h2>Admin Portal</h2></p>
<p>&nbsp;</p>
<p><h3><a href="admin_user_print.php">Click Here</a> to view registered users</h3>


<p>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <span class="hdshgdsv">To view Log</span><span class="new_h3">:</span> 
  <input type="submit" name="go" id="go" value="Click Here" />
  <input name="hidden_year" type="hidden" id="hidden_year" value="2015" />
  <input name="hidden_total" type="hidden" id="hidden_total" value="<?php echo $row_Recordset1['count(*)']; ?>" />
  <input name="hidden_paid" type="hidden" id="hidden_paid" value="<?php echo $row_Recordset2['count(*)']; ?>" />
  <input name="hidden_unpaid" type="hidden" id="hidden_unpaid" value="<?php echo $row_Recordset3['count(*)']; ?>" />
  <input name="hidden_total_tax" type="hidden" id="hidden_total_tax" value="<?php echo $row_Recordset4['sum(tax_amt)']; ?>" />
  <input name="hidden_max_tax" type="hidden" id="hidden_max_tax" value="<?php echo $row_Recordset5['max(tax_amt)']; ?>" />
<input type="hidden" name="MM_update" value="form1" />
</form>
</p>
</p>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);
?>
