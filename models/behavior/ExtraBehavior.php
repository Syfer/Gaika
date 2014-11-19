<?php

namespace app\models\behavior;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\models\component\ExtraField;

class ExtraBehavior extends Behavior
{

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
        ];
    }

    public function afterSave($event)
    {
        $extraFields = $this->owner->extraFields;
        $model = get_class($this->owner);
        $modelId = $this->owner->id;
        foreach ($extraFields as $name => $value) {
            $extraField = ExtraField::findOne(['model' => $model, 'model_id' => $modelId, 'name' => $name]);
            if (empty($extraField)) {
                $extraField = new ExtraField();
                $extraField->model = $model;
                $extraField->model_id = $modelId;
                $extraField->name = $name;
            }
            $extraField->content = $value;
            $extraField->save();
        }
    }

    public function afterFind($event)
    {
        $model = get_class($this->owner);
        $modelId = $this->owner->id;
        $extraFields = ExtraField::findAll(['model' => $model, 'model_id' => $modelId]);
        if(!empty($extraFields)){
            foreach ($extraFields as $extraField) {
                $this->owner->{$extraField->name} = $extraField->content;
            }
        }
    }

    public function beforeDelete($event)
    {
        $model = get_class($this->owner);
        $modelId = $this->owner->id;
        ExtraField::deleteAll(['model' => $model, 'model_id' => $modelId]);
    }

}
