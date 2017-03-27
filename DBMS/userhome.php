<?php require_once('Connections/new.php'); ?>
<?php require_once('Connections/new.php'); ?>
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

mysql_select_db($database_new, $new);
$query_login = "SELECT id FROM login WHERE sno = 1";
$login = mysql_query($query_login, $new) or die(mysql_error());
$row_login = mysql_fetch_assoc($login);
$totalRows_login = mysql_num_rows($login);

mysql_select_db($database_new, $new);
$query_linked = "SELECT a.id,name,dob,age,gender,address,designation,company,email,mobile FROM login a,signup b WHERE a.id=b.id";
$linked = mysql_query($query_linked, $new) or die(mysql_error());
$row_linked = mysql_fetch_assoc($linked);
$totalRows_linked = mysql_num_rows($linked);

mysql_select_db($database_new, $new);
$query_get_income = "SELECT l.id,salary, HRA, medical_expense, housing_loan, capital_gains, agricultural_income, other_income FROM income_details i,login l WHERE l.id=i.id";
$get_income = mysql_query($query_get_income, $new) or die(mysql_error());
$row_get_income = mysql_fetch_assoc($get_income);
$totalRows_get_income = mysql_num_rows($get_income);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="javascript">
function direction()
{
	salary=document.form1.hidden_salary.value;
	if(salary==0)
	{window.location="http://localhost/DBMS/income_details.php";}
	else
	{window.location="http://localhost/DBMS/already_entered.php";}
}
function direction2()
{
	window.location="http://localhost/DBMS/income_details_update.php";
}
function direction3()
{
	salary=document.form2.hiddensal.value;
	if(salary>0)
	{window.location="http://localhost/DBMS/tax_details.php";}
	else
	{window.location="http://localhost/DBMS/testfail.php";}
}
</script>
<title>Untitled Document</title>
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="assets/demo.css">
<link rel="stylesheet" href="assets/header-second-bar.css">
<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
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
<header class="header-two-bars">
  <div class="header-second-bar">

		<div class="header-limiter">
			<h2><a>Welcome
  <?php echo $row_linked['name']; ?></a></h2>

			<nav>
			<a>
			<!-- #BeginDate format:acAm1 -->Wed, April 13, 2016<!-- #EndDate -->
			</a>
			  <a href="user_profile_view.php"><i class="fa fa-file-text"></i> View Profile</a>
				<a href="profile_edit.php"><i class="fa fa-cogs"></i> Edit Profile</a>
			</nav>
		</div>

	</div>
</header>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<p>
<div class="container">
  <form id="form1" name="form1" method="post" action="">
  <p><a>&nbsp;</a>
    <input name="hidden_salary" type="hidden" id="hidden_salary" value="<?php echo $row_get_income['salary']; ?>" />
    <input name="hiddenid" type="hidden" id="hiddenid" value="<?php echo $row_login['id']; ?>" />
  </p>
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td><p>&nbsp;</p>
        <p>Enter income details</p></td>
      <td><p>&nbsp;
        </p>
        <p>
          <input name="input" type="button" onclick="direction()" value="Go"/>
        </p></td>
    </tr>
    <tr>
      <td><p>Updation of income details
        </p></td>
      <td><input type="button" name="income_update" id="income_update" onclick="direction2()" value="Go" /></td>
    </tr>
  </table>
</form>
<form id="form2" name="form2" method="POST">
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="376">Tax Calculation</td>
      <td width="89"><input type="button" name="calculate" id="calculate" onclick="direction3()" value="Calculate" /></td>
    </tr>
  </table>
  <p>
    <input name="hiddensal" type="hidden" id="hiddensal" value="<?php echo $row_get_income['salary']; ?>" />
  </p>
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="193">&nbsp;</td>
      <td width="193"><input type="button" name="logout" id="logout" onclick=window.location="http://localhost/DBMS/home.html" value="Logout" /></td>
      <td width="64">&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
 
</form>
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($login);

mysql_free_result($linked);

mysql_free_result($get_income);
?>
