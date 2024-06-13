<?

namespace app\controllers;
use vendor\core\base\Conteroller;

class Page extends Conteroller{

    public function viewAction(){
        debug($this->route);
        debug($_GET);
        echo 'Page::view';
      
    }
}