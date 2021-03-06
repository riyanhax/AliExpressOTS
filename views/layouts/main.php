<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'AliExpress Order Management System',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Dashboard', 'url' => ['/site/index']],
            [
                'label' => 'Packages',
                'items' => [
                    ['label' => 'All', 'url' => ['/package']],
                    ['label' => 'Awaiting Shipment', 'url' => ['/package?PackageSearch%5Bstatus%5D=Awaiting+Shipment']],
                    ['label' => 'Awaiting Delivery', 'url' => ['/package?PackageSearch%5Bstatus%5D=Awaiting+delivery']],
                    ['label' => 'Cancelled', 'url' => ['/package?PackageSearch%5Bstatus%5D=Cancelled']],
                    ['label' => 'Delivered', 'url' => ['/package?PackageSearch%5Bstatus%5D=Delivered']],
                    ['label' => 'Disputed', 'url' => ['/package?PackageSearch%5Bstatus%5D=Disputed']],
                    ['label' => 'Finished', 'url' => ['/package?PackageSearch%5Bstatus%5D=Finished']],
                ],
            ],
            ['label' => 'Stores', 'url' => ['/store']],
            ['label' => 'Couriers', 'url' => ['/courier']],
            ['label' => 'Payment Methods', 'url' => ['/payment-method']],
            [
                'label' => 'User Management',
                'items' => [
                    ['label' => 'Users', 'url' => ['/user-management/user']],
                    ['label' => 'Groups', 'url' => ['/user-management/role']],
                    ['label' => 'Permissions', 'url' => ['/user-management/permission']],
                ],
            ],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Asim Zeeshan <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
