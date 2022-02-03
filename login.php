<?php
include_once 'src/config.php';
include_once 'jrad/__jrad__.php';
include_once 'src/Main.php';
// ACTION
$main->sign_in();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once 'src/inc_head.php';?>
	<title>Log in - <?php echo APPNAME; ?></title>
</head>
<body class="contact">
<table border="0">
<tr>
<td>
  <header>
	  <?php include_once 'src/inc_header.php';?>
  </header>
  <main>
    <wrap class="inner">
      <h1>Sign in to Admin Portal</h1>
       <form <?php echo $FORM_ATTRIB; ?>>
       	<label for="input_1">Username:</label>
        <input type="search" id="input_1" name="username" value="<?php echo $_POST['username']; ?>" required autofocus />

        <label for="input_2">Password:</label>
        <input type="password" id="input_2" name="password" value="<?php echo $_POST['password']; ?>" onDblClick="togglePassword(this)" />
        <p></p>
        <input type="submit" value="Sign in" />
       </form>
    </wrap>
  </main>
  <footer>
    <?php include_once 'src/inc_footer.php';?>
  </footer>
</td>
</tr>
</table>
</body>
</html>
