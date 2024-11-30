<?php

class Component {

  private static function getTemplateDir($path) {
    return $path . 'components/templates/';
  }

  public static function header($data = []) {
    global $dots;
    global $tpl;
    global $css;
    
    $pageTitle = $data['title'];
    $cssFile = isset($data['cssFile']) ? $data['cssFile'] : $dots . 'assets/css/backend.css';
    $bodyClass = $data['bodyClass'] ?? '';
    include_once self::getTemplateDir($dots) . "header.php";

  }

  public static function footer() {
    global $tpl;
    global $js;
    include $tpl . "footer.php";
  }

  public static function sidebar() {
    global $tpl;
    global $js;
    include $tpl . "sidebar.php";
  }

  public static function navbar() {
    global $tpl;
    global $js;
    include $tpl . "navbar.php";
  }

  public static function infoCard(array $data = []) {
    $data = (object)($data);
    $data->classess = $data->classess ?? '';
    $data->titleColor = $data->titleColor ?? $data->borderColor;
    $data->iconColor = $data->iconColor ?? 'gray-300';
    echo "
        <div class='card border-{$data->borderPosition}-{$data->borderColor} {$data->classess}'>
            <div class='card-body'>
                <div class='row no-gutters align-items-center'>
                    <div class='col mr-2'>
                        <div class='text-s font-weight-bold text-{$data->titleColor} text-uppercase mb-2'>
                        {$data->cardTitle}     
                        </div>
                        <div class='h4 mb-0 font-weight-bold text-gray-800'>{$data->mainContent}</div>
                    </div>
                    <div class='col-auto'>
                        <i class='bi bi-{$data->icon} fa-2x text-$data->iconColor'></i>
                    </div>
                </div>
            </div>
        </div>
      ";

  }
}