<?php include_once 'src/config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once 'src/inc_head.php';?>
	<title><?php echo APPNAME; ?></title>
</head>
<body class="home">
<table border="0">
<tr>
<td>
  <header>
	  <?php include_once 'src/inc_header.php';?>
  </header>
  <main>
    <section class="wall">
    <wrap>
        <div class="caption">
          <b id="demo"><?php echo APPNAME; ?></b>
          <ul><li>&nbsp;</li></ul>
          <article><?php echo SUMMARY; ?></article>
          <a href="about.php">About Us</a> &nbsp;
          <a href="contact.php">Contact Us</a>
        </div>
    </wrap>
    </section>

    <section class="banner">
    <wrap>
      <table border="0">
     	<tr>
        <td style="color:#555;">Looking for a <?php echo TAGLINE; ?>?</li>
	      <td align="right">
          <form <?php echo $FORM_ATTRIB; ?>>
            <input type="email" name="email" placeholder="Enter Email Address" required />
            <input type="submit" value="Get a quote" disabled />
          </form>
         </td>
        </tr>
        </table>
    </wrap>
    </section>


    <section class="gallery">
    <wrap>
      <?php echo $TILES; ?>
    </wrap>
    </section>
  </main>
  <footer>
    <?php include_once 'src/inc_footer.php';?>
  </footer>
</td>
</tr>
</table>
<script type="text/javascript">
	onLoad(5000, 30000);
</script>
</body>
</html>
