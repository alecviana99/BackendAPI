<?php
    require_once("../api/Database.php");

    $permission = array("0"=>"default", "1"=>"admin");

    $db = new Database();

    function redirect_url( $url = './index.php' ){
        echo '<script>location.href = "'.$url.'"; </script>';exit;
    }

    function generate_token($length = 8) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        //length:36
        $final_rand = '';
        for ($i = 0; $i < $length; $i++) {
            $final_rand .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $final_rand;
    }
    
    function check_user(){
        global $db;
        if( isset($_SESSION['log_in']) && $_SESSION['log_in'] ){
            return true;
        } else {
            redirect_url('./login.php');
        }
    }
    
    function login($username, $password){

        if($username == "" || $password == "" ){
            redirect_url("./login.php?err=error1");
        }
        global $db;
        $password = md5($password);
        
        $info = $db -> single("SELECT * FROM admin WHERE username = '" . $username . "' AND password = '" . $password . "'");

        if (count($info) == 0) {
            redirect_url("./login.php?err=error1");
        } else {
            /* session register */
            $_SESSION['user_id'] = $info['id'];
            $_SESSION['username'] = $info['username'];
            $_SESSION['photo'] = "Logo_icon.png";
            $_SESSION['log_in'] = true;
            $_SESSION['password'] = $info['password'];
            $_SESSION['admin'] = $info['permission'];
            redirect_url("./index.php");
        }
    }
    
    function forgotPassword(){

        global $db;
        $email = $_REQUEST['email'];
        $info = $db -> single("SELECT email FROM account WHERE email = '$email' ");
        $to = $info['email'];
        $newpass = rand(100000, 999999);
        $db -> execute("update account set password = '".md5($newpass)."' where email = '$to'");
        $subject = "Change Password";
        $txt = "Your password changed. New password : ".$newpass. "\r\n" ;

        try {
            $headers = 'From: admin@indyhost.com' . "\r\n" .
                'Reply-To: admin@indyhost.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $txt, $headers);
        }
        catch (Exception $e)
        {
            redirect_url('./signup.php');
        }
        redirect_url('./login.php');
    }

    function adminGetPanels($pid = 0) {
        global $db;
        $sql = "SELECT *
                        FROM panels, comics
                        WHERE panels.comic_id = comics.id AND panels.id = $pid
                        ORDER BY comics.comicName ASC";
        
        if($pid > 0)                
            $sql = "SELECT P.id, P.panel_image, P.episode_id, P.created, E.comic_id, E.episode_name, E.episode_image, C.comic_name, C.comic_image
                    FROM panels P
                    LEFT JOIN episodes E ON E.id = P.episode_id
                    LEFT JOIN comics C ON C.id = E.comic_id
                    ORDER BY P.created DESC";
        $result = $db -> result($sql);
        return $result;
    }
    function getPanels($pid) {
        global $db;
        $new_panel = array("id" => 0, "panel_image" => "", "comic_id" => "", "comic_name" => "", "episode_id" => "", "episode_name" =>"");
        if($pid > 0):
            $sql = "SELECT P.id, P.panel_image, P.episode_id, P.created, E.comic_id, E.episode_name, E.episode_image, C.comic_name, C.comic_image
                    FROM panels P
                    LEFT JOIN episodes E ON E.id = P.episode_id
                    LEFT JOIN comics C ON C.id = E.comic_id
                    WHERE P.id = " . $pid . 
                    " ORDER BY P.created DESC";
            $new_panel = $db -> single($sql);
        endif;
        return $new_panel;
    }
    function deletePanel($pid) {
        global $db;
        $sql = "DELETE FROM panels WHERE id = " . $pid;
        $db->execute($sql);
        redirect_url("./view_panels.php");
    }
    function editPanel($pid, $comic_id, $episode_id){
        global $db;
        $newid = $pid;
        
        if (isset($_FILES['panels'])) {
            
            $extension = array("jpeg", "jpg", "png", "gif");
            
            foreach($_FILES["panels"]["tmp_name"] as $key => $tmp_name):
                
                if($pid > 0){//update
                
                    $query = "SELECT P.episode_id, E.comic_id, P.panel_image
                                FROM panels P, episodes E
                                WHERE P.episode_id = E.id AND P.id = " . $pid;
                                
                    $result = $db->result($query);
                    $original_episode_id = $result[0]['episode_id'];
                    $original_comic_id = $result[0]['comic_id'];
                    $original_panel_image = $result[0]['panel_image'];
                    
                    $sql = "UPDATE panels SET episode_id = '$episode_id' WHERE id = $pid";
                    $db->execute($sql);
                    
                    if($original_episode_id != $episode_id):
                        if($original_comic_id == $comic_id)
                            copy("../images/" . $comic_id . "/" . $original_episode_id . "/" . $original_panel_image, "../images/" . $comic_id . "/" . $episode_id . "/" . $original_panel_image);
                        copy("../images/" . $original_comic_id . "/" . $original_episode_id . "/" . $original_panel_image, "../images/" . $comic_id . "/" . $episode_id . "/" . $original_panel_image);
                    endif;
                } else {
                    $now = time();
                    $sql = "INSERT INTO panels(episode_id, created) VALUES('$episode_id', '$now');";
                    $db->execute($sql);
                    $newid = $db->_db->insert_id;
                }
                
                $file_name = $_FILES["panels"]["name"][$key];
                $file_tmp = $_FILES["panels"]["tmp_name"][$key];
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                
                if(in_array($ext, $extension))
                    if(move_uploaded_file($file_tmp = $_FILES["panels"]["tmp_name"][$key], "../images/" . $comic_id . "/" . $episode_id . "/" . $file_name))
                        $db->execute("UPDATE panels SET panel_image = '$file_name' WHERE id = $newid ");
            endforeach;
        }
        else {
            if($pid > 0){//update
                $sql = "UPDATE panels SET episode_id = '$episode_id' WHERE id = $pid ";
                $db->execute($sql);
            } else {
                $now = time();
                $sql = "INSERT INTO panels(episode_id, created) values('$episode_id', '$now'); ";
                $db->execute($sql);
                $newid = $db->_db->insert_id;
            }
        }
        redirect_url('./view_panels.php');
    }
    
    function adminPanels() {
        global $db;
        $sql = "SELECT P.id, P.panel_image, P.episode_id, P.created, E.comic_id, E.episode_name, E.episode_image, C.comic_name, C.comic_image
                    FROM panels P
                    LEFT JOIN episodes E ON E.id = P.episode_id
                    LEFT JOIN comics C ON C.id = E.comic_id
                    ORDER BY P.created DESC";
        $result = $db->result($sql);
        return $result;
    }
    
    function movePanelFirst($pid) {
        global $db;
        
        $now = time();
        
        $sql = "UPDATE panels SET created = " . $now . " WHERE id = " . $pid;
        $db->execute($sql);
        
        redirect_url("./view_panels.php");
    }

    /* comic */
    function getComic($cid){
        global $db;
        $new_comic = array("id" => 0, "comic_name" => "", "comic_abbreviation" => "", "comic_image" => "", "comic_big_image" => "");
        if($cid > 0):
            $sql = "SELECT * FROM comics WHERE id = $cid ORDER BY created DESC";
            $new_comic = $db -> single($sql);
        endif;
        return $new_comic;
    }
    
    function editComic($comic) {
        global $db;
        extract($comic);
        $comic_name = htmlspecialchars($comic_name, ENT_QUOTES);
        $comic_name = $db->_db->real_escape_string($comic_name);
        $comic_abbreviation = htmlspecialchars($comic_abbreviation, ENT_QUOTES);
        $comic_abbreviation = $db->_db->real_escape_string($comic_abbreviation);
        
        $now = time();
        $sql = "";
        $newID = $id;
        if($id > 0): //update
            $sql = "UPDATE comics SET comic_name = '$comic_name', comic_abbreviation = '$comic_abbreviation', created = '$now' WHERE id = $newID";
            $db->execute($sql);
        else:
            $sql = "INSERT INTO comics(comic_name, comic_abbreviation, created)
                        VALUES('$comic_name', '$comic_abbreviation', '$now') ";
            $db->execute($sql);
            $newID = $db->_db->insert_id;
            
            // push notification
            
            $sql = "SELECT * FROM infos GROUP BY device_id ORDER BY id DESC";
            
            $result = $db->result($sql);
            
            $message = "New Comic Is Added.";
            
            foreach($result as $row):
                $device_id = $row['device_id'];
                $device_type = $row['device_type'];

                if($device_type == "ios"):
                    push_ios($message, $device_id);
                else:
                    push_android($message, $device_id);
                endif;
            endforeach;
        endif;

        if (isset($_FILES['image'])):
            $default = explode(".", $_FILES["image"]["name"]);
            $extension = end($default);
            $filename = generate_token(8) . "." . $extension;
            
            $default1 = explode(".", $_FILES["image1"]["name"]);
            $extension1 = end($default1);
            $filename1 = generate_token(8) . "." . $extension1;

            $now = time();
            mkdir("../images/" . $newID);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], '../images/' . $newID . '/' . $filename))
                $db->execute("UPDATE comics SET comic_image = '$filename' WHERE id = $newID");
                
            if (move_uploaded_file($_FILES["image1"]["tmp_name"], '../images/' . $newID . '/' . $filename1))
                $db->execute("UPDATE comics SET comic_big_image = '$filename1' WHERE id = $newID");
        endif;
        redirect_url('./view_comics.php');
    }
    
    function adminGetComics() {
        global $db;
        $sql = "SELECT * FROM comics ORDER BY created DESC";
        $result = $db -> result($sql);
        return $result;
    }
    
    function deleteComic($cid) {
        global $db;
        
        $query1 = "SELECT * FROM episodes WHERE comic_id = $cid";
        $query1_result = $db->result($query1);
        for($i = 0; $i < count($query1_result); $i ++):
            $query2 = "SELECT * FROM panels WHERE episode_id = " . $query1_result[$i]['id'];
            $query2_result = $db->result($query2);
            for($j = 0; $j < count($query2_result); $j ++):
                $sql2 = "DELETE FROM panels WHERE episode_id = " . $query1_result[$i]['id'];
                $db->execute($sql2);
            endfor;
            $sql1 = "DELETE FROM episodes WHERE comic_id = " . $cid;
            $db->execute($sql1);
        endfor;
        
        $sql = "DELETE FROM comics WHERE id = " . $cid;
        $db->execute($sql);
        rmdir("../images/" . $cid);
        redirect_url("./view_comics.php");
    }
    
    function moveComicFirst($cid) {
        global $db;
        
        $now = time();
        
        $sql = "UPDATE comics SET created = " . $now . " WHERE id = " . $cid;
        $db->execute($sql);
        
        redirect_url("./view_comics.php");
    }
    
    /* episode */
    function getEpisode($eid){
        global $db;
        $new_episode = array("id" => 0, "episode_name" => "", "e_abbreviation" => "", "episode_image" => "", "comic_id" => "");
        if($eid > 0):
            $sql = "SELECT * FROM episodes WHERE id = $eid ORDER BY created DESC";
            $new_episode = $db -> single($sql);
        endif;
        return $new_episode;
    }
    
    function editEpisode($episode) {
        global $db;
        extract($episode);
        $episode_name = htmlspecialchars($episode_name, ENT_QUOTES);
        $episode_name = $db->_db->real_escape_string($episode_name);
        $e_abbreviation = htmlspecialchars($e_abbreviation, ENT_QUOTES);
        $e_abbreviation = $db->_db->real_escape_string($e_abbreviation);
        
        $now = time();
        $sql = "";
        $newID = $id;
        if($id > 0): //update
            $query = "SELECT * FROM episodes WHERE id =" . $newID;
            $result = $db -> result($query);
            $original_comic_id = $result[0]['comic_id'];
            
            $sql = "UPDATE episodes SET comic_id='$comic_id', episode_name='$episode_name', e_abbreviation= '$e_abbreviation' WHERE id = $newID";
            $db->execute($sql);
            
            if($original_comic_id != $comic_id):
                recurse_copy("../images/" . $original_comic_id, "../images/" . $comic_id);
            endif;
        else:
            $sql = "INSERT INTO episodes(comic_id, episode_name, e_abbreviation, created, likes)
                        VALUES('$comic_id', '$episode_name', '$e_abbreviation', '$now', 0)";
            $db->execute($sql);
            $newID = $db->_db->insert_id;
            
            // push notification
            
            $sql = "SELECT * FROM subscribers WHERE comic_id = '$comic_id' GROUP BY device_id ORDER BY id DESC";
            
            $comic_query = "SELECT * FROM comics WHERE id = " . $comic_id;
            $comic = $db->result($comic_query);
            $comic_name = $comic[0]['comic_name'];
            
            $result = $db->result($sql);
            
            $message = "New Episode Is Added In '" . $comic_name . "'";
            
            foreach($result as $row):
                $device_id = $row['device_id'];
                $device_type = $row['device_type'];

                if($device_type == "ios"):
                    push_ios($message, $device_id);
                else:
                    push_android($message, $device_id);
                endif;
            endforeach;
        endif;

        if (isset($_FILES['image'])):
            $default = explode(".", $_FILES["image"]["name"]);
            $extension = end($default);
            $filename = generate_token(8) . "." . $extension;

            $now = time();
            mkdir("../images/" . $comic_id . "/" . $newID);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], '../images/' . $comic_id . '/' . $newID . '/' . $filename))
                $db->execute("UPDATE episodes SET episode_image = '$filename' WHERE id = $newID");
        endif;
        redirect_url('./view_episodes.php');
    }
    
    function adminGetEpisodes($cid = 0, $key = null) {
        global $db;
        
        $sql = "SELECT A.id, A.episode_name, A.e_abbreviation, A.episode_image, B.comic_name, A.comic_id, A.likes, A.active
                FROM episodes A, comics B
                WHERE A.comic_id = B.id";
        if($cid > 0)
            $sql .= " AND A.comic_id = " . $cid;
        
        $sql .= " ORDER BY A.created DESC";
            
        if($cid == -1)
            $sql = "SELECT *
                    FROM episodes
                    WHERE comic_id = (SELECT id FROM comics ORDER BY created DESC LIMIT 1)
                    ORDER BY created DESC";
        
        $result = $db -> result($sql);
                    
        if($key == "ajax_get_episode"):
            $sql = "SELECT A.id, A.episode_name, A.e_abbreviation, A.episode_image, B.comic_name, A.comic_id
                FROM episodes A, comics B
                WHERE A.comic_id = B.id AND A.comic_id = " . $cid . 
                " ORDER BY A.created DESC";
            
            $result = $db->result($sql);
            
            echo json_encode($result);
            exit;
        endif;
        
        return $result;
    }
    
    function deleteEpisode($eid) {
        global $db;
        
        $query = "SELECT * FROM panels WHERE episode_id = " . $eid;
        $query_result = $db->result($query);
        
        for($i = 0; $i < count($query_result); $i ++):
            $sql1 = "DELETE FROM panels WHERE episode_id = " . $eid;
            $db->execute($sql1);
        endfor;
        
        $sql = "DELETE FROM episodes WHERE id = $eid";
        $db->execute($sql);
        redirect_url("./view_episodes.php");
    }
    
    function moveEpisodeFirst($eid) {
        global $db;
        
        $now = time();
        
        $sql = "UPDATE episodes SET created = " . $now . " WHERE id = " . $eid;
        $db->execute($sql);
        
        redirect_url("./view_episodes.php");
    }
    
    function setActive($episode_id, $value) {
        global $db;
        
        if($value == 0):
            $value = 1;
        else:
            $value = 0;
        endif;
        
        $sql = "UPDATE episodes SET active = " . $value . " WHERE id = " . $episode_id;
        
        /*if($db->execute($sql)):
            return true;
        else:
            return false;
        endif;*/
        $db->execute($sql);
        
        redirect_url('./view_episodes.php');
    }

    /* admin */
    function editSetting($userName, $is_changePassword = 0, $newPass = ""){
        global $db;
        $sql = "";
        if($is_changePassword){
            $sql = "UPDATE admin SET username = '" . $userName . "', password = '" . md5($newPass) . "' WHERE id = 1";
        }else{
            $sql = "UPDATE admin SET username = '" . $userName . "' WHERE id = 1";
        }

        $db->execute($sql);

        $info = $db -> single("SELECT * FROM admin WHERE id = 1");
        $_SESSION['user_id'] = $info['id'];
        $_SESSION['username'] = $info['username'];
        $_SESSION['photo'] = "Logo_icon.png";
        $_SESSION['log_in'] = true;
        $_SESSION['password'] = $info['password'];
        $_SESSION['admin'] = $info['permission'];
        redirect_url("./settings.php");
    }
    
    function adminGetInfos() {
        global $db;
        
        $sql = "SELECT * FROM infos ORDER BY id DESC";
        $result = $db->result($sql);
        
        return $result;
    }
    
    function adminGetSubscribes() {
        global $db;
        
        $sql = "SELECT C.comic_name, S.device_id, S.id, S.date, S.time FROM subscribers S, comics C WHERE C.id = S.comic_id ORDER BY S.id DESC";
        $result = $db->result($sql);
        
        return $result;
    }
    
    function deleteInfo($id) {
        global $db;
        
        $sql = "DELETE FROM infos WHERE id = " . $id;
        
        $db->execute($sql);
        redirect_url("./info.php");
    }
    
    function deleteSubscribe($id) {
        global $db;
        
        $sql = "DELETE FROM subscribers WHERE id = " . $id;
        $db->execute($sql);
        
        redirect_url("./subscribes.php");
    }
    
    function recurse_copy($src, $dst) { 
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    recurse_copy($src . '/' . $file, $dst . '/' . $file); 
                } 
                else { 
                    copy($src . '/' . $file,$dst . '/' . $file); 
                } 
            } 
        }
        closedir($dir);
    }
    
    function push_ios($message, $deviceToken) {
        $passphrase = "lupolupo";
        
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'Certificates.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        stream_context_set_option($ctx, 'ssl', 'cafile', 'entrust_2048_ca.cer');
        
        $fp = stream_socket_client(
//                'ssl://gateway.sandbox.push.apple.com:2195', $err,  // development
                'ssl://gateway.push.apple.com:2195', $err,           // distribution
                $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp) {
            fclose($fp);
            echo "Failed to connect: $err $errstr" . PHP_EOL;
        }
        else {
            $body['aps'] = array(
                        'alert' => $message,
                        'sound' => 'default'
                        );

            $payload = json_encode($body);
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
            $result = fwrite($fp, $msg, strlen($msg));

            if (!$result)
                echo 'Message not delivered' . PHP_EOL;
            else
                echo 'Message successfully delivered' . PHP_EOL;
            
            fclose($fp);
        }
    }
    
    function push_android($message, $deviceToken) {
        $apiKey = "AIzaSyByF2Ax3YJq5l6U5yXrkicR-xqR98PBFK0";
//	$apiKey = "AIzaSyDfghGkTDvCcoakfu_b9THTMnc22NbHv5U";
        
        // Replace with the real client registration IDs
        $registrationIDs = array($deviceToken);
        
        // Set POST variables
//        $url = 'https://android.googleapis.com/gcm/send';
        $url = "https://fcm.googleapis.com/fcm/send";
        
        $fields = array(
//            'registration_ids' => $registrationIDs,
            'to' => $deviceToken,
            'notification' => array("body" => $message, "title" => "Lupolupo", "icon" => "appicon"),
            'data' => array("body" => $message, "title" => "Lupolupo", "icon" => "appicon")
        );

        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );
        
        // Open connection
        $ch = curl_init();
        
        // Set the URL, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        
//        echo $result; exit;

        // Close connection
        curl_close($ch);
        return $result;
    }
?>