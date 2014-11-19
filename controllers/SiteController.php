<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Page;


class SiteController extends Controller
{
    
    public function actionIndex()
    {
        $request = Yii::$app->request;
        
        $pages = Page::find()->all();
        $currentPage = null;
        $alias = $request->get("alias");
                                
        if(!empty($alias)){
          $currentPage = Page::findOne(["alias" => $alias]);
        }
                
        return $this->render('index', ["pages" => $pages, "page" => $currentPage]);
    }

}
