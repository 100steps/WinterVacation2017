<?php
$page=$_GET['Page'];
include_once("pdo_db.php");
//找置顶帖
if($page=="1") {
    $findtop = "select `id`,`userid`,`notename` from `forum` where `T-Ftop` = 1 order by `id` desc";
    $find = $dbh->query($findtop);
    $top = array();
    $i = 1;
    while ($row = $find->fetch()) {
        $top[$i] = array(
            "noteid" => $row['id'],
            "userid" => $row['userid'],
            "notename" => $row['notename']
        );
        $i++;
    }
    echo "<br>";
//其余帖子按照发布时间倒序排序(即最新的在上面)
    $number_extra = 25 - count($top);
    $sql_extra = "select*from `forum` where `T-Ftop` != 1 order by `id` desc limit $number_extra";
    $find_extra = $dbh->query($sql_extra);
    $extra = array();
    $i = 1;
    while ($row_extra = $find_extra->fetch()) {
        $extra[$i] = array(
            "noteid" => $row_extra['id'],
            "notename" => $row_extra['notename'],
            "time" => $row_extra['time'],
            "userid" => $row_extra['userid']
        );
        $i++;
    }
}else{

    $findtop = "select `id` from `forum` where `T-Ftop` = 1 order by `id` desc";
    $find = $dbh->query($findtop);
    $top = array();
    $i = 1;
    while ($row = $find->fetch()) {
        $top[$i] = $row['id'];
        $i++;
    }
        $number = $page * 25- count($top);
        $sql_extraid = "select `id` from `forum` where `T-Ftop` != 1 order by `id` desc limit $number";
        $find_extraid = $dbh->query($sql_extraid);
        $extraid = array();
        $i = 1;
        while ($row_extraid = $find_extraid->fetch()) {
            $extraid[$i] = $row_extraid['id'];
            $i++;
        }
        $end = count($extraid);
        $from = ($page - 1) * 25+1-count($top);
        $sql_extra = "select*from `forum` where `id` between $extraid[$from] and $extraid[$end] and `T-Ftop` != 1 order by `id` desc";
        $find_extra = $dbh->query($sql_extra);
        $extra = array();
        $i = 1;
        while ($row_extra = $find_extra->fetch()) {
            $extra[$i] = array(
                "noteid" => $row_extra['id'],
                "notename" => $row_extra['notename'],
                "time" => $row_extra['time'],
                "userid" => $row_extra['userid']
            );
            $i++;
        }
}
//计算页数
$sql="select `id` from `forum` order by `id` desc limit 1";
$res=$dbh->query($sql);
$pages=$res->fetch()['id'];
//返回
echo json_encode(array("top"=>$top,"note"=>$extra,"pages"=>$pages));


