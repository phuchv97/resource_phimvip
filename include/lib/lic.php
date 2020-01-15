<?php /**
            * Movies Script v2.0.0
            *
            * PHP version > 5
            *
            * LICENSE: This source file is subject to version 3.01 of the PHP license
            * that is available through the world-wide-web at the following URI:
            * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
            * the PHP License and are unable to obtain it through the web, please
            * send a note to license@php.net so we can mail you a copy immediately.
            *
            * @package    KeyCode
            * @author     Tuan Khanh <lamkhanhseo@gmail.com>
            * @copyright  2016 - 2018 PHPMovies
            * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
            * @version    v2.0.0
            * @link       https://billycode.com */
            
            $domain=$_SERVER['SERVER_NAME'];
            $product="40";
            $licenseServer = "https://license.billycode.com/api/";
            $postvalue="domain=$domain&product=".urlencode($product);
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $licenseServer);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postvalue);
            $result= json_decode(curl_exec($ch), true);
            curl_close($ch);
            if($result['status'] != 200) {
            $html = "<div align='center'>
                <table width='100%' border='0' style='padding:15px; border-color:#F00; border-style:solid; background-color:#FF6C70; font-family:Tahoma, Geneva, sans-serif; font-size:22px; color:white;'>
                <tr>
                <td><b>Ban vui long mua key ban quyen de su dung code . Chi ho tro voi nhung ai mua no !! Contact: Lamkhanhseo@gmail.com <br > Server is: <%returnmessage%>.</b></td >
                </tr>
                </table>
                </div>";
            $search = '<%returnmessage%>';
            $replace = $result['message'];
            $html = str_replace($search, $replace, $html);
            die( $html );
            }
            ?>