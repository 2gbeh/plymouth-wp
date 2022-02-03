<wrap>
  <ul>
    <li>
      <div>Contact Info</div>
      <div><a>
        <img src="img/ico_support.png" alt="Telephone:" />
        <?php echo TEL; ?>
      </a></div>
      <div><a href="<?php echo MAILTO; ?>">
        <img src="img/ico_email.png" alt="Email:" />
        <?php echo WEBMAIL; ?>
      </a></div>
      <div><a>
        <img src="img/ico_pin.png" alt="Address:" style="width:15px;" />
        <?php echo ADDR_TOP . '<br/>' . ADDR_END; ?>
      </a></div>
    </li>

    <li>
      <div><a href="#">^ TOP</a></div>
      <div><a href="index.php">
        <img src="img/ico_home.png" alt="" />
        Home
      </a></div>
      <div><a href="about.php">
        <img src="img/ico_info.png" alt="" />
        About Us
      </a></div>
      <div><a href="contact.php">
        <img src="img/ico_contact.png" alt="" />
        Contact Us
      </a></div>
    </li>

    <li>
      <div>Social Media Channels</div>
      <div><a href="https://www.facebook.com/" target="_new">
        <img src="img/logo_fb.png" alt="" />
        Facebook
      </a></div>
      <div><a href="https://www.twitter.com/" target="_new">
        <img src="img/logo_tw.png" alt="" />
        Twitter
      </a></div>
      <div><a href="https://www.instagram.com/" target="_new">
        <img src="img/logo_ig.png" alt="" />
        Instagram
      </a></div>
    </li>
  </ul>
</wrap>

<address><?php echo COPYRIGHT; ?></address>

<!-- #Service Worker -->
<script type="text/javascript">      
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('./js/service-worker.js', {scope: './'})
    .then(function(registration) {console.log('Service worker registered', registration);})
    .catch(function(error) {console.log('Service worker not registered', error);});
  }
</script>
<!-- /Service Worker -->