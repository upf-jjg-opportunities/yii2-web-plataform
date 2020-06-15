<?php
namespace frontend\modules\curriculum\controllers;

use common\models\my\Curriculum;

use Yii;

/**
 * Site controller
 */
class SiteBaseController extends \frontend\controllers\SiteBaseController
{

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)){
            return false;
        }

        if(Curriculum::one()->isNewRecord && !($this->id == 'change' && $action->id == 'init')){
            return $this->redirect(['/curriculum/change/init']);
        }

        return true;
    }
    

}