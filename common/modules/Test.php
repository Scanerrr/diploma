<?php

namespace common\modules;

/**
 * test module definition class
 */
class Test extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'common\modules\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
