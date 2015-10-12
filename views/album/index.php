<?php

use webvimark\extensions\GridPageSize\GridPageSize;
use yeesoft\grid\GridView;
use yeesoft\helpers\Html;
use yeesoft\media\models\Album;
use yeesoft\media\models\Category;
use yeesoft\Yee;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel yeesoft\media\models\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Albums';
$this->params['breadcrumbs'][] = ['label' => Yee::t('back', 'Media'), 'url' => ['/media']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?= Html::encode($this->title) ?></h3>
            <?= Html::a('Add New', ['/media/album/create'], ['class' => 'btn btn-sm btn-primary']) ?>
            <?= Html::a('Manage Categories', ['/media/category/index'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12 text-right">
                    <?= GridPageSize::widget(['pjaxId' => 'album-grid-pjax']) ?>
                </div>
            </div>

            <?php Pjax::begin(['id' => 'album-grid-pjax']) ?>

            <?= GridView::widget([
                'id' => 'album-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'album-grid',
                    'actions' => [Url::to(['bulk-delete']) => 'Delete'],
                ],
                'columns' => [
                    ['class' => 'yii\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'yeesoft\grid\columns\TitleActionColumn',
                        'controller' => '/media/album',
                        'title' => function (Album $model) {
                            return Html::a($model->title, ['update', 'id' => $model->id], ['data-pjax' => 0]);
                        },
                        'buttonsTemplate' => '{update} {delete}',
                    ],
                    'description:ntext',
                    [
                        'attribute' => 'category_id',
                        'filter' => Category::getCategories(true),
                        'value' => function (Album $model) {
                            return $model->category->title;
                        },
                        'format' => 'raw',
                        'filterInputOptions' => [],
                    ],
                    [
                        'class' => 'yeesoft\grid\columns\StatusColumn',
                        'attribute' => 'visible',
                    ],
                ],
            ]); ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>