<?php require_once('../Connections/new.php'); ?>
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
$query_total_users = "select count(*) from signup";
$total_users = mysql_query($query_total_users, $new) or die(mysql_error());
$row_total_users = mysql_fetch_assoc($total_users);
$totalRows_total_users = mysql_num_rows($total_users);

mysql_select_db($database_new, $new);
$query_paid_users = "select count(*) from signup where payment_status='Y'";
$paid_users = mysql_query($query_paid_users, $new) or die(mysql_error());
$row_paid_users = mysql_fetch_assoc($paid_users);
$totalRows_paid_users = mysql_num_rows($paid_users);

mysql_select_db($database_new, $new);
$query_yet_to_pay_users = "select count(*) from signup where payment_status='N'";
$yet_to_pay_users = mysql_query($query_yet_to_pay_users, $new) or die(mysql_error());
$row_yet_to_pay_users = mysql_fetch_assoc($yet_to_pay_users);
$totalRows_yet_to_pay_users = mysql_num_rows($yet_to_pay_users);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Flat Charts Flat Responsive Widget Template :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Flat Charts Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphgraph Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!--// css -->
<script src="js/jquery-1.11.1.min.js"></script>	
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body>
		
	
		 <div class="graph" align="center">
		 	<canvas id="pie" height="400" width="300" align="center"></canvas>
<div class="legend">
		  <div id="os-Win-lbl" align="center"> <span></span></div>
			<div id="os-Mac-lbl" align="center">Paid Users <span><?php echo $row_paid_users['count(*)']; ?> </span></div>
			<div id="os-Other-lbl" align="center">Users Yet to Pay<span><?php echo $row_yet_to_pay_users['count(*)']; ?></span></div>
</div>

<p>&nbsp; </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form name="form1" method="post" action="">
  <input name="hidden_paid_users" type="hidden" id="hidden_paid_users" value="<?php echo $row_paid_users['count(*)']; ?>">
  <input name="hidden_yet_to_pay_users" type="hidden" id="hidden_yet_to_pay_users" value="<?php echo $row_yet_to_pay_users['count(*)']; ?>">
  <input name="hidden_total_users" type="hidden" id="hidden_total_users" value="<?php echo $row_total_users['count(*)']; ?>">
</form>
<p>&nbsp; </p>

<script>
		paid=document.form1.hidden_paid_users.value;
		not_paid=document.form1.hidden_yet_to_pay_users.value;
		total=document.form1.hidden_total_users.value;
		paid_percent=(paid/total)*100;
		not_paid_percent=(not_paid/total)*100;
		var pieData = [
				{
					value: paid_percent,
					color:"#1d365f"
				},
				
				{
					value : not_paid_percent,
					color : "#f9e03b"
				}
			
			];
	

	var myPie = new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
	
	      </script>
</body>
</html>
<?php
mysql_free_result($total_users);

mysql_free_result($paid_users);

mysql_free_result($yet_to_pay_users);
?>
