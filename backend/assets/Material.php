<?php

namespace backend\assets;

use yii\web\AssetBundle;

class Material extends AssetBundle
{
    public $sourcePath = "@bower/bootstrap-material-design/dist";

    public $css = [
        'css/bootstrap-material-design.min.css',
        'css/ripples.min.css'
    ];

    public $js = [
        'js/material.min.js',
        'js/ripples.min.js'
    ];
}