<?php include_once 'src/config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once 'src/inc_head.php';?>
	<title>About Us - <?php echo APPNAME; ?></title>
</head>
<body class="about">
<table border="0">
<tr>
<td>
  <header>
	  <?php include_once 'src/inc_header.php';?>
  </header>
  <main>
    <wrap class="outer">
      <h1>About <?php echo APPNAME; ?></h1>
      <figure>
        <img src="img/wall_3.png" alt="" />
        <figcaption><?php echo ADDRESS; ?></figcaption>
      </figure>
      <h3>
				<?php echo SUMMARY; ?>
        <p></p>
        <?php echo ABOUT; ?>
	    </h3>
      <h3>
        <?php echo $OFFERS; ?>
      </h3>
      <h3>
        Contact us on <b><?php echo TEL; ?></b> for more information.
			</h3>
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

