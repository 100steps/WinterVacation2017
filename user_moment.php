<?php
if($_COOKIE['userid']) {
    $userid = $_COOKIE['userid'];
    include_once("pdo_usersmoment.php");
    $sql_findmoment = "select*from `$userid` order by `id` desc";
    $res_findmoment = $dbh->query($sql_findmoment);
    $i = 1;
    $moment = array();
    while ($row_findmoment = $res_findmoment->fetch()) {
        if ($row_findmoment['response'] != null) {
            $moment[$i] = array(
                "type" => "response",
                "moment" => $row_findmoment['response'],
                "time" => $row_findmoment['time']
            );
        } else if ($row_findmoment['comment'] != null) {
            $moment[$i] = array(
                "type" => "comment",
                "moment" => $row_findmoment['comment'],
                "time" => $row_findmoment['time']
            );
        } else if ($row_findmoment['friend_moment'] != null) {
            $moment[$i] = array(
                "type" => "friend_moment",
                "moment" => $row_findmoment['friend_moment'],
                "time" => $row_findmoment['time']
            );
        }
        $i++;
    }
    include_once("pdo_db.php");
    for ($i = 1; $i <= count($moment); $i++) {
        if ($moment[$i]['type'] == "response") {
            $str = "/^(\w+)-(\w+)-(\w+)$/u";
            preg_match_all($str, $moment[$i]['moment'], $output);
            $responseid = $output[1][0];
            $noteid = $output[2][0];
            $floor = $output[3][0];
            $sql_findnotename="select `notename` from `forum` where `id`=$noteid";
            $res_findnotename=$dbh->query($sql_findnotename);
            while($row_findnotename=$res_findnotename->fetch()){
                $notename=$row_findnotename['notename'];
            }
            $sql_moment = "select*from `$noteid` where `id`=$floor";
            $res_moment = $dbh->query($sql_moment);
            while ($row_moment = $res_moment->fetch()) {
                $praise = $row_moment['praise'];
                $praiser = explode(",", $praise);
                if (in_array($userid, $praiser)) {
                    $dianzan = "1";
                    $dianzanid = count($praiser);
                } else {
                    $dianzan = "0";
                    $dianzanid = count($praiser);
                }
                $userid2 = $row_moment['userid'];
                $sql_finduser = "select `username`,`userphoto` from `users` where `userid`= $userid2 ";
                $res_finduser = $dbh->query($sql_finduser);
                while ($row_finduser = $res_finduser->fetch()) {
                    $moment[$i]['moment'] = array(
                        "notename"=>$notename,
                        "content" => $row_moment['floorcontent'],
                        "time" => $row_moment['time'],
                        "quoter" => $row_moment['quoter'],
                        "userid" => $userid2,
                        "username" => $row_finduser['username'],
                        "userphoto" => $row_finduser['userphoto'],
                        "praiseid" => $dianzanid,
                        "T-Fpraise" => $dianzan
                    );
                }
            }
            $quoterid = $moment[$i]['moment']['quoter'];
            $sql_quoter = "select `floorcontent`,`userid`,`time` from `$noteid` where `id`=$quoterid ";
            $res_quoter = $dbh->query($sql_quoter);
            while ($row_quoter = $res_quoter->fetch()) {
                $userid = $row_quoter['userid'];
                $sql = "select `username`,`userphoto` from `users` where `userid`= $userid ";
                $res = $dbh->query($sql);
                while ($row = $res->fetch()) {
                    $username = $row['username'];
                    $userphoto = $row['userphoto'];
                    $moment[$i]['moment']['quoter'] = array(
                        "content" => $row_quoter['floorcontent'],
                        "time" => $row_quoter['time'],
                        "quoterid" => $quoterid,
                        "username" => $username,
                        "userphoto" => $userphoto,
                        "userid" => $userid
                    );
                }
            }
        }else if($moment[$i]['type']=="comment"){
            $str="/^new-(\w+)-(\w+)$/u";
            preg_match_all($str,$moment[$i]['moment'],$output);
            $tiezi=$output[1][0];
            $number=$output[2][0];
            $sql="select `notename` from `forum` where `id`=$tiezi";
            $res=$dbh->query($sql);
            while($row=$res->fetch()){
                $moment[$i]['moment']=array(
                    "notename"=>$row['notename'],
                    "number"=>$number,
                    "noteid"=>$tiezi
                );
            }
        }else if($moment[$i]['type']=="friend_moment"){
            $str="/^(\w+)-(\w+)$/u";
            preg_match_all($str,$moment[$i]['moment'],$output);
            $tiezi=$output[2][0];
            $friendid=$output[1][0];
            $sql="select`notename`,`time` from `forum` where `id`=$tiezi";
            $res=$dbh->query($sql);
            while($row=$res->fetch()){
                $sql2 = "select `username`,`userphoto` from `users` where `userid`= $friendid ";
                $res2 = $dbh->query($sql2);
                while($row2 = $res2->fetch()) {
                    $username = $row2['username'];
                    $userphoto = $row2['userphoto'];
                    $moment[$i]['moment'] = array(
                        "noteid" => $tiezi,
                        "notename" => $row['notename'],
                        "username"=>$username,
                        "userphoto"=>$userphoto,
                        "userid"=>$friendid
                    );
                }
            }
        }
    }
    echo json_encode(array("moment"=>$moment));
}else{
    echo json_encode(array("result"=>"N"));
}
