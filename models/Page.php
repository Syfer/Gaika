<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\component\ExtraModel;

class Page extends ExtraModel
{    
    public static function tableName()
    {
        return 'page';
    }
}
