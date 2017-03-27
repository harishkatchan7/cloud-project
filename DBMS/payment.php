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
  $insertSQL = sprintf("INSERT INTO paid_customers (id, tax_amt) VALUES (%s, %s)",
                       GetSQLValueString($_POST['hiddenField'], "int"),
                       GetSQLValueString($_POST['hiddentaxamt'], "double"));

  mysql_select_db($database_new, $new);
  $Result1 = mysql_query($insertSQL, $new) or die(mysql_error());

  $insertGoTo = "testsuc.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO card (cardno, cvv, `date`) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['card_no'], "int"),
                       GetSQLValueString($_POST['card_no2'], "int"),
                       GetSQLValueString($_POST['dob'], "date"));

  mysql_select_db($database_new, $new);
  $Result1 = mysql_query($insertSQL, $new) or die(mysql_error());
}

mysql_select_db($database_new, $new);
$query_get_income = "SELECT l.id,salary, HRA, medical_expense, housing_loan, capital_gains, agricultural_income, other_income FROM income_details i,login l WHERE l.id=i.id";
$get_income = mysql_query($query_get_income, $new) or die(mysql_error());
$row_get_income = mysql_fetch_assoc($get_income);
$totalRows_get_income = mysql_num_rows($get_income);

mysql_select_db($database_new, $new);
$query_payment_set = "SELECT * FROM paid_customers";
$payment_set = mysql_query($query_payment_set, $new) or die(mysql_error());
$row_payment_set = mysql_fetch_assoc($payment_set);
$totalRows_payment_set = mysql_num_rows($payment_set);
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
				<li><a href="tax_details.php" accesskey="2" title="">Tax Details</a></li>
				<li class="current_page_item"><a href="payment.php" accesskey="3" title="">Payment</a></li>
                <li><a href="logout.php" accesskey="2" title="">Logout</a></li>
			</ul>
		</div>
	</div>
    </div>
</div>
<div class="container">
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <p>
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
  &nbsp;&nbsp;
  <input name="hiddenField" type="hidden" id="hiddenField" value="<?php echo $row_get_income['id']; ?>" />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
  <p>
  <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PAYMENT</h2>
  </p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td>Tax to be paid</td>
      <td><?php echo ($ans);?></td>
    </tr>
    <tr>
      <td>Mode of payment</td>
      <td><label>
      <input type="radio" name="Gender" value="M" id="Gender_0" />
      credit card
    </label>
    <br />
    <label>
      <input type="radio" name="Gender" value="F" id="Gender_1" /> 
      debit cart
    </label></td>
    </tr>
    <tr>
      <td>Enter card no.</td>
      <td><input type="text" name="card_no" id="card_no" pattern="[0-9]{16}" required/></td>
    </tr>
    <tr>
      <td>Expiry date&nbsp;</td>
      <td><input name="dob" type="date" id="dob" value="yyyy/mm/dd" /></td>
    </tr>
    <tr>
      <td>CCV&nbsp;</td>
      <td><input type="text" name="card_no2" id="card_no2" pattern="[0-9]{3}" required /></td>
    </tr>
</table>
  <p>&nbsp;</p>
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="150">&nbsp;</td>
      <td width="92"><input name="pay" type="submit" id="pay" onclick=window.location="http://localhost/DBMS/finish.php" value="PAY"/></td>
      <td width="208">&nbsp;</td>
    </tr>
  </table>
  <p>
    <input name="hiddentaxamt" type="hidden" id="hiddentaxamt" value="<?php echo ($ans);?>" />
    <br />
  </p>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</div>
</body>
</html>
<?php
mysql_free_result($get_income);

mysql_free_result($payment_set);
?>
