<?php

class AjaxRequests
{
  public function __construct()
  {
    return $this;
  }

  public function send_contact_message()
  {
    add_action( 'wp_ajax_'.__FUNCTION__, array( $this, 'sendContactMessage'));
    add_action( 'wp_ajax_nopriv_'.__FUNCTION__, array( $this, 'sendContactMessage'));
  }

  public function sendContactMessage()
  {
    extract($_POST);

    $return = array(
      'error' => 0,
      'msg'   => '',
      'missing_elements' => [],
      'missing' => 0,
      'passed_params' => false
    );

    $return['passed_params'] = $_POST;

    if(empty($_POST['keresztnev'])) $return['missing_elements'][] = 'keresztnev';
    if(empty($_POST['vezeteknev'])) $return['missing_elements'][] = 'vezeteknev';
    if(empty($_POST['subject'])) $return['missing_elements'][] = 'subject';
    if(empty($_POST['telefon'])) $return['missing_elements'][] = 'telefon';
    if(empty($_POST['email'])) $return['missing_elements'][] = 'email';
    if(empty($_POST['message'])) $return['missing_elements'][] = 'message';

    $captcha = $this->checkCaptcha( $_POST['g-recaptcha-response'] );

    if ($captcha['success'] === false) {
      $return['error']  = 1;
      $return['msg']    = __('Jelölje be, hogy Ön nem robot! SPAM-védelem miatt szükséges, hogy igazolja magát.', TD);
      $return['missing']= count($return['missing_elements']);
      $return['captcha'] = $captcha;
      $this->returnJSON($return);
    }

    $return['captcha'] = $captcha;

    if(!empty($return['missing_elements'])) {
      $return['error']  = 1;
      $return['msg']    = 'Kérjük, hogy töltse ki az összes mezőt a megrendelés küldéséhez.';
      $return['missing']= count($return['missing_elements']);
      $this->returnJSON($return);
    }

    // Validate Email
    $email = $this->test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $return['error']  = 1;
      $return['msg']    = __('Nem megfelelő e-mail cím. Kérjük, hogy email címet adjon meg. Formátum minta.: mail@example.com', TD);
      $return['missing']= count($return['missing_elements']);
      $return['missing_elements'][]= 'email';
      $this->returnJSON($return);
    }



    $to = get_option('admin_email');

    // Email setup
    $subject  = 'Új üzenet: '.$_POST['subject'] . ', '.$_POST['kategoria'];

    ob_start();
  	  include(locate_template('templates/mails/uzenetkuldes.php'));
      $message = ob_get_contents();
		ob_end_clean();

    //add_filter( 'wp_mail_from', array($this, 'getMailSender') );
    add_filter( 'wp_mail_from_name', array($this, 'getMailSenderName') );
    add_filter( 'wp_mail_content_type', array($this, 'getMailFormat') );

    $headers    = array();
    $headers[]  = 'Reply-To: '.$_POST['vezeteknev'].' '.$_POST['keresztnev'].' <'.$_POST['email'].'>';

    /* */
    $alert = wp_mail( $to, $subject, $message, $headers );

    if(!$alert) {
      $return['error']  = 1;
      $return['msg']    = __('Az üzenetét jelenleg nem tudjuk kézbesíteni. Próbálja meg később.', TD);
      $this->returnJSON($return);
    }
    /* */

    echo json_encode($return);
    die();
  }

  public function getMailFormat(){
      return "text/html";
  }

  public function getMailSender($default)
  {
    return get_option('admin_email');
  }

  public function getMailSenderName($default)
  {
    return get_option('blogname', 'Wordpress');
  }

  private function returnJSON($array)
  {
    echo json_encode($array);
    die();
  }

  private function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  private function checkCaptcha( $code )
  {
    $resp = array();
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $params = array(
      'secret' => CAPTCHA_PRIVATE,
      'response' => $code,
      'remoteip' => $_SERVER['REMOTE_ADDR'],
    );

    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //execute post
    $resp = curl_exec($ch);

    //close connection
    curl_close($ch);

    return json_decode($resp, true);
  }

}
?>
