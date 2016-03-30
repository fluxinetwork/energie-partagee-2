<?php 

$mail_prospect;     
$id_project;
$name_project;
$city_project;
$region_project;
$thumb_url;
$url_page_projet;

if ( $vars ) :       
      
  $mail_prospect = $vars[0];     
  $id_project = $vars[1];
  $name_project = $vars[2];
  $city_project = $vars[3]; 
  $region_project = $vars[4];
  $thumb_url = $vars[5];
  $url_page_projet = $vars[6];

endif;


$contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Energie Partagée - Soutenir un projet</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">     
</head>
<body bgcolor="#ffffff" style="margin:0;">
  <table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <table style="font-size:14px; font-family:Arial, sans-serif;" align="center" cellpadding="0" cellspacing="0" border="0" width="600">
                          <tr>
                            <td>
                              <table align="center" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                  <td>
                                    <img style="display:block" src="http://i.imgur.com/mlUTIDq.jpg" width="600" height="254" alt="Energie Partagée - logo">
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <table align="center" cellpadding="0" cellspacing="0" border="0" width="600" bgcolor="#65C103" style="padding:0 50px 25px 50px; text-align:center; color:#fff; border-radius: 0 0 3px 3px;">
                                <tr>
                                  <td>
                                    <h2 style="font-size:24px; margin-bottom:5px; font-family: Lucida Grande, Arial, sans-serif;">C\'est l\'histoire de milliers de personnes</h2>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <h3 style="font-size:17px; font-weight:normal; padding: 0 40px; margin-top: 0px; line-height: 20px;">qui choisissent de se mobiliser pour une autre énergie, pour leur territoire et pour la planète !</h3>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                              <tr>
                                    <td>
                                          <table align="center" cellpadding="0" cellspacing="0" width="600"  border="0" style="padding:25px 0 25px 0; text-align:center; color:#333;">
                                                <tr>
                                                      <td>
                                                            <p style="margin-bottom:5px;">Vous êtes intéressé par le projet</p>
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <h1 style="font-size:25px; margin-top:0; margin-bottom:0;">'.$name_project.'</h1>
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <p style="margin:5px; font-style:italic;">à '.$region_project.'</p>
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <a href="'.$url_page_projet.'"><img src="'.$thumb_url.'" style="border-radius:3px; margin:12px 0 15px 0" /></a>
                                                      </td>
                                                </tr>
                                                 <tr>
                                                      <td>
                                                            <p style="margin-top:0;">Pour soutenir ce projet il vous suffit de souscrire <br>au fonds solidaire Énergie Partagée</p>
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <a href="http://energie-partagee.org/le-fonds-citoyen/principes-dintervention/" style="background-color:#75C800; padding:14px 18px; color:#fff; text-decoration:none; border-radius:10px; display:inline-block; font-weight:700; font-family: Lucida Grande, Arial, sans-serif;">Comment fonctionne le fonds ?</a>
                                                      </td>
                                                </tr>
                                          </table>
                                    </td>
                              </tr>
                              <tr>
                                    <td>
                                          <table align="center" cellpadding="0" cellspacing="0" border="0" width="600" style="padding:0 0 25px 0; text-align:center; color:#333;">
                                                <tr>
                                                      <td>
                                                            <p style="margin-top:25px; padding:0 40px;">Le projet <strong>'.$name_project.'</strong> fait partie de ces initiatives citoyennes qui émergent en France et prouvent qu\'une révolution citoyenne est en cours.<br> Le fonds Énergie Partagée et ses souscripteurs soutiennent ces projets en investissant à leurs côtés. </p>
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <table align="center" cellpadding="0" cellspacing="0" border="0" width="600" style="padding:0 50px 25px 50px; text-align:center; color:#333; margin-top:15px; padding:30px 40px; background:#E7511E; border-radius:3px; color:#fff;">
                                                                  <tr>
                                                                        <td>
                                                                              <p style="margin-top:0;margin-bottom:30px;">Pour souscrire au fonds il suffit de remplir le bulletin de souscription et de le renvoyer, accompagné des pièces justificatives, à l\'adresse :<br><br>Énergie Partagée Investissement<br>10 avenue des Canuts<br>69120 Vaulx-en-Velin</p>
                                                                        </td>
                                                                  </tr>
                                                                  <tr>
                                                                        <td>
                                                                              <a href="http://energie-partagee.org/wp-content/uploads/2014/09/Bulletin-2014-Version-A4.pdf" style="background-color:#75C800; padding:14px 18px; color:#fff; text-decoration:none; border-radius:10px; display:inline-block; font-weight:700; font-family: Lucida Grande, Arial, sans-serif;">Télécharger le bulletin</a>
                                                                        </td>
                                                                  </tr>
                                                            </table>
                                                      </td>
                                                </tr>

                                          </table>
                                    </td>
                              </tr>
                             
                              <tr width="600">
                                <td style="display:block; padding:50px; background:#b7115b; text-align:center; margin-top:55px; border-radius:3px 3px 0 0;">
                                  <table align="center" cellpadding="0" cellspacing="0" border="0"> 
                                    <tr>
                                      <td width="600">
                                        <a href="mailto:association@energie-partagee.org" style="color:#fff; text-decoration:none; display:inline-block;">association@energie-partagee.org</a><span style="color:#fff">
                                      </td>
                                    </tr>
                                    <tr height="20"></tr>
                                    <tr>
                                          <td align="left" width="210" valign="top">
                                            <p style="color:#fff;margin-top:0;padding:0 20px;text-align:center; border-top:1px dotted #fff; padding-top:20px;">Énergie Partagée Investissement bénéficie du<br>label Finansol et de l\'agrément “Entreprise Solidaire”,<br>qui garantissent la solidarité et la transparence de la gestion des fonds.</p>
                                            <img style="display:block; margin:0 auto; border-radius:3px;" src="http://i.imgur.com/kL09BuF.jpg" width="190" height="95" alt="Logo Finansol et agrément Entreprise Solidaire">
                                          </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                        </table>
                  </td>
             </tr>
    </table>
</body>
</html>';
?>