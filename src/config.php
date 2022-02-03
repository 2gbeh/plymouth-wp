<?PHP
// START SESSION
session_start();

// SUPRERSS ERROR
error_reporting(E_ALL ^ E_DEPRECATED);
set_error_handler(function () {});

// NO CACHE
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// EXTEND VAR_DUMP
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);
ini_set('xdebug.var_display_max_depth', -1);

// MANIFEST
define('APPNAME', 'DE RACICOT CORPORATION');
define('ALIAS', 'DE RACICOT&reg;');
define('TAGLINE', '<b>TOP</b> rated remodeling company in Miami, Florida');
define('SUMMARY', ALIAS . ' is a licensed remodeling and renovation company based in Miami, Florida');
define('ABOUT', APPNAME . ' has been serving Miami Florida and surrounding Bay Areas since February 2022.');
define('DESCRIPTION', sprintf('%s. %s. %s %s', SUMMARY, ADDRESS, EMAIL, TEL));
define('KEYWORDS', 'DE RACICOT CORPORATION, DE RACICOT, DE RACICOT remodelling, Pierre Racicot remodeling, remodeling company, renovation company, Pierre Racicot');
define('OWNER', 'Pierre Racicot');
define('EMAIL', 'racicotpierre17@gmail.com');
define('TEL', '(561)346-0868');
define('ADDR_TOP', '1145 NW 155th LANE');
define('ADDR_END', 'APT. 304, Miami FL 33169');
define('ADDRESS', ADDR_TOP . ' ' . ADDR_END);
define('COPYRIGHT', 'Copyright &copy; 2022 ' . ALIAS . '.  All rights reserved.');
define('AUTHOR', 'Mark Legendary');
define('YEAR', '2022');
define('THEME-MAIN', '#fff200');
define('THEME-ACCENT', '');

// ISP
define('DOMAIN', 'deracicotcorp.com');
define('WEBMAIL', 'info@' . DOMAIN);
define('MAILTO', 'mailto:' . EMAIL);
define('HOSTED', '2022-02-03');
define('EXPIRE', '2023-02-02');

if ($_SERVER['SERVER_NAME'] == '127.0.0.1' || $_SERVER['SERVER_NAME'] == 'localhost') {
    define('SERVER', 'deracico');
    define('DATABASE', SERVER . '_db');
    define('USERNAME', 'root');
    define('PASSWORD', '');
} else {
    define('SERVER', 'deracnbc');
    define('DATABASE', SERVER . '_db');
    define('USERNAME', SERVER . '_root');
    define('PASSWORD', '_Strongp@ssw0rd');
}

// GLOBAL VARS
$pwa_url = 'https://'.DOMAIN.'/';
$pwa_arr = [
    'canonical' => $pwa_url.'index.php',
    'site_name' => 'DE RACICOT', 
    'title' => 'DE RACICOT CORPORATION', 
    'description' => 'Top rated remodeling company in Miami, Florida', 
    'url' => $pwa_url,
    'image' => $pwa_url.'img/preview.png', 
    'width' => '640',
    'height' => '320',
];
$PWA = $pwa_arr;

$SERVICES = array(
	'Drywall Installation',
	'Drywall Ceiling Panels',
	'Turkish Floor Tiles',
	'Classic Floor Tiles',
	'Concrete Drive Ways',
	'Gravel Drive Ways',	
	'Personal Bathroom Designs',
	'Executive Bathroom Designs',
	'Home Renovation',
	'Kitchen Renovation',
	'Executive Office Remodeling',
	'Startup Office Remodeling'
);

$OFFERS = 'We specialize in remodelling, residential and commercial concrete construction such as;
<b>' . implode(', ', $SERVICES) . '</b>, and more.';

$buf = '';
$i = 1;
foreach ($SERVICES as $e) {
    $buf .= '<li>
		<figure>
			<img src="img/thumb_' . $i . '.png" alt="" />
			<figcaption>' . $e . '</figcaption>
		</figure>
	</li>';
    $i++;
}
$TILES = '<ul>' . $buf . '</ul>';

$FORM_ATTRIB = 'action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="post" autocomplete="off" enctype="multipart/form-data"';

$SITEMAP = array('index.php', 'about.php', 'contact.php', 'login.php', 'admin.php');
$buf = '';
foreach ($SITEMAP as $p) {
    $buf .= '<a href="' . $p . '" title="' . $p . '">' . rtrim($p, '.php') . '</a>';
}

$_TOOLBAR = '<nav><div><a href="" title="Reload">&#8635;</a>' . $buf . '</div></nav>';