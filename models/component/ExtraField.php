<?php

namespace app\models\component;

use yii\db\ActiveRecord;

class ExtraField extends ActiveRecord
{

    public static function tableName()
    {
        return 'tv_text';
    }

}
