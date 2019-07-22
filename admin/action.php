<?php
    require_once "./function.php";

$param = $_REQUEST;

$response = array();

if(!isset($param['key'])) {
    redirect_url("./index.php");
}

switch($param['key']) {
    case "login":
        login($param['username'], $param['password']);
        break;
    case "editComic":
        $new_comic = array("id" => 0, "comic_name" => "", "comic_abbreviation" => "", "comic_image" => "", "comic_big_image" => "");
        $new_comic['id'] = $param['cid'];
        $new_comic['comic_name'] = $param['comicName'];
        $new_comic['comic_abbreviation'] = $param['abbreviation'];
        editComic($new_comic);
        break;
    case "delComic":
        deleteComic($param['cid']);
        break;
    case "moveFirst":
        moveComicFirst($param['cid']);
        break;
    case "editEpisode":
        $new_episode = array("id" => 0, "comic_id" => "", "episode_name" => "", "e_abbreviation" => "", "episode_image" => "");
        $new_episode['id'] = $param['eid'];
        $new_episode['comic_id'] = $param['comicName'];
        $new_episode['episode_name'] = $param['episode_name'];
        $new_episode['e_abbreviation'] = $param['e_abbreviation'];
        editEpisode($new_episode);
        break;
    case "delEpisode":
        deleteEpisode($param['eid']);
        break;
    case "e_moveFirst":
        moveEpisodeFirst($param['eid']);
        break;
    case "editPanel":
        $id = $param['pid'];
        $comic_id = $param['comicName'];
        $episode_id = $param['episodeName'];
        editPanel($id, $comic_id, $episode_id);
        break;
    case "delPanel":
        deletePanel($param['pid']);
        break;
    case "p_moveFirst":
        movePanelFirst($param['pid']);
        break;
    case "editSetting":
        if($param['changePassword'] == 0) {
            editSetting($param['userName'], 0, "");
        } else {
            editSetting($param['userName'], 1, $param['newPassword']);
        }
        break;
    case "ajax_get_episode":
        $comic_id = $param['comic_id'];
        $key = "ajax_get_episode";
        echo json_encode(adminGetEpisodes($comic_id, $key));
        break;
    case "ajax_set_active":
        $episode_id = $param['episode_id'];
        $value = $param['value'];
        echo setActive($episode_id, $value);
        break;
    case "active":
        $episode_id = $param['eid'];
        $value = $param['value'];
        echo setActive($episode_id, $value);
        break;
    case "delInfo":
        deleteInfo($param['iid']);
        break;
    case "delSubscribe":
        deleteSubscribe($param['sid']);
        break;
    default:
        redirect_url("./index.php");
}
print_r($response);
exit;
?>