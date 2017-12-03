<?php

namespace yeesoft\media\controllers;

use yeesoft\controllers\CrudController;

class DefaultController extends CrudController
{

    public $modelClass = 'yeesoft\media\models\Media';
    public $modelSearchClass = 'yeesoft\media\models\MediaSearch';
    public $disabledActions = ['view', 'create', 'update', 'delete', 'toggle-attribute',
        'bulk-activate', 'bulk-deactivate', 'bulk-delete', 'grid-sort', 'grid-page-size'];

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSettings()
    {
        return $this->render('settings');
    }

}
