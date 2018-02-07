<?php
require_once '../object/basisHandleMysql.php';
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "GET":
        $section=$_GET['section'];
        $type=$_GET['type'];
        $start=intval($_GET['start'])-1;
        $amount=intval($_GET['amount']);
        $obj=new basisHandleMysql();
        switch ($type){
            case "active":
                $list=$obj->select('postList','id',"top=0 
                order by number desc limit {$start},{$amount}");
                break ;
            case "top":
                $list=$obj->select('postList','id',"top=1 
                order by number desc limit {$start},{$amount}");
                break ;
            case "essential":
                $list=$obj->select('postList','id',"essential=1 
                order by number desc limit {$start},{$amount} ");
                break ;
        }
        $tmp=0;
        foreach ($list as $idArray) {
            $id=intval($idArray['id']);
            $data[$tmp] = $obj->select('post', 'id,title,author,date,essential
                    ,replyAmount', "id=$id");
            $tmp++;
        }
        $reply['postList']=$data;
        $reply['number']=$tmp-1;
        $reply['code']=200;
        echo json_encode($reply);
        break;
}