<?php
namespace frontend\modules\curriculum\controllers;

use common\models\my\Curriculum;

use Yii;

/**
 * SiteBase controller
 */
class SiteController extends SiteBaseController
{
    function actionIndex()
    {
        return $this->render('index', [
            'model' => Curriculum::one()
        ]);
    }

    
}