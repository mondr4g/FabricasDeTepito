<?php
    
    function sendMail($destinatario,$id_compra,$total) {
        require_once("../PHPmailer/PHPMailerAutoload.php");
        require_once( '../DB_FUNCTIONS/DB_Functions.php');
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->isHTML();

        // Informacion correo remitente
        $mail->Username = 'elyisusRR99@gmail.com';
        $mail->Password = 'PutaMadre99';
        $mail->SetFrom('elyisusRR99@gmail.com','non-reply');

        // Info correo a enviar
        $mail->Subject = 'Ticket Compra en Liverpuri';
        $mail->AddAddress($destinatario);

        $Ps=sale_details($id_compra);//Aqui estan los productos que corresponden a su compra
        $msg2="";
        foreach($Ps as $key=>$producto) {
            $cant = $producto['cantidad'] + 1;
            $msg2 .= "<tr cellpadding='10px' cellspacing='0' align='center' style='border: solid black; border-size: 1px;'> <td> ". $producto['nombre'] . "</td>" . "<td> ". $cant . "</td>" . "<td> $ MXN". $producto['precio'] . "</td>". "</tr>";
        }                                                                            
        
        $msg2 .= "<tr cellpadding='10px' cellspacing='0' align='center' style='border: solid black; border-size: 1px;'> <td> </td>" . "<td> Total: </td>". "<td> $ MXN ". $total . "</td> </tr>";

        $msg = ' 
        
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
        
        <head>
            <meta charset="UTF-8">
            <meta content="width=device-width, initial-scale=1" name="viewport">
            <meta name="x-apple-disable-message-reformatting">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="telephone=no" name="format-detection">
            <title></title>
            <!--[if (mso 16)]>
            <style type="text/css">
            a {text-decoration: none;}
            </style>
            <![endif]-->
            <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
            <!--[if !mso]><!-- -->
            <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,900&display=swap" rel="stylesheet">
            <!--<![endif]-->
            <!--[if gte mso 9]>
        <xml>
            <o:OfficeDocumentSettings>
            <o:AllowPNG></o:AllowPNG>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
        </head>
        
        <body>
            <div class="es-wrapper-color">
                <!--[if gte mso 9]>
                    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                        <v:fill type="tile" color="#f6f6f6"></v:fill>
                    </v:background>
                <![endif]-->
                <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="esd-email-paddings" valign="top">
                                <table cellpadding="0" cellspacing="0" class="es-content esd-header-popover" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="es-adaptive esd-stripe" esd-custom-block-id="17287" align="center" bgcolor="#f11968" style="background-color: #f11968;">
                                                <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-structure es-p10" align="left">
                                                                <!--[if mso]><table width="580"><tr><td width="280" valign="top"><![endif]-->
                                                                <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="280" align="left">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="es-infoblock esd-block-text es-m-txt-c" align="left">
                                                                                                <p>LIVERPURI</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td><td width="20"></td><td width="280" valign="top"><![endif]-->
                                                                <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="280" align="left">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="right" class="es-infoblock esd-block-text es-m-txt-c">
                                                                                                <p><a href="" class="view">View in browser</a></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td></tr></table><![endif]-->
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="esd-stripe" align="center" bgcolor="#efefef" style="background-color: #efefef;">
                                                <table bgcolor="transparent" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="background-color: transparent;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-structure" align="left" esd-custom-block-id="83873">
                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="600" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="center" class="esd-block-image" style="font-size: 0px;"><a href=""><img class="adapt-img" src="https://cdn.pixabay.com/photo/2017/08/01/11/48/blue-2564660_1280.jpg" alt style="display: block;" width="600"></a></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="esd-structure es-p5t es-p30b es-p20r es-p20l" align="left" bgcolor="#ffffff" style="background-color: #ffffff;">
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="560" class="esd-container-frame" align="left">
                                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="center" class="esd-block-image es-p20t" style="font-size: 0px;"><a target="_blank"><img class="adapt-img" src="https://media.giphy.com/media/1jY7CpwS16K2qyJgrY/giphy.gif" alt style="display: block; width: 300px;" width="300"></a></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="560" align="left" class="esd-container-frame es-m-p20b">
                                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="center" class="esd-block-text es-p10t es-p5b">
                                                                                                <h2 style="color: #00413f;">Gracias por su compra!!&nbsp; :)</h2>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" class="esd-block-text es-p10t es-p10b">
                                                                                                <p>La compra que realizaste se acaba de realizar con exito, no olvides que tienes un periodo de 30 dias de garantia para poder ralizar cualquier cambio o devolucion.<br><br>"Liverpuri es parte de mi life".</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" class="esd-block-button es-p10t es-p10b">
                                                                                                <!--[if mso]><a href="https://viewstripo.email/" target="_blank">
            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" stripoVmlButton href="https://viewstripo.email/" 
                        style="height:49px;v-text-anchor:middle;width:156px;" arcsize="10%" stroke="f" fillcolor="#00c4c6">
                <w:anchorlock></w:anchorlock>
                <center style="color:#ffffff;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:18px;font-weight:400;">Ir a la Tienda</center>
            </v:roundrect></a>
        <![endif]-->
                                                                                                <!--[if !mso]><!-- --><span class="msohide es-button-border"><a href="https://viewstripo.email/" class="es-button" target="_blank">Ir a la Tienda</a></span>
                                                                                                <!--<![endif]-->
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="10px" cellspacing="0" align="center" style="border: solid black; border-size: 1px; margin-top: 50px; margin-bottom: 50px;">
                                    <thead>
                                        <tr>
                                            <th>Nombre Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>                                                        
                                        <tr>                                                           
                                    </thead>
                                    <tbody>' . $msg2 . '</tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" class="es-footer" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="esd-stripe" align="center" bgcolor="#f11968" style="background-color: #f11968;" esd-custom-block-id="83874">
                                                <table bgcolor="#ffffff" class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-structure" align="left" bgcolor="#ffffff" style="background-color: #ffffff;">
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="600" class="esd-container-frame" align="center" valign="top">
                                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="center" class="esd-block-image" style="font-size:0"><a target="_blank"><img class="adapt-img" src="https://tlr.stripocdn.email/content/guids/CABINET_8ba9362bd94f8450b9cc99d201c33cda/images/60441575463377280.png" alt style="display: block;" width="600"></a></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="esd-structure es-p10t es-p20r es-p20l" align="left" esd-general-paddings-checked="true">
                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="esd-block-social es-p15b" align="center" style="font-size:0">
                                                                                                <table class="es-table-not-adapt es-social" cellspacing="0" cellpadding="0">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td class="es-p10r" valign="top" align="center"><a target="_blank" href><img title="Facebook" src="https://tlr.stripocdn.email/content/assets/img/social-icons/circle-white/facebook-circle-white.png" alt="Fb" width="32" height="32"></a></td>
                                                                                                            <td class="es-p10r" valign="top" align="center"><a target="_blank" href><img title="Twitter" src="https://tlr.stripocdn.email/content/assets/img/social-icons/circle-white/twitter-circle-white.png" alt="Tw" width="32" height="32"></a></td>
                                                                                                            <td class="es-p10r" valign="top" align="center"><a target="_blank" href><img title="Instagram" src="https://tlr.stripocdn.email/content/assets/img/social-icons/circle-white/instagram-circle-white.png" alt="Inst" width="32" height="32"></a></td>
                                                                                                            <td valign="top" align="center"><a target="_blank" href><img title="Youtube" src="https://tlr.stripocdn.email/content/assets/img/social-icons/circle-white/youtube-circle-white.png" alt="Yt" width="32" height="32"></a></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="esd-block-text" align="center">
                                                                                                <p style="font-size: 12px; line-height: 150%;">Estas recibiendo este email como servicio de notificacion de la tienda LIVERPURI de que has realizado una compra con exito.</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="esd-structure es-p20t es-p10b es-p20r es-p20l" align="left" esd-general-paddings-checked="true">
                                                                <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                                                                <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="es-m-p20b esd-container-frame" width="270" align="left">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="left" class="esd-block-text es-m-txt-c"><a class="unsubscribe" target="_blank" href>Liverpuri</a></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
                                                                <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="270" align="left">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="right" class="esd-block-text es-m-txt-c">
                                                                                                <p>© All Rights Reserved, 2020</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td></tr></table><![endif]-->
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" class="es-content esd-footer-popover" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="esd-stripe" align="center" bgcolor="#ffffff" style="background-color: #ffffff;">
                                                <table bgcolor="transparent" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="background-color: transparent;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-structure es-p30t es-p30b es-p20r es-p20l" align="left">
                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="esd-block-image es-infoblock made_with" align="center" style="font-size: 0px;"><a target="_blank" href><img src="https://demo.stripocdn.email/content/guids/294734c5-51c3-40ca-b359-f1698652da85/images/81531608318737199.PNG" alt width="125" style="display: block;"></a></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </body>
        
        </html>
        
        ';
        $mail->Body = $msg;
        $mail->Send();
    }

    function sendMailAdmin($destinatario,$data) {
        require_once("../PHPmailer/PHPMailerAutoload.php");
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->isHTML();

        // Informacion correo remitente
        $mail->Username = 'elyisusRR99@gmail.com';
        $mail->Password = 'PutaMadre99';
        $mail->SetFrom('elyisusRR99@gmail.com','non-reply');

        // Info correo a enviar
        $mail->Subject = 'Nueva Compra';
        $mail->AddAddress($destinatario);
        $url='../api/Captura.png';
        $mail->AddAttachment($url,$url);
        $msg = "El cliente: ".$data['USERNAME']." \n
            REALIZO LA CAMPRA CON ID: ".$data['ID_COMPRA']."\n
            EN LA FECHA: ".$data['FECHA']."\n
            CON UN TOTAL DE: $ MXN ".$data['TOTAL']."\n    
        :)";

        $mail->Body = $msg;
        $mail->Send();
        
    }

    function sendMailNew($destinatario) {
        require_once("../PHPmailer/PHPMailerAutoload.php");
        require_once( '../DB_FUNCTIONS/DB_Functions.php');
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->isHTML();

        // Informacion correo remitente
        $mail->Username = 'elyisusRR99@gmail.com';
        $mail->Password = 'PutaMadre99';
        $mail->SetFrom('elyisusRR99@gmail.com','non-reply');

        // Info correo a enviar
        $mail->Subject = 'Ticket Compra en Liverpuri';
        $mail->AddAddress($destinatario);
        $msg2 = " ";
        $prods=sales_by_date('mujer');
        if($prods){
            foreach($prods as $key=>$producto) {
                $name = $producto['nombre'];
                $precio = $producto['precio'];
            }
            $msg2 = "<table cellpadding='10px' cellspacing='0' align='center' style='border: solid black; border-size: 1px; margin-top: 50px; margin-bottom: 50px;'><tr><td>Producto</td><td>Precio</td></tr><tr><td>" . $name . "</td>" . "<td> $ MXN " . $precio . "</td></tr></table>";
        }
        $msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
        
        <head>
            <meta charset="UTF-8">
            <meta content="width=device-width, initial-scale=1" name="viewport">
            <meta name="x-apple-disable-message-reformatting">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="telephone=no" name="format-detection">
            <title></title>
            <!--[if (mso 16)]>
            <style type="text/css">
            a {text-decoration: none;}
            </style>
            <![endif]-->
            <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
            <!--[if gte mso 9]>
        <xml>
            <o:OfficeDocumentSettings>
            <o:AllowPNG></o:AllowPNG>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
        </head>
        
        <body>
            <div class="es-wrapper-color">
                <!--[if gte mso 9]>
                    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                        <v:fill type="tile" color="#f6f6f6"></v:fill>
                    </v:background>
                <![endif]-->
                <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="esd-email-paddings" valign="top">
                                <table cellpadding="0" cellspacing="0" class="es-content esd-header-popover" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="esd-stripe" align="center" esd-custom-block-id="88325">
                                                <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-structure es-p15t es-p15b es-p20r es-p20l" align="left">
                                                                <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                                                                <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="270" align="left">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="esd-block-text es-infoblock" align="left">
                                                                                                <p>Put your preheader text here</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
                                                                <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="270" align="left">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="esd-block-text es-infoblock" align="right">
                                                                                                <p><a href=""  class="view">View in browser</a></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]></td></tr></table><![endif]-->
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" class="es-header" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="esd-stripe" align="center" esd-custom-block-id="88504">
                                                <table class="es-header-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-structure" esd-general-paddings-checked="false" align="left">
                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="600" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="center" class="esd-block-text es-p15">
                                                                                                <p style="line-height: 120%; font-size: 72px;">LIVERPURI</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="esd-stripe" align="center">
                                                <table class="es-content-body" style="background-color: #ffffff;" width="600" cellspacing="0" cellpadding="0" bgcolor="#fcfcfe" align="center">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-structure" align="left">
                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="600" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="center" class="esd-block-image" style="font-size: 0px;"><a ><img class="adapt-img" src="https://images.unsplash.com/photo-1607083206869-4c7672e72a8a?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt style="display: block;" width="600"></a></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="esd-stripe" align="center">
                                                <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" bgcolor="#fcfcfe" align="center">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-structure es-p30t es-p5b es-p20r es-p20l" style="background-color: #fcfcfe;" bgcolor="#fcfcfe" align="left">
                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="esd-block-text es-p5b" align="center">
                                                                                                <h2 style="color: #c60c3e; line-height: 150%;">Aprovecha las promociones y nuevos lanzamientos que tenemos para ti</h2>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="esd-block-text" align="center">
                                                                                                <p style="color: #585858; line-height: 150%; font-size: 16px;">Nuevos lanzamientos y rebajas cada primer semana de mes</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="esd-structure" align="left">
                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="600" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="esd-block-image" align="center" style="font-size:0"><a><img class="adapt-img" src="https://tlr.stripocdn.email/content/guids/CABINET_607759159e18219d6dcb5dfeda428654/images/51751516705459409.jpg" alt width="600"></a></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>' . $msg2 .'
                                <table cellpadding="0" cellspacing="0" class="es-footer esd-footer-popover" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="esd-stripe" esd-custom-block-id="1722" align="center">
                                                <table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" align="center">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-structure es-p20b es-p20r es-p20l" align="left">
                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="esd-block-spacer es-p20b" align="center" style="font-size:0">
                                                                                                <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td style="border-bottom: 1px solid #bc846f; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="left" class="esd-block-text">
                                                                                                <p style="font-size: 12px; font-family: arial, helvetica, sans-serif;">You are receiving this email because you have visited our site or asked us about regular newsletter.</p>
                                                                                                <p style="font-size: 12px;"><br></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </body>
        
        </html>';
        $mail->Body = $msg;
        $mail->Send();
    }
?>