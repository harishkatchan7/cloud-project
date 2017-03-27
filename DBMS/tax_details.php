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
  $updateSQL = sprintf("UPDATE tax_calc SET total_income=%s, deductions=%s, taxable_income=%s, tax=%s WHERE id=%s",
                       GetSQLValueString($_POST['hidden_total_income'], "double"),
                       GetSQLValueString($_POST['hidden_deductions'], "double"),
                       GetSQLValueString($_POST['hidden_taxable_income'], "double"),
                       GetSQLValueString($_POST['hiddentax'], "double"),
                       GetSQLValueString($_POST['hiddenid'], "int"));

  mysql_select_db($database_new, $new);
  $Result1 = mysql_query($updateSQL, $new) or die(mysql_error());

  $updateGoTo = "payment_confirmation.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}



mysql_select_db($database_new, $new);
$query_get_income = "SELECT l.id,salary, HRA, medical_expense, housing_loan, capital_gains, agricultural_income, other_income FROM income_details i,login l WHERE l.id=i.id";
$get_income = mysql_query($query_get_income, $new) or die(mysql_error());
$row_get_income = mysql_fetch_assoc($get_income);
$totalRows_get_income = mysql_num_rows($get_income);

mysql_select_db($database_new, $new);
$query_login = "select id from login";
$login = mysql_query($query_login, $new) or die(mysql_error());
$row_login = mysql_fetch_assoc($login);
$totalRows_login = mysql_num_rows($login);

mysql_select_db($database_new, $new);
$query_payment_status_finder = "select payment_status from signup s,login l where s.id=l.id";
$payment_status_finder = mysql_query($query_payment_status_finder, $new) or die(mysql_error());
$row_payment_status_finder = mysql_fetch_assoc($payment_status_finder);
$totalRows_payment_status_finder = mysql_num_rows($payment_status_finder);
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
				<li><a href="userhome.html" accesskey="1" title="">User Home</a></li>
				<li class="current_page_item"><a href="tax_details.php" accesskey="3" title="">Tax Details</a></li>
                <li><a href="logout.php" accesskey="2" title="">Logout</a></li>
			</ul>
		</div>
	</div>
    </div>
    </div>
<p>&nbsp;</p>
<div class="container">
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <p>
    <input name="hidden_deductions" type="hidden" id="hidden_deductions" value="<?php echo (($row_get_income['HRA']+$row_get_income['medical_expense']+$row_get_income['housing_loan']));?>" />
    <input name="hidden_taxable_income" type="hidden" id="hidden_taxable_income" value="<?php echo (($row_get_income['salary']+$row_get_income['capital_gains']+$row_get_income['agricultural_income']+$row_get_income['other_income'])-($row_get_income['HRA']+$row_get_income['medical_expense']+$row_get_income['housing_loan']));?>" />
    <input name="hiddenid" type="hidden" id="hiddenid" value="<?php echo $row_login['id']; ?>" />
    <input name="hidden_total_income" type="hidden" id="hidden_total_income" value="<?php echo ($row_get_income['salary']+$row_get_income['capital_gains']+$row_get_income['agricultural_income']+$row_get_income['other_income']);?>"/>
    <?php
  	//function tax(){
  	$ans=0;
	$s=(($row_get_income['salary']+$row_get_income['capital_gains']+$row_get_income['agricultural_income']+$row_get_income['other_income'])-($row_get_income['HRA']+$row_get_income['medical_expense']+$row_get_income['housing_loan']));
	if(($s > 0)&&($s < 300000)){
		$ans=$s*0.1;
		//echo ($ans);
	}elseif(($s > 300000)&&($s < 500000)){
		$ans=$s*0.2;
		//echo ($ans);
	}else{
		$ans=$s*0.3;
		//echo ($ans);
	}
	//}
  ?>
    <input name="hiddentax" type="hidden" id="hiddentax" value="<?php echo ($ans);?>" />
    <input name="hidden_payment_status" type="hidden" id="hidden_payment_status" value="<?php echo $row_payment_status_finder['payment_status']; ?>" />
  </p>
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="209">Total income:</td>
      <td width="256"><?php echo ($row_get_income['salary']+$row_get_income['capital_gains']+$row_get_income['agricultural_income']+$row_get_income['other_income']);?></td>
    </tr>
    <tr>
      <td>Deductions:</td>
      <td><?php echo (($row_get_income['HRA']+$row_get_income['medical_expense']+$row_get_income['housing_loan']));?></td>
    </tr>
    <tr>
      <td>Taxable income:</td>
      <td><?php echo (($row_get_income['salary']+$row_get_income['capital_gains']+$row_get_income['agricultural_income']+$row_get_income['other_income'])-($row_get_income['HRA']+$row_get_income['medical_expense']+$row_get_income['housing_loan']));?></td>
    </tr>
    <tr>
      <td>Tax to be paid :</td>
      <td><?php echo ($ans);?></td>
    </tr>
</table>
  <p>&nbsp;</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" name="proceed_to_payment" id="proceed_t0_payment"  value="Proceed to payment" />
  </p>
  <input type="hidden" name="MM_update" value="form1" />
</form>
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($get_income);

mysql_free_result($login);

mysql_free_result($payment_status_finder);
?>
