<?php
namespace AdminLTE;

use Qscmf\Lib\DBCont;
use Think\View;

class Content{

    protected $title = ' ';
    protected $view = null;
    protected $nid;
    protected $rows = [];

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function setNIDByNode($module = MODULE_NAME, $controller = CONTROLLER_NAME, $action = 'index'){
        $module_ent = D('Node')->where(['name' => $module, 'level' => DBCont::LEVEL_MODULE, 'status' => DBCont::NORMAL_STATUS])->find();

        if(!$module_ent){
            E('setNIDByNode 传递的参数module不存在');
        }

        $controller_ent = D('Node')->where(['name' => $controller, 'level' => DBCont::LEVEL_CONTROLLER, 'status' => DBCont::NORMAL_STATUS, 'pid' => $module_ent['id']])->find();
        if(!$controller_ent){
            E('setNIDByNode 传递的参数controller不存在');
        }

        $action_ent = D('Node')->where(['name' => $action, 'level' => DBCont::LEVEL_ACTION, 'status' => DBCont::NORMAL_STATUS, 'pid' => $controller_ent['id']])->find();
        if(!$action_ent){
            E('setNIDByNode 传递的参数action不存在');
        }
        else{
            return $this->setNID($action_ent['id']);
        }
    }

    public function addRow($row, $width = 12, $auth_node = null){
        $row = filterOneItemWiAuthNode($row, $auth_node);

        if($row && $row instanceof Row){
            $this->rows[] = $row;
        }
        elseif($row){
            $this->rows[] = new Row($row, $width);
        }

        return $this;
    }


    public function setNID($nid){
        $this->nid = $nid;
        return $this;
    }

    public function title($title){
        $this->title = $title;
        return $this;
    }

    protected function render(){
        return implode(PHP_EOL, $this->rows);
    }

    public function display(){
        $this->view->assign('title', $this->title);
        $this->view->assign('nid', $this->nid);
        $this->view->assign('content', $this->render());
        $this->view->display(__DIR__ . '/Views/content.html');
    }
}