<?php
namespace frontend\modules\curriculum\controllers;

use common\models\Curriculum;
use kartik\grid\EditableColumnAction;

use yii\helpers\ArrayHelper;

use Yii;

/**
 * SiteBase controller
 */
class ChangeController extends SiteBaseController
{
    /**
     * Update Curriculum basics info
     *
     * @return mixed html
     */
    function actionIndex()
    {   
        $model = Curriculum::one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('', [
                [
                    'title' => 'Success!!',
                    'text' => 'your abstract has been updated successfully!',
                    'timer' => 2000,
                ],
            ]);

            return $this->redirect('/curriculum');
        } 

        return $this->render('index', [
            'model' => $model
        ]);
    }


    /**
     * Starts a new Curriculum
     *
     * @return mixed html
     */
    function actionInit()
    {   
        $model = Curriculum::one();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('', [
                [
                    'title' => 'Congratulations!!',
                    'text' => 'now we can start your curriculum!',
                    'timer' => 2000,
                ],
            ]);
        } 

        if(!$model->isNewRecord){
            return $this->redirect('/curriculum/update');
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)){
            return false;
        }

        if (!Yii::$app->request->isAjax && $action->id != 'init' && $action->id != 'index' && $action->id != 'delete'){
            return $this->redirect(['/curriculum/change'])->send();
        }

        return true;
    }
}