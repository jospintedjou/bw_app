<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-widgets
 * @subpackage yii2-widget-sidenav
 * @version 1.0.0
 */

namespace backend\views\widgets\gentelellaSideNav;

/**
 * Asset bundle for GentelellaSideNav Widget
 *
 * @author Jospin <tedjoujospin@yahoo.fr>
 * @since 1.0
 */
class SideNavAsset extends \kartik\base\AssetBundle
{
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/custom']);
        $this->setupAssets('js', ['js/custom']);
        parent::init();
    }
}
