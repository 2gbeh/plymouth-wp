<?php
include_once 'src/config.php';
include_once 'jrad/__jrad__.php';
include_once 'src/Main.php';
// ACTION
$main->page_lock();
$main->delete_enquiry();
$display = $main->read_enquiry();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once 'src/inc_head.php';?>
	<title>Admin Portal - <?php echo APPNAME; ?></title>  
</head>
<body class="admin">
<table border="0">
<tr>
<td>
  <header>
	  <?php include_once 'src/inc_header.php';?>
  </header>
  <main>
    <wrap>
      <h1>Manage Enquires</h1>
      <table border="0">
        <caption id="caption">
        	<a onclick="onHide('caption')" title="Hide">&times;</a>
					<?php echo $display->caption; ?>
        </caption>
        <tr>
          <th><input type="checkbox" disabled /></th>
          <th>#</th>
          <th>Sender's Name</th>
          <th>Email Address</th>
          <th>IP Address</th>
          <th>Message</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
        <tbody>
        <?php echo $display->tbody; ?>
				<!--
					<tr>
            <td><input type="checkbox" disabled /></td>
            <td>1</td>
            <td>John Doe</td>
            <td>john_doe@example.com</td>
            <td>197.210.52.181</td>
            <td>Hello</td>
            <td>2020-07-04 22:45:00</td>
            <td><a onclick="onDelete(1)" title="Delete Record">&#10006; &nbsp; Delete</a></td>
          </tr>
          <tr>
            <td><input type="checkbox" disabled /></td>
            <td>2</td>
            <td>Jane Doe</td>
            <td>jane_doe@example.com</td>
            <td>197.210.52.182</td>
            <td>Hi</td>
            <td>2020-07-04 22:46:00</td>
            <td><a onclick="onDelete(2)" title="Delete Record">&#10006; &nbsp; Delete</a></td>
          </tr>
          -->
        </tbody>
      </table>
    </wrap>
    <p>&nbsp;</p>
  </main>
  <footer>
    <?php include_once 'src/inc_footer.php';?>
  </footer>
</td>
</tr>
</table>
</body>
</html>
