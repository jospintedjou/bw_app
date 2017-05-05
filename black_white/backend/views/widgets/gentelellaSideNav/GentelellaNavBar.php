<?php

/*
 * This is a custom widget that renders the gentelella template top menu 
 * 
 * A beautiful nav bar for all yii2 projects
 *
 * @author jospin
 */

namespace backend\views\widgets\gentelellaSideNav;



use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class GentelellaNavBar extends \yii\bootstrap\NavBar{
       /**
     * Initializes the widget.
     */
    public function init()
    {
        //parent::init();
        $this->clientOptions = false;
        if (empty($this->options['class'])) {
            Html::addCssClass($this->options, ['navbar', 'navbar-default']);
        } else {
            Html::addCssClass($this->options, ['widget' => 'navbar']);
        }
        if (empty($this->options['role'])) {
            $this->options['role'] = 'navigation';
        }
        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'nav');
        echo Html::beginTag($tag, $options);
        if ($this->renderInnerContainer) {
            if (!isset($this->innerContainerOptions['class'])) {
                Html::addCssClass($this->innerContainerOptions, 'container');
            }
            echo Html::beginTag('div', $this->innerContainerOptions);
        }
        echo Html::beginTag('div', ['class' => 'navbar-header', 'style'=>'background:#222']);
        if (!isset($this->containerOptions['id'])) {
            //$this->containerOptions['id'] = "{$this->options['id']}-collapse";
        }
        echo $this->renderToggleButton();
        if ($this->brandLabel !== false) {
            Html::addCssClass($this->brandOptions, ['widget' => 'navbar-brand']);
            //echo Html::a($this->brandLabel, $this->brandUrl === false ? Yii::$app->homeUrl : $this->brandUrl, $this->brandOptions);
            echo Html::tag('div',  $this->brandLabel,  $this->brandOptions);
        }
        echo Html::endTag('div');
        Html::addCssClass($this->containerOptions, ['collapse' => 'collapse', 'widget' => 'navbar-collapse']);
        $options = $this->containerOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        echo Html::beginTag($tag, $options);
    }
    
    
}
