<?php

namespace common\models\my;

use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use kartik\icons\Icon;

use Yii;

/**
 * This is the model class for table "curriculum_experience".
 *
 * @property int $id
 * @property int $id_curriculum
 * @property string|null $name
 * @property string|null $role
 * @property int|null $year_init
 * @property int|null $year_end
 *
 * @property Curriculum $curriculum
 */
class CurriculumExperience extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curriculum_experience';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_curriculum'], 'required'],
            [['id_curriculum', 'year_init', 'year_end'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['role'], 'string', 'max' => 250],
            [['id_curriculum'], 'exist', 'skipOnError' => true, 'targetClass' => Curriculum::className(), 'targetAttribute' => ['id_curriculum' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_curriculum' => Yii::t('app', 'Id Curriculum'),
            'name' => Yii::t('app', 'Company'),
            'role' => Yii::t('app', 'Role'),
            'year_init' => Yii::t('app', 'Year Init'),
            'year_end' => Yii::t('app', 'Year End'),
        ];
    }

    /**
     * Gets query for [[Curriculum]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculum()
    {
        return $this->hasOne(Curriculum::className(), ['id' => 'id_curriculum']);
    }

    /**
     * Gets All Experiences
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function getDataProvider()
    {
        return new ActiveDataProvider([
            'query' => self::find()->andWhere(['id_curriculum' => $this->id_curriculum]),
            'pagination' => false
        ]);
    }

    public function getGridColumns($searchModel = null)
    {
        return [
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'name',
                'editableOptions' => ['formOptions' => ['action' => ['/curriculum/change/edit-experience']]]
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'role',
                'editableOptions' => ['formOptions' => ['action' => ['/curriculum/change/edit-experience']]]
            ],
            ['class' => 'yii\grid\ActionColumn',
                'options' => ['width' => 32],
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return \yii\helpers\Html::a(Icon::show('trash'), \yii\helpers\Url::to(['delete', 'id' => $model->id, 'modelclass' => self::className()]), [
                            'title' => 'Excluir',
                            'class' => 'sa-delete',
                            'data-pjax-id' => '#grid-curriculo-experiencia'
                        ]);
                    },
                ]
            ],
        ];
    }
}
