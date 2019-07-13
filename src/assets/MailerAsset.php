<?php

/**
 * MailAsset
 *
 * Asset mailer user custom
 **/

namespace terabytesoft\mailer\user\assets;

use yii\web\AssetBundle;

class MailerAsset extends AssetBundle
{
    /**
     * @var array $css
     */
    public $css = [
        'mailer.css',
    ];

    /**
     * @var array $publishOptions
     */
    public $publishOptions = [
        'only' => [
            'mailer.css',
        ],
    ];

    /**
     * @var string $sourcePath
     */
    public $sourcePath = __DIR__ . '/css';

    /**
     * init
     */
    public function init(): void
    {
        parent::init();
    }
}
