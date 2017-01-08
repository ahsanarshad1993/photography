<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
        'styles/main.css',
        'styles/fonts/fonts.css',
        'script/lightbox2/dist/css/lightbox.min.css',
        'script/justifiedGallery/justifiedGallery.min.css'
    ];
    public $js = [
        // 'script/galleria-1.5.1/galleria/galleria-1.5.1.min.js',
        'script/lightbox2/dist/js/lightbox.min.js',
        'script/justifiedGallery/jquery.justifiedGallery.min.js',
        'script/jQuery-File-Upload-9.14.1/js/vendor/jquery.ui.widget.js',
        'script/main.js',
        'script/navigation.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
