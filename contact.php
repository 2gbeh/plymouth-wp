<?php
include_once 'src/config.php';
include_once 'jrad/__jrad__.php';
include_once 'src/Main.php';
// ACTION
$main->create_enquiry();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once 'src/inc_head.php';?>
	<title>Contact Us - <?php echo APPNAME; ?></title>
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
      <h1>Send us a message</h1>
       <form <?php echo $FORM_ATTRIB; ?>>
       	<label for="input_1">Enter Name:</label>
        <input type="search" id="input_1" name="sender_name" value="<?php echo $_POST['sender_name']; ?>" placeholder="Personal or business name" required autofocus />

        <label for="input_2">Enter Email:</label>
        <input type="email" id="input_2" name="email_address" value="<?php echo $_POST['email_address']; ?>" placeholder="example@domian.com" required />

       	<label for="input_3">Enter Message:</label>
        <textarea id="input_3" name="message" placeholder="Type message here.." required><?php echo $_POST['message']; ?></textarea>
        <p></p>
        <input type="submit" value="Send Message" />
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
