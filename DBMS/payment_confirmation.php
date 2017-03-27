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
$query_payment_status_get = "select payment_status from signup s,login l where s.id=l.id";
$payment_status_get = mysql_query($query_payment_status_get, $new) or die(mysql_error());
$row_payment_status_get = mysql_fetch_assoc($payment_status_get);
$totalRows_payment_status_get = mysql_num_rows($payment_status_get);
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
<script language="javascript">
function direction()
{
	p=document.form1.hidden_payment_status.value;
	if(p=='Y')
	{window.location="http://localhost/DBMS/paymentfail.php";}
	else
	{window.location="http://localhost/DBMS/payment.php";}
}
</script>
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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<p>&nbsp;</p>
<h2>&nbsp;Are you sure&nbsp;that you want to proceed to payment ?</h2>
<form id="form1" name="form1" method="post" action="">
   &nbsp;&nbsp;
   <input name="hidden_payment_status" type="hidden" id="hidden_payment_status" value="<?php echo $row_payment_status_get['payment_status']; ?>" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input type="button" name="pay" id="pay" value="Pay" onclick="direction()"/>
</form>
</p>
<p>( If incorrect details are produced you will have to face severe actions taken by the Govt. of India)</p>
</body>
</html>
<?php
mysql_free_result($payment_status_get);
?>
