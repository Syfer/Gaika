<?php

namespace app\models\component;

use yii\db\ActiveRecord;

class ExtraModel extends ActiveRecord
{

    public $extraFields = [];
    
    public function __set($name, $value)
    {                
        if ($this->hasAttribute($name)) {
            $this->setAttribute($name, $value);
        } else {
            $this->extraFields[$name] = $value;
            $this->$name = $value;
        }        
    }
    
    public function getAttributes($names = null, $except = array())
    {
        $attributes = parent::getAttributes($names, $except);
        foreach($this->extraFields as $name => $value){
            $attributes[$name] = $value;
        }
        
        return $attributes;
    }
    
    public function behaviors()
    {
        return [
            'extra' => [
                'class' => 'app\models\behavior\ExtraBehavior'
            ]
        ];
    }

}
