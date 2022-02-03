<?PHP
// MAIN CLASS
class Main
{
    private $jrad_mysql, $jrad_js;
    public function __construct()
    {
        $this->jrad_mysql = new jrad_mysql(DATABASE, USERNAME, PASSWORD);
        $this->jrad_js = new jrad_js();
        $this->jrad_mysql->set_table('enquiry');
    }
    final public function sign_in()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['username'] == USERNAME) {
                if ($_POST['password'] == PASSWORD) {
                    $_POST = null;
                    $_SESSION['whois'] = true;
                    $this->jrad_js->alert('Login successful!');
                    $this->jrad_js->redirect('admin.php');
                } else {
                    $this->jrad_js->alert('Password incorrect!');
                }

            } else {
                $this->jrad_js->alert('Username not found!');
            }

        }
    }
    final public function page_lock($sandbox = false)
    {
        if ($sandbox == false && !isset($_SESSION['whois'])) {
            $this->jrad_js->redirect('login.php');
        }

    }
    final public function create_enquiry()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['ip'] = $this->get_ip();
            $post = $this->filter($_POST);
            $result = $this->jrad_mysql->insert($post);
            if (is_numeric($result)) {
                $this->send_mail($post);
                $this->jrad_js->alert('Message sent! Thank you.');
            } else {
                $this->jrad_js->alert('Message not sent! Try again later.');
            }

        }
    }
    final public function read_enquiry()
    {
        $row = $this->jrad_mysql->select();
        $outp = array();
        if (is_array($row)) {
            krsort($row);
            $n = count($row);
            $i = $n - 1;
            $s = '0.00' . date('s');
            $outp['caption'] = '&#10004; &nbsp; Showing rows 0 - ' . $i . ' of ' . $n . ' (Query took ' . $s . ' secs)';
            $buffer = '';
            $sn = 0;
            foreach ($row as $assoc) {
                $sn++;
                $buffer .= '<tr>
					<td><input type="checkbox" disabled="disabled"></td>
					<td>' . $sn . '</td>
					<td>' . $assoc['sender_name'] . '</td>
					<td>' . $assoc['email_address'] . '</td>
					<td>' . $assoc['ip'] . '</td>
					<td>' . $assoc['message'] . '</td>
					<td>' . $assoc['date'] . '</td>
					<td><a onclick="onDelete(' . $assoc['id'] . ')" title="Delete Record">&#10006; &nbsp; Delete</a></td>
				</tr>';
            }
            $outp['tbody'] = $buffer;
        } else {
            $outp['caption'] = '&#9888; &nbsp; No records found.';
            $outp['tbody'] = '';
        }
        return (object) $outp;
    }
    final public function delete_enquiry()
    {
        if (isset($_GET['enquiry_id'])) {
            $this->jrad_mysql->delete('id', $_GET['enquiry_id']);
            $this->jrad_js->alert('Record deleted!');
        }
    }
    final public function filter($post)
    {
        $exclude = array('create', 'update', 'postback', 'id');
        $new = array();
        foreach ($post as $key => $value) {
            if (!is_array($value) && !in_array($key, $exclude)) {
                $value = trim($value);
                $value = stripslashes($value);
                $value = htmlspecialchars($value);
                $new[$key] = $value;
            }
        }
        return $new;
    }
    final public function get_ip()
    {
        // get IP
        if ($_SERVER['HTTP_CLIENT_IP']) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if ($_SERVER['HTTP_X_FORWARDED_FOR']) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if ($_SERVER['HTTP_X_FORWARDED']) {
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        } else if ($_SERVER['HTTP_FORWARDED_FOR']) {
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if ($_SERVER['HTTP_FORWARDED']) {
            $ip = $_SERVER['HTTP_FORWARDED'];
        } else if ($_SERVER['REMOTE_ADDR']) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = $_SERVER['SERVER_ADDR'];
        }

        // validate IP
        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
            return $ip;
        } else if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false) {
            return $ip;
        } else {
            return $ip;
        }

    }
    final public function send_mail($post)
    {
        $to = EMAIL;
        $subject = 'Enquiries from ' . DOMAIN;
        $message = wordwrap($post['message'], 70, '\r\n');
        $headers = array(
            'From' => $post['sender_name'] . ' <' . $post['email_address'] . '>',
            'X-Mailer' => 'PHP/' . phpversion(),
        );
        mail($to, $subject, $message, $headers);
    }
}

// INSTANTIATE MAIN CLASS
$main = new Main();
