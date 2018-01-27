<?php
$noteid=$_GET['NoteId'];
$page=$_GET['Page'];
if(isset($_COOKIE['userid'])){
    $userid=$_COOKIE['userid'];
}else{
    $userid="";
}
//查找帖子标题和点击数
include_once("pdo_db.php");
//查页数
$sql_check="select `id` from `$noteid` order by `id` desc limit 1";
$res_check=$dbh->query($sql_check);
while($row_check=$res_check->fetch()){
    $pages=ceil($row_check['id']/25);
}
if($page<=$pages) {
    if ($page == 1) {
        $sql_findname = "select `notename`,`clickid` from `forum` where `id`=$noteid";
        $res_findname = $dbh->query($sql_findname);
        while ($row_findname = $res_findname->fetch()) {
            $clickid = $row_findname['clickid'] + 1;
            $notename = $row_findname['notename'];
        }
//增加点击计数
        $sql_add = "update `forum` set `clickid`=$clickid where `id`=$noteid";
        $res_add = $dbh->exec($sql_add);
    }
//查找帖子内容
    $from = ($page - 1) * 25 + 1;
    $to = $page * 25;
    $sql_findfloor = "select*from `$noteid` where `id` between $from and $to order by `id` asc ";
    $res_findfloor = $dbh->query($sql_findfloor);
    $floor = array();
    while ($row_findfloor = $res_findfloor->fetch()) {
        if ($row_findfloor['id'] == 1) {
            $praise = $row_findfloor['praise'];
            $praiser = explode(",", $praise);
            if (in_array($userid, $praiser)) {
                $dianzan = "1";
                $dianzanid = count($praiser);
            } else {
                $dianzan = "0";
                $dianzanid = count($praiser);
            }
            $tiezi = array(
                "name" => $notename,
                "content" => $row_findfloor['floorcontent'],
                "userid" => $row_findfloor['userid'],
                "time" => $row_findfloor['time'],
                "praiseid" => $dianzanid,
                "T-Fpraise" => $dianzan
            );
        } else {
            $i = $row_findfloor['id'] - 1;
            $praise = $row_findfloor['praise'];
            $praiser = explode(",", $praise);
            if (in_array($userid, $praiser)) {
                $dianzan = "1";
                $dianzanid = count($praiser);
            } else {
                $dianzan = "0";
                $dianzanid = count($praiser);
            }
            $floor[$i] = array(
                "content" => $row_findfloor['floorcontent'],
                "userid" => $row_findfloor['userid'],
                "time" => $row_findfloor['time'],
                "quoter" => $row_findfloor['quoter'],
                "praiseid" => $dianzanid,
                "T-Fpraise" => $dianzan
            );
        }
    }
    if ($page != 1) {
        for ($a = ($from - 1); $a < ($from + count($floor) - 1); $a++) {
            if ($floor[$a]['quoter'] != null) {
                $quoterid = $floor[$a]['quoter'] + 1;
                $sql_quoter = "select `floorcontent`,`userid`,`time` from `$noteid` where `id`=$quoterid ";
                $res_quoter = $dbh->query($sql_quoter);
                while ($row_quoter = $res_quoter->fetch()) {
                    $floor[$a]['quoter'] = array(
                        "content" => $row_quoter['floorcontent'],
                        "userid" => $row_quoter['userid'],
                        "time" => $row_quoter['time'],
                        "quoterid" => $floor[$a]['quoter']
                    );
                }
            }
        }
    } else {
        for ($a = $from; $a < ($from + count($floor)); $a++) {
            if ($floor[$a]['quoter'] != null) {
                $quoterid = $floor[$a]['quoter'] + 1;
                $sql_quoter = "select `floorcontent`,`userid`,`time` from `$noteid` where `id`=$quoterid ";
                $res_quoter = $dbh->query($sql_quoter);
                while ($row_quoter = $res_quoter->fetch()) {
                    $floor[$a]['quoter'] = array(
                        "content" => $row_quoter['floorcontent'],
                        "userid" => $row_quoter['userid'],
                        "time" => $row_quoter['time'],
                        "quoterid" => $floor[$a]['quoter']
                    );
                }
            }
        }
    }


    if ($page == 1) {
        echo json_encode(array("tiezi" => $tiezi, "floor" => $floor, "pages" => $pages));
    } else {
        echo json_encode(array("floor" => $floor, "pages" => $pages));
    }
}else{
    echo json_encode(array("result"=>"N"));
}
