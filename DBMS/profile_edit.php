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
  $updateSQL = sprintf("UPDATE signup SET name=%s, dob=%s, age=%s, gender=%s, address=%s, designation=%s, company=%s, email=%s, mobile=%s, password=%s WHERE id=%s",
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
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_new, $new);
  $Result1 = mysql_query($updateSQL, $new) or die(mysql_error());

  $updateGoTo = "profile_update_success.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_new, $new);
$query_Recordset1 = "SELECT l.id,name, dob, age, gender, address, designation, company, email, mobile,s. password FROM signup s,login l where l.id=s.id";
$Recordset1 = mysql_query($query_Recordset1, $new) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
      <td><input name="id" type="text" id="id" value="<?php echo $row_Recordset1['id']; ?>" readonly/></td>
    </tr>
    <tr>
      <td style="color: #000000">Name :</td>
      <td><input name="name" type="text" id="name" value="<?php echo $row_Recordset1['name']; ?>" /></td>
    </tr>
    <tr>
      <td style="color: #000000">Date of Birth:</td>
      <td><input name="dob" type="text" id="dob" value="<?php echo $row_Recordset1['dob']; ?>" /></td>
    </tr>
    <tr>
      <td style="color: #000000"><label for="age">Age: </label>
&nbsp;</td>
      <td><input name="age" type="text" id="age" value="<?php echo $row_Recordset1['age']; ?>" /></td>
    </tr>
    <tr>
      <td style="color: #000000">Gender:&nbsp;</td>
      <td><label>
      <input <?php if (!(strcmp($row_Recordset1['gender'],"M"))) {echo "checked=\"checked\"";} ?> type="radio" name="Gender" value="M" id="Gender_0" />
      Male</label>
    <br />
    <label>
      <input <?php if (!(strcmp($row_Recordset1['gender'],"F"))) {echo "checked=\"checked\"";} ?> type="radio" name="Gender" value="F" id="Gender_1" />
      Female</label></td>
    </tr>
    <tr>
      <td style="color: #000000">Address:</td>
      <td><textarea name="address" cols="45" rows="5" id="address"><?php echo $row_Recordset1['address']; ?></textarea></td>
    </tr>
    <tr>
      <td style="color: #000000">Designation:&nbsp;&nbsp;</td>
      <td><input name="desgn" type="text" id="desgn" value="<?php echo $row_Recordset1['designation']; ?>" /></td>
    </tr>
    <tr>
      <td style="color: #000000">Company name:</td>
      <td><input name="company" type="text" id="company" value="<?php echo $row_Recordset1['company']; ?>" /></td>
    </tr>
    <tr>
      <td style="color: #000000">Email:</td>
      <td><input name="email" type="text" id="email" value="<?php echo $row_Recordset1['email']; ?>" /></td>
    </tr>
    <tr>
      <td style="color: #000000">Password:</td>
      <td><input name="pass" type="password" id="pass" value="<?php echo $row_Recordset1['password']; ?>" /></td>
    </tr>
    <tr>
      <td style="color: #000000">Mobile No:</td>
      <td><input name="mob_no" type="text" id="mob_no" value="<?php echo $row_Recordset1['mobile']; ?>" /></td>
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
  </p>
  <input type="hidden" name="MM_update" value="form1" />
</form>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
