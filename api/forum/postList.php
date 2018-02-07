<?php
require_once '../object/basisHandleMysql.php';
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "GET":
        $section=$_GET['section'];
        $type=$_GET['type'];
        $start=intval($_GET['start'])-1;//数组从零开始所以减一
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
            case "author":
                $author=$_GET['author'];
                $data=$obj->select('post','*',"author='{$author}' 
                order by id desc limit {$start},{$amount}");
                break ;
        }
        $tmp=0;
        if($type!="author"){
            if($list==0){
                $reply=array('code'=>404,'error'=>"查询失败");
                echo json_encode($reply);
                break;
            }
            foreach ($list as $idArray) {
                $id=intval($idArray['id']);
                $data[$tmp] = $obj->select('post', 'id,title,author,date,essential
                    ,replyAmount', "id=$id")[0];
                $tmp++;
            }
        }
        $reply['number']=count($data);
        $reply['postList']=$data;
        $reply['code']=200;
        echo json_encode($reply);
        break;
}