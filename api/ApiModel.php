<?php
require_once ("Database.php");

date_default_timezone_set("UTC");

$db = new Database();

define('SAVE_PHOTO', '../images/');  // save image path
define('DELETE_PHOTO', '../images/');  // delete image path

class ApiModel {

    private $_provider = null;

    private $_host = "";
    private $_google_api_key = "AIzaSyCRSNRos8ahMkjNcMID6cVdDgLYcaUsjVI";

    public function __construct() {
        $this -> _provider = new Database();
    }
    
    public function __destruct() {
        $this -> _provider = null;
    }
    
    public static function getInstance() {
        return new ApiModel();
    }
    
    public function provider() {
        return $this -> _provider;
    }
    
    private function generate_token($length = 8) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        //length:36
        $final_rand = '';
        for ($i = 0; $i < $length; $i++) {
            $final_rand .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $final_rand;
    }
    
    private function authentication() {
        $headers = apache_request_headers();

        if (isset($headers['Access-Token']) && isset($headers['Device-Id'])) :
            $sql = "select a.account_id, b.state from device a, account b where a.account_id = b.id and a.access_token = '" . $headers['Access-Token'] . "' and a.device_id='" . $headers['Device-Id'] . "'";
            $info = $this -> provider() -> single($sql);
            if (count($info) > 0) :
                switch($info['state']) :
                    case 1 :
                        return $info['account_id'];
                        break;
                    case -1 :
                        echo json_encode(array('success' => 'false', 'error' => "Your account is blocked. Please contact us about this."));
                        exit ;
                        break;
                    case 0 :
                        echo json_encode(array('success' => 'false', 'error' => "Your account is not active yet. Please confirm your mailbox."));
                        exit ;
                        break;
                endswitch;
            else :
                echo json_encode(array('success' => 'false', 'error' => "Access denied."));
                exit ;
            endif;
        else :
            echo json_encode(array('success' => 'false', 'error' => "Access denied."));
            exit ;
        endif;
    }

    /*************************************  Comics  *************************************************/
    public function getComics() {
        
		$sql = "SELECT * FROM comics ORDER BY created DESC;";
        if($result = $this->provider()->result($sql)):
            if(count($result) > 0):
                echo json_encode(array("success" => "1", "comics" => $result));exit;
            else:
                echo json_encode(array("success" => "1", "comics" => array()));exit;
            endif;

        else:
            echo json_encode(array("success" => "0", "message" => "sql : error panels"));exit;
        endif;
    }
    
    /*************************************  Episodes  *************************************************/
    public function getEpisodes() {
        
        $comic_id = $_POST['comic_id'];
        
        $sql = "SELECT E.id, E.comic_id, E.episode_name, E.episode_image, E.likes, from_unixtime(E.created, '%Y/%m/%d') AS created_date, C.comic_name
                FROM episodes E, comics C
                WHERE E.comic_id = C.id AND E.comic_id = " . $comic_id .
                " AND E.active = 1 ORDER BY E.created DESC";
                
        if($result = $this->provider()->result($sql)):
            if(count($result) > 0):
                echo json_encode(array("success" => "1", "episodes" => $result));exit;
            else:
                echo json_encode(array("success" => "1", "episodes" => array()));exit;
            endif;

        else:
            echo json_encode(array("success" => "0", "message" => "sql : error panels"));exit;
        endif;
    }
    
    /*************************************  Like/Unlike  *************************************************/
    public function Like_unlike() {
        global $db;

        $episode_id = $_POST['episode_id'];
        $status = $_POST['status'];
        
        if($status == "liked"):
            $sql = "UPDATE episodes SET likes = likes + 1 WHERE id = " . $episode_id;
            if($db->execute($sql)) echo "success";
            else echo "failed";
        elseif($status == "unliked"):
            $sql = "UPDATE episodes SET likes = likes - 1 WHERE id = " . $episode_id;
            if($db->execute($sql)) echo "success";
            else echo "failed";
        endif;
    }
    
    /*************************************  Panels  *************************************************/
    public function getPanels() {
        
        $episode_id = $_POST['episode_id'];
        
        $sql = "SELECT * FROM panels WHERE episode_id=" . $episode_id . " ORDER BY panel_image ASC";
        
        if($result = $this->provider()->result($sql)):
            if(count($result) > 0):
                echo json_encode(array("success" => "1", "panels" => $result));exit;
            else:
                echo json_encode(array("success" => "1", "panels" => array()));exit;
            endif;

        else:
            echo json_encode(array("success" => "0", "message" => "sql : error panels"));exit;
        endif;
    }
    
    /*************************************   Saving Information   ************************************/
    
    public function saveInfo() {
        global $db;
        
        $lat = $_POST['latitude'];
        $lng = $_POST['longitude'];
        $ip = $_POST['publicIP'];
        $device_model = $_POST['deviceModel'];
        $device_id = $_POST['deviceID'];
        $device_type = $_POST['deviceType'];
        $carrier = $_POST['carrier'];
        $date = date("Y-m-d");
        $time = date("H:i:s");
        
        $sql = "INSERT INTO infos(latitude, longitude, public_ip, device_model, device_id, device_type, carrier, date, time) VALUES('$lat', '$lng', '$ip', '$device_model', '$device_id', '$device_type', '$carrier', '$date', '$time')";
        
        if($db->execute($sql)) echo "success";
        else echo "fail";
    }
    
    /************************************ Subscribers ***************************************/
    
    public function subscribe() {
        global $db;
        
        $comic_id = $_POST['comicID'];
        $device_id = $_POST['deviceID'];
        $device_type = $_POST['deviceType'];
        $date = date("Y-m-d");
        $time = date("H:i:s");
        
        $sql = "INSERT INTO subscribers(comic_id, device_id, device_type, date, time) VALUES ('$comic_id', '$device_id', '$device_type', '$date', '$time')";
        
        if($db->execute($sql)) echo "success";
        else echo "fail";
    }
}