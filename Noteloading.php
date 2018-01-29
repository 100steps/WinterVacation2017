<?php
$noteid=$_GET['NoteId'];
$page=$_GET['Page'];
if(isset($_COOKIE['userid'])){
    $userid=$_COOKIE['userid'];
}else{
    $userid="";
}
include_once("pdo_db.php");
$sql = "select `id` from `forum`";
$res=$dbh->query($sql);
while($row=$res->fetch()){
    if($noteid==$row['id']) {
        $a = 1;
    }
}

if(isset($a)) {
//查找帖子标题和点击数
    $sql_check = "select `id` from `$noteid` order by `id` desc limit 1";
    $res_check = $dbh->query($sql_check);
    while ($row_check = $res_check->fetch()) {
        $pages = ceil($row_check['id'] / 25);
    }
    $sql_findname2 = "select `notename` from `forum` where `id`=$noteid";
    $res_findname2 = $dbh->query($sql_findname2);
    while ($row_findname2 = $res_findname2->fetch()) {
        $notename = $row_findname2['notename'];
    }
    if ($page <= $pages) {
        if ($page == 1) {
            $sql_findname = "select `clickid` from `forum` where `id`=$noteid";
            $res_findname = $dbh->query($sql_findname);
            while ($row_findname = $res_findname->fetch()) {
                $clickid = $row_findname['clickid'] + 1;
            }
//增加点击计数
            $sql_add = "update `forum` set `clickid`=$clickid where `id`=$noteid";
            $res_add = $dbh->exec($sql_add);
        }
        $from = ($page - 1) * 25 + 1;
        $to = $page * 25;
        $sql_findfloor = "select*from `$noteid` where `id` between $from and $to order by `id` asc ";
        $res_findfloor = $dbh->query($sql_findfloor);
        $floor = array();
        while ($row_findfloor = $res_findfloor->fetch()) {
            $praise = $row_findfloor['praise'];
            $praiser = explode(",", $praise);
            if (in_array($userid, $praiser)) {
                $dianzan = "1";
                $dianzanid = count($praiser);
            } else {
                $dianzan = "0";
                $dianzanid = count($praiser);
            }
            $i = $row_findfloor['id'];

            $userid = $row_findfloor['userid'];
            include_once('pdo_db.php');
            $sql = "select `username`,`userphoto` from `users` where `userid`= $userid ";
            $res = $dbh->query($sql);
            while ($row = $res->fetch()) {
                $username = $row['username'];
                $userphoto = $row['userphoto'];
                $floor[$i] = array(
                    "content" => $row_findfloor['floorcontent'],
                    "username" => $username,
                    "userphoto" => $userphoto,
                    "userid" => $userid,
                    "time" => $row_findfloor['time'],
                    "quoter" => $row_findfloor['quoter'],
                    "praiseid" => $dianzanid,
                    "T-Fpraise" => $dianzan
                );

            }


        }
        for ($a = $from; $a < ($from + count($floor)); $a++) {
            if ($floor[$a]['quoter'] != 0) {
                $quoterid = $floor[$a]['quoter'];
                $sql_quoter = "select `floorcontent`,`userid`,`time` from `$noteid` where `id`=$quoterid ";
                $res_quoter = $dbh->query($sql_quoter);
                while ($row_quoter = $res_quoter->fetch()) {
                    $userid = $row_quoter['userid'];
                    include_once('pdo_db.php');
                    $sql = "select `username`,`userphoto` from `users` where `userid`= $userid ";
                    $res = $dbh->query($sql);
                    while ($row = $res->fetch()) {
                        $username = $row['username'];
                        $userphoto = $row['userphoto'];
                        $floor[$a]['quoter'] = array(
                            "content" => $row_quoter['floorcontent'],
                            "time" => $row_quoter['time'],
                            "quoterid" => $floor[$a]['quoter'],
                            "username" => $username,
                            "userphoto" => $userphoto,
                            "userid" => $userid

                        );
                    }

                }
            }
        }
        echo json_encode(array("floor" => $floor, "pages" => $pages, "notename" => $notename));
    } else {
        echo json_encode(array("result" => "N"));
    }
}else{
    echo json_encode(array("result"=>"N"));
}