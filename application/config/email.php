<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Codeigniter Email Library Setting
 *
 * Ref:https://www.codeigniter.com/user_guide/libraries/email.html
 *
 * Overriding Word Wrapping
 *
 * example:
 * {unwrap}a_long_link_that_should_not_be_wrapped.html{/unwrap}
 *
 */

//localhost
//$config['protocol']    = 'mail';

//smtp
$config['protocol']    = 'smtp';
$config['smtp_host']    = 'smtp.mailtrap.io';
$config['smtp_port']    = '2525';
$config['smtp_timeout'] = '7';
$config['smtp_user']    = '3165d93ccd00b0';
$config['smtp_pass']    = 'cbf21159427c09';


//optional
//$config['smtp_timeout']    = '5';
//$config['smtp_crypto']    = 'tls';
//$config['charset']    = 'utf-8';
//$config['priority']    = '3';
$config['newline']    = "\r\n";
$config['mailtype'] = 'html'; //text or html
$config['validation'] = false; // bool whether to validate email or not

