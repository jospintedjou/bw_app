<?php

/*
 * This is a custom widget that renders the gentelella template menu 
 * 
 * A beautiful side nav for all yii2 projects
 *
 * @author jospin
 */

namespace backend\views\widgets\gentelellaSideNav;



use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class GentelellaSideNav extends \kartik\sidenav\SideNav{
    /**
     * @var string prefix for the icon in [[items]]. This string will be prepended
     * before the icon name to get the icon CSS class. This defaults to `glyphicon glyphicon-`
     * for usage with glyphicons available with Bootstrap.
     */
    public $iconPrefix = 'fa fa-';
    public $indItem = "";
    /**
     * @var string indicator for a opened sub-menu
     */
    public $indMenuOpen = '<span class="indicator fa fa-chevron-down"></span>';

    /**
     * @var string indicator for a closed sub-menu
     */
    public $indMenuClose = '<span class="indicator fa fa-chevron-down"></span>';
    /** user picture path @example uploads/img_profile.png **/
    public $picturePath;
    /** user name**/
    public $username;
    public function init()
    {
        //parent::init();
        SideNavAsset::register($this->getView());
        $this->activateParents = true;
        $this->submenuTemplate = "\n<ul class='nav child_menu'>\n{items}\n</ul>\n";
        $this->linkTemplate = '<a href="{url}">{icon}{label}</a>';
        $this->labelTemplate = '{icon}{label}';
        $this->heading = $this->username ? '<div class="navbar nav_title" style="border: 0;"><a href="" class="site_title">'
                                            . '<i class="fa fa-paw"></i> <span>BLACK&WHITE</span></a>'
                                            . '</div>'
                                            . '<div class="clearfix"></div>
                                                            <div class="profile clearfix">
                                                              <div class="profile_pic">
                                                                <img src="'.$this->picturePath . '" alt="..." class="img-circle profile_img">
                                                              </div>
                                                             <div class="profile_info">
                                                                <span>Bienvenu</span>
                                                                <h2>' .ucFirst($this->username ). '</h2>
                                                             </div>
                                                          </div><br />' : '';
        $this->markTopItems();
        Html::addCssClass($this->options, '');
    }
    
    /**
     * Renders the side navigation menu.
     * with the heading and panel containers
     */
    public function run()
    {
        $heading = '';
        if (isset($this->heading) && $this->heading != '') {
            //Html::addCssClass($this->headingOptions, 'panel-heading');
           // $heading = Html::tag('div', '<h3 class="panel-title">' . $this->heading . '</h3>', $this->headingOptions);
            $heading =  $this->heading ;
        }
        //$div = Html::tag('div', $this->renderMenu(), ['class' => 'main_menu_side hidden-print main_menu', 'id' => 'sidebar-menu']);
        $body = Html::tag('div', '<div class="menu_section">'.$this->renderMenu().'</div>', 
                                ['class' => 'main_menu_side hidden-print main_menu', 
                                 'id' => 'sidebar-menu']);
        //$type = in_array($this->type, self::$_validTypes) ? $this->type : self::TYPE_DEFAULT;
        Html::addCssClass($this->containerOptions, "left_col scroll-view");
        echo Html::tag('div', $heading . $body, $this->containerOptions);
    }
    
       /**
     * Renders the content of a side navigation menu item.
     *
     * @param array $item the menu item to be rendered. Please refer to [[items]] to see what data might be in the item.
     * @return string the rendering result
     * @throws InvalidConfigException
     */
    protected function renderItem($item)
    {
        $this->validateItems($item);
        $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
        $url = Url::to(ArrayHelper::getValue($item, 'url', '#'));
        if (empty($item['top'])) {
            if (empty($item['items'])) {
               // $this->linkTemplate = '<a style="color:white; font-size:12px; margin-left:10px" href="{url}">{icon}{label}</a>';
                //$template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
                $template = str_replace('{icon}', $this->indItem . '{icon}', $template);
            } else {
                $template = isset($item['template']) ? $item['template'] :'<a>{icon}{label}</a>';
                //$openOptions = ($item['active']) ? ['class' => 'opened'] : ['class' => 'opened', 'style' => 'display:none'];
                //$closeOptions = ($item['active']) ? ['class' => 'closed', 'style' => 'display:none'] : ['class' => 'closed'];
                //$indicator = Html::tag('span', $this->indMenuOpen, $openOptions) . Html::tag('span', $this->indMenuClose, $closeOptions);
                $indicator = $this->indMenuOpen;
                $template = str_replace('{icon}', $indicator . '{icon}', $template);
            }
        }
        $icon = empty($item['icon']) ? '' : '<i class="' . $this->iconPrefix .$item['icon'] . '"></i> &nbsp;';
        unset($item['icon'], $item['top']);
        return strtr($template, [
            '{url}' => $url,
            '{label}' => $item['label'],
            '{icon}' => $icon
        ]);
    }
    
}
