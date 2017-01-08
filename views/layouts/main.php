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

    <div class="container">
        <div class="row">
            <div class="col-md-3 sidebar">
                <a href="/muk-photography/web">
                    <div class="logo">
                        <span>Mir</span>
                        <br/><span>Usman</span>
                        <br/>Kaiser
                    </div>
                </a>
                <div class=" affix-top">
                  <nav id="site-navigation" class="main-navigation" role="navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Menu</button>
                    <div>
                      <ul class="nav nav-menu" id="primary-menu" aria-expanded="false">
                        <li class="active"><a href="/muk-photography/web">Home</a></li>
                        <li><a href="?r=images/featured">Featured</a></li>
                        <li><a href="?r=albums/display">Albums</a></li>
                        <li></br></li>
                        <li><a href="?r=site/about">About</a></li>
                        <li><a href="?r=site/contact">Contact</a></li>
                        <li><br></li>
                        <?php if(Yii::$app->user->isGuest){?>
                            <li><a href="?r=site/login">Login</a></li>
                        <?php }else{ ?>
                            <li><a href="?r=images/index">Admin</a></li>
                            <li>
                                <?= Html::beginForm(['/site/logout'], 'post') ?>
                                <?= Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout menubutton']) ?>
                                <?= Html::endForm() ?>
                            </li>
                        <?php } ?>
                      </ul>
                    </div>
                    <!--/.well -->
                  </nav>
                </div>
                <!--/sidebar-nav-fixed -->
            </div>
            <div class="col-md-9 mainbody">
                <div style="font-weight: bold;">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                 </div>
                <?= $content ?>
            </div>
        </div>

        
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="moveleft">&copy; MUK Photography <?= date('Y') ?></p>

        <p class="moveright">Designed & Developed by Ahsan Arshad</p>
    </div>
</footer>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
