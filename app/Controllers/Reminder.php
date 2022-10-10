<?php

namespace App\Controllers;

use App\Models\Pic_model;
use App\Models\View_summary_monthly_project_model;

class Reminder extends BaseController{

    public function index(){
        $modelPICs  = new Pic_model;

        $data['headerTitle'] = "Reminder";
        $data['currentPage'] = "Reminder";
        $data['dataPICs']    = $this->picPivot($modelPICs->getPics());

        echo view('_partial/header', $data);
        echo view('_partial/sidebar');
        echo view('reminder');
        echo view('_partial/footer');
    }

    public function send(){
        $cc = array(
          array(
            "name" => "Yudha Pratama", 
            "email" => "yudha.pratama@kalbe.co.id"
          ),
          array(
            "name" => "Nadia Luciana", 
            "email" => "nadia.luciana@kalbe.co.id"
          ),
          array(
            "name" => "Yoga Saputra", 
            "email" => "yoga.saputra@kalbe.co.id"
          )
        );

        $modelSummaryMonthly = new View_summary_monthly_project_model;

        $date = date('Y-m').'-01';

        $result = $modelSummaryMonthly
            ->select('*')
            ->where('date_monthly', $date)
            ->where('status', 'Overdue')
            ->orderBy('`name_pic`')
            ->findAll();

        $return = array();
        $resCount = count($result);
        $lastPIC="";
        $index=-1;
        foreach ($result as $key => $value) {
            if ($lastPIC != $value['name_pic']) {
                if ($key!=0){
                    $return[] = $data;
                    unset($data);
                }
                $data['name_pic']   = $value['name_pic'];
                $data['data'][]     = $value;
            } else {
                $data['data'][]     = $value;
            }
            $lastPIC = $value['name_pic'];

            if(++$key==$resCount){
                $return[] = $data;
            }
        }

        foreach ($return as $key => $value) {
            $message = $this->setMessages($value);
            $address = $this->getEmailByName($value['name_pic']);

            $this->sendMessage($address, $cc, $message);
            //echo $this->sendMessage($address, $cc, $message);
        }
    }

    private function setMessages($item){
        $tableBody = "";
        foreach ($item['data'] as $key => $value) {
            $num = $key+1;
            $tableBody .= 
                "<tr>
                    <td>${num}</td>
                    <td>${value['category_name']}</td>
                    <td>${value['project_name']}</td>
                    <td>${value['department_name']}</td>
                    <td style=\"text-align: center\">${value['monthly']}%</td>
                </tr>";
        }

        $message = "
        <!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
        <html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">
        <head>
        <!--[if gte mso 9]>
        <xml>
          <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
          <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
          <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
          <meta name=\"x-apple-disable-message-reformatting\">
          <!--[if !mso]><!--><meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"><!--<![endif]-->
          <title></title>
          
            <style type=\"text/css\">
              @media only screen and (min-width: 620px) {
          .u-row {
            width: 700px !important;
          }
          .u-row .u-col {
            vertical-align: top;
          }

          .u-row .u-col-100 {
            width: 700px !important;
          }

        }

        @media (max-width: 620px) {
          .u-row-container {
            max-width: 100% !important;
            padding-left: 0px !important;
            padding-right: 0px !important;
          }
          .u-row .u-col {
            min-width: 320px !important;
            max-width: 100% !important;
            display: block !important;
          }
          .u-row {
            width: calc(100% - 40px) !important;
          }
          .u-col {
            width: 100% !important;
          }
          .u-col > div {
            margin: 0 auto;
          }
        }
        body {
          margin: 0;
          padding: 0;
        }

        table,
        tr,
        td {
          vertical-align: top;
          border-collapse: collapse;
        }

        p {
          margin: 0;
        }

        .ie-container table,
        .mso-container table {
          table-layout: fixed;
        }

        * {
          line-height: inherit;
        }

        a[x-apple-data-detectors='true'] {
          color: inherit !important;
          text-decoration: none !important;
        }

        table, td { color: #000000; } #u_body a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_heading_1 .v-font-size { font-size: 50px !important; } #u_content_heading_2 .v-font-size { font-size: 22px !important; } #u_content_heading_2 .v-line-height { line-height: 130% !important; } #u_content_text_1 .v-container-padding-padding { padding: 50px 30px !important; } #u_content_divider_1 .v-container-padding-padding { padding: 10px 30px !important; } #u_content_image_2 .v-container-padding-padding { padding: 50px 10px 10px 30px !important; } #u_content_image_2 .v-src-width { width: auto !important; } #u_content_image_2 .v-src-max-width { max-width: 35% !important; } #u_content_text_2 .v-container-padding-padding { padding: 10px 30px 50px !important; } }

        *,::after,::before{
            box-sizing:border-box;
        }
         table{
            caption-side:bottom;
            border-collapse:collapse;
        }
         th{
            text-align:inherit;
            text-align:-webkit-match-parent;
        }
         tbody,th,thead,tr{
            border-color:inherit;
            border-style:solid;
            border-width:0;
        }
         ::-moz-focus-inner{
            padding:0;
            border-style:none;
        }
         .table{
            --bs-table-bg:transparent;
            --bs-table-accent-bg:transparent;
            --bs-table-striped-color:#212529;
            --bs-table-striped-bg:rgba(0, 0, 0, 0.05);
            --bs-table-active-color:#212529;
            --bs-table-active-bg:rgba(0, 0, 0, 0.1);
            --bs-table-hover-color:#212529;
            --bs-table-hover-bg:rgba(0, 0, 0, 0.075);
            width:100%;
            margin-bottom:1rem;
            color:#212529;
            vertical-align:top;
            border-color:#dee2e6;
        }
         .table>:not(caption)>*>*{
            padding:.5rem .5rem;
            background-color:var(--bs-table-bg);
            border-bottom-width:1px;
            box-shadow:inset 0 0 0 9999px var(--bs-table-accent-bg);
        }
         .table>tbody{
            vertical-align:inherit;
        }
         .table>thead{
            vertical-align:bottom;
        }
         .table>:not(:first-child){
            border-top:2px solid currentColor;
        }

            </style>
          
          

        <!--[if !mso]><!--><link href=\"https://fonts.googleapis.com/css?family=Lato:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\"><link href=\"https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\"><link href=\"https://fonts.googleapis.com/css?family=Rubik:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\"><!--<![endif]-->

        </head>

        <body class=\"clean-body u_body\" style=\"margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ecf0f1;color: #000000\">
          <!--[if IE]><div class=\"ie-container\"><![endif]-->
          <!--[if mso]><div class=\"mso-container\"><![endif]-->
          <table id=\"u_body\" style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ecf0f1;width:100%\" cellpadding=\"0\" cellspacing=\"0\">
          <tbody>
          <tr style=\"vertical-align: top\">
            <td style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top\">
            <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td align=\"center\" style=\"background-color: #ecf0f1;\"><![endif]-->
            

        <div class=\"u-row-container\" style=\"padding: 0px;background-color: #31ceff\">
          <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">
            <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">
              <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: #31ceff;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-color: transparent;\"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"background-color: #31ceff;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\" valign=\"top\"><![endif]-->
        <div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">
          <div style=\"background-color: #31ceff;height: 100%;width: 100% !important;\">
          <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\"><!--<![endif]-->
          
        <table id=\"u_content_heading_1\" style=\"font-family:arial,helvetica,sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">
          <tbody>
            <tr>
              <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:10px 10px 0px;font-family:arial,helvetica,sans-serif;\" align=\"left\">
                
          <h1 class=\"v-line-height v-font-size\" style=\"margin: 0px; color: #000000; line-height: 130%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: 'Raleway',sans-serif; font-size: 70px;\">
            <div><strong>REMINDER!</strong></div>
          </h1>

              </td>
            </tr>
          </tbody>
        </table>

          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>



        <div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">
          <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 700px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">
            <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">
              <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-color: transparent;\"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"background-color: #ecf0f1;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\" valign=\"top\"><![endif]-->
        <div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 700px;display: table-cell;vertical-align: top;\">
          <div style=\"background-color: #ecf0f1;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">
          <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->
          
        <table id=\"u_content_text_1\" style=\"font-family:arial,helvetica,sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">
          <tbody>
            <tr>
              <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:50px 40px;font-family:arial,helvetica,sans-serif;\" align=\"left\">
                
          <div class=\"v-line-height\" style=\"line-height: 170%; text-align: justify; word-wrap: break-word;\">
            <p style=\"font-size: 14px; line-height: 170%;\">Dear Bapak/Ibu ${item['name_pic']},</p>
            <p style=\"font-size: 14px; line-height: 170%;\">Mohon dapat melakukan update project ltdp pada link berikut (<a href=\"http://kf-ckrmsdd007/monitoring/\" target=\"_blank\">http://kf-ckrmsdd007/monitoring/</a>) apablia terjadi kendala mohon menghubungi Ext.402/404<p style=\"font-size: 14px; line-height: 170%;\"> </p>
            <p style=\"font-size: 14px; line-height: 170%;\">
                    <table class=\"table\" style=\"font-size: 14px;\">
                        <thead>
                          <tr>
                            <th scope=\"col\">#</th>
                            <th scope=\"col\">Category</th>
                            <th scope=\"col\">Project Name</th>
                            <th scope=\"col\">Dept</th>
                            <th scope=\"col\">Monthly</th>
                          </tr>
                        </thead>
                        <tbody>
                            ${tableBody}
                        </tbody>
                    </table></p>
        <p style=\"font-size: 14px; line-height: 170%;\"> </p>
        <p style=\"font-size: 14px; line-height: 170%;\">Note: Apabila terjadi keterlambatan project mohon untuk mengisi di kolom description dan PICA</p>
        <p style=\"font-size: 14px; line-height: 170%;\"> </p>
        <p style=\"font-size: 14px; line-height: 170%;\"><span style=\"font-family: Lato, sans-serif; font-size: 14px; line-height: 23.8px;\"><strong>Best Regards,</strong></span></p>
        <p style=\"font-size: 14px; line-height: 170%;\"><span style=\"font-family: Lato, sans-serif; font-size: 14px; line-height: 23.8px;\"><strong>MSTD Teams</strong></span></p>
          </div>

              </td>
            </tr>
          </tbody>
        </table>

          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>



        <div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">
          <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">
            <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">
              <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-color: transparent;\"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"background-color: #ecf0f1;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\" valign=\"top\"><![endif]-->
        <div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">
          <div style=\"background-color: #ecf0f1;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\">
          <!--[if (!mso)&(!IE)]><!--><div style=\"height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;\"><!--<![endif]-->
          
        <table id=\"u_content_divider_1\" style=\"font-family:arial,helvetica,sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">
          <tbody>
            <tr>
              <td class=\"v-container-padding-padding\" style=\"overflow-wrap:break-word;word-break:break-word;padding:10px 10px 10px 40px;font-family:arial,helvetica,sans-serif;\" align=\"left\">
                <table height=\"0px\" align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%\">
                  <tbody>
                    <tr style=\"vertical-align: top\">
                      <td style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%\">
                        <span>&#160;</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>

          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>


            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
            </td>
          </tr>
          </tbody>
          </table>
          <!--[if mso]></div><![endif]-->
          <!--[if IE]></div><![endif]-->
        </body>

        </html>
        ";
        return $message;
    }

    private function sendMessage($address, $cc, $message){
        $ch = curl_init();

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Api-Key: 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';
        $headers[] = 'Content-Type: application/json';

        $data = array(
            "sender" => array(
                "email" => 'techdev.mstd@gmail.com',
                "name" => 'MSTD-KF'         
            ),
            "to" => $address,
            "cc" => $cc,
            "subject" => "REMINDER : OVERDUE PROJECTS",
            "htmlContent" => $message
        );

        curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        var_dump($result);
        var_dump($result);
        echo ".............<b>Email notifikasi terkirim</b><br>";
    }

    private function getEmailByName($name){
        $modelPICs  = new Pic_model;

        $result = $modelPICs->select('user_pic')->where('name_pic', $name)->first();

        $return = array(
            array(
                "name" => $name,
                "email" => $result['user_pic']
            )
        );

        //echo json_encode($return);
        return $return;
    }

    private function picPivot($dataPICs){
      $result = array();

      foreach ($dataPICs as $key => $value) {
        $result[$key] = array(
          'name_pic' => $value['name_pic'], 
          'user_pic' => $value['user_pic'],
          'isTrue'   => $this->emailCheck($value['user_pic'])
        );
      }

      return $result;
    }

    private function emailCheck($email){
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "&#10005;";
      } else {
        return "&#10003;";
      }
    }
}