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
  $updateSQL = sprintf("UPDATE admin_user_id_get SET user_id=%s WHERE sno=%s",
                       GetSQLValueString($_POST['view'], "int"),
                       GetSQLValueString($_POST['hiddensno'], "int"));

  mysql_select_db($database_new, $new);
  $Result1 = mysql_query($updateSQL, $new) or die(mysql_error());

  $updateGoTo = "admin_individual_user_view2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST['delete'])) && ($_POST['delete'] != "")) {
  $deleteSQL = sprintf("DELETE FROM signup WHERE id=%s",
                       GetSQLValueString($_POST['delete'], "int"));

  mysql_select_db($database_new, $new);
  $Result1 = mysql_query($deleteSQL, $new) or die(mysql_error());

  $deleteGoTo = "admin_user_print.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_new, $new);
$query_Recordset1 = "select id from signup";
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
			  <li class="current_page_item"><a href="admin_portal.php" accesskey="1" title="">Admin Home</a></li>
				<li><a href="home.html" accesskey="2" title="">Logout</a></li>
			</ul>
		</div>
	</div>
    </div>
</div>
<div class="container">
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">

  <label for="user_id2"><br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    Enter the user id to view the income details of that user
    <br />
    <br />
    Enter User ID:</label>
  <label for="view"></label>
  <select name="view" id="view">
    <?php
do {  
?>
    <option value="<?php echo $row_Recordset1['id']?>"><?php echo $row_Recordset1['id']?></option>
    <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
  </select>
  <label for="user_id2"> </label>
  <input type="submit" name="fetch" id="fetch" value="go" />
  <input name="hiddensno" type="hidden" id="hiddensno" value="1" />
  <input type="hidden" name="MM_update" value="form1" />
  <br />
</form>
<form id="form2" name="form2" method="post" action="">
  <p>&nbsp;</p>
  <p><span class="container">Enter the user id to delete the entire details of that user <br />
    <br />
    Enter User ID:
    <label for="delete"></label>
    <select name="delete" id="delete" title="<?php echo $_POST['delete']; ?>">
      <?php
do {  
?>
      <option value="<?php echo $row_Recordset1['id']?>"><?php echo $row_Recordset1['id']?></option>
      <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
    </select>
</label>
<input type="submit" name="fetch2" id="fetch2" value="go" />
  </span></p>
</form>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
