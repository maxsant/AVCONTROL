<?php

require '../includes/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

require_once('../config/connection.php');
require_once('../models/User.php');

class Emails extends PHPMailer
{
    //Credenciales del correo para envio
    protected $gestorEmail = 'sapdevertzone@gmail.com';
    protected $gestorPassword = 'oitw nvgh eqyf vpac';
    
    public function confirmedEmail($email)
    {
        $tbody = '';
        $user = new User();
        $userData = $user->getUserByEmail($email);
        
        $tbody .= '<tr>
              <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;font-size:0px"><img src="https://eetetms.stripocdn.email/content/guids/CABINET_67e080d830d87c17802bd9b4fe1c0912/images/55191618237638326.png" alt="" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none" width="100"></td>
             </tr>
             <tr>
              <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-bottom:10px"><h1 style="Margin:0;font-family:arial, "helvetica neue", helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:46px;font-style:normal;font-weight:bold;line-height:46px;color:#333333">Confirmar Correo Electronico</h1></td>
             </tr>
             <tr>
              <td align="center" class="es-m-p0r es-m-p0l" style="Margin:0;padding-top:5px;padding-right:40px;padding-bottom:5px;padding-left:40px"><p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">Has recibido un correo electronico del sitio web de AVCONTROL. Si deseas obtener los servicios y acceso a la aplicación web debes confirmar tu correo electronico.</p></td>
             </tr>
             <tr>
              <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:5px"><p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">SI no te has registrado en nuestra aplicación. Puedes ignorar este mensaje</p></td>
             </tr>
             <tr>
              <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px"><span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#5C68E2;border-width:0px;display:inline-block;border-radius:6px;width:auto"><a href="" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none !important;mso-line-height-rule:exactly;color:#FFFFFF;font-size:20px;padding:10px 30px 10px 30px;display:inline-block;background:#5C68E2;border-radius:6px;font-family:arial, "helvetica neue", helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center;letter-spacing:0;mso-padding-alt:0;mso-border-alt:10px solid #5C68E2;border-left-width:30px;border-right-width:30px">CONFIRMAR</a></span></td>
             </tr>
             <tr>
              <td align="center" class="es-m-p0r es-m-p0l" style="Margin:0;padding-top:5px;padding-right:40px;padding-bottom:5px;padding-left:40px"><p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">Una vez que confirmes el correo, aceptas suscribirte a los servicios de AVCONTROL</p></td>
         </tr>';
        
        $this->isSMTP();
        $this->Host       = 'smtp.gmail.com';
        $this->Port       = 587;
        $this->SMTPAuth   = true;
        $this->SMTPSecure = 'tls';
        
        $this->Username   = $this->gestorEmail;
        $this->Password   = $this->gestorPassword;
        $this->setFrom($this->gestorEmail, "COnfirmar Correo ELectronico - ".$userData['id']);
        
        $this->CharSet = 'UTF8';
        $this->addAddress($email);
        $this->isHTML(true);
        $this->Subject = 'Confirmar Correo ELectronico';
        
        $body = file_get_contents('../assets/templates/emailConfirmed.html');
        
        $body = str_replace('$tbldetalle', $tbody, $body);
        
        $this->Body = $body;
        $this->AltBody = strip_tags('Confirmar Correo ELectronico');
        
        $this->Send();
    }
}

?>