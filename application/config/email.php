<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.example.com'; // Replace with your SMTP host
$config['smtp_port'] = 587;               // Replace with your SMTP port
$config['smtp_user'] = 'your-email@example.com'; // Replace with your SMTP username
$config['smtp_pass'] = 'your-password';         // Replace with your SMTP password
$config['mailtype'] = 'html';
$config['charset']  = 'utf-8';
$config['newline']  = "\r\n";
