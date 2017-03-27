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
  $updateSQL = sprintf("UPDATE login SET id=%s, user_password=%s WHERE sno=%s",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['sno'], "int"));

  mysql_select_db($database_new, $new);
  $Result1 = mysql_query($updateSQL, $new) or die(mysql_error());
}

mysql_select_db($database_new, $new);
$query_Recordset1 = "SELECT * FROM login";
$Recordset1 = mysql_query($query_Recordset1, $new) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['id'])) {
  $loginUsername=$_POST['id'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "userhome.php";
  $MM_redirectLoginFailed = "testfail.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_new, $new);
  
  $LoginRS__query=sprintf("SELECT id, password FROM signup WHERE id=%s AND password=%s",
    GetSQLValueString($loginUsername, "int"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $new) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Login</title>
<link rel="stylesheet" href="css1/style.css">
<style type="text/css">
body,td,th {
	font-family: "rem/1.5 Open Sans", sans-serif;
}
</style>

<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
</head>

<!--body class="align"-->
<body background="bg.png">
<div id="wrapper">
	<div id="header-wrapper">
<div id="header" class="container" >
		<div id="logo">
			<h1><a href="#">Income Tax of India</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li><a href="home.html" accesskey="1" title="">Homepage</a></li>
				<li class="current_page_item"><a href="login.php" accesskey="2" title="">Login</a></li>
				<li><a href="signup.php" accesskey="3" title="">Sign Up</a></li>
			</ul>
		</div>
	</div>
    </div>
    </div>
    <div class="align">
<div class="site__container">

    <div class="grid__container">

<form ACTION="<?php echo $loginFormAction; ?>" id="form1" name="form1" method="POST" class="form form--login">

    <p>
      <input name="sno" type="hidden" id="sno" value="1" />
    </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="form__field">
        <label class="fontawesome-user" for="login__username"><span class="hidden">Username</span></label>
        <input type="text" name="id" id="id"  class="form__input" placeholder="Username" required/>
    </div>
  <div class="form__field">
          <label class="fontawesome-lock" for="login__password"><span class="hidden">Password</span></label>
        <input type="password" name="password" id="password" class="form__input" placeholder="Password" required/>
    </div>


  <div class="form__field">
    <input type="submit" name="login" id="login" value="Login" />
    </div>

  <input type="hidden" name="MM_update" value="form1" />
</form>

 <p class="text--center"><span class="coloring_not_a_member">Not a member?</span> <a href="signup.php">Sign up now</a> <span class="fontawesome-arrow-right"></span></p>

 </div>

  </div>
 </div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
