<?php
namespace AdminLTE;

use Bootstrap\Provider;
use Bootstrap\RegisterContainer;

class AdminLTEWidgetsProvider implements Provider {

    public function register(){
        //RegisterContainer::registerHeadCss(__ROOT__. '/Public/adminlte/css/adminlte.min.css');
        RegisterContainer::registerHeadCss(__ROOT__. '/Public/adminlte/css/adminlte.css');
        RegisterContainer::registerHeadJs(__ROOT__. '/Public/adminlte/js/adminlte.js');
//        RegisterContainer::registerHeadJs(__ROOT__. '/Public/adminlte/js/tab.js');
        RegisterContainer::registerSymLink(WWW_DIR . '/Public/adminlte', __DIR__ . '/../asset/adminlte');
    }
}