<?php
namespace AdminLTE\Widgets;

class InfoBox{

    protected $icon;
    protected $text;
    protected $amount;
    protected $bg;
    protected $tips;

    public function __construct($text, $amount, $bg = '', $icon = [])
    {
        $this->text = $text;
        $this->amount = $amount;

        if($bg){
          $this->setBg($bg);
        }

        if(!empty($icon) && is_array($icon)){
          $this->setIcon($icon['icon'], $icon['bg']);
        }
    }

    public function setTips($tips){
        $tips_html = <<<tips
<i class="fa fa-question-circle page-tooltip" data-toggle="tooltip" data-original-title="{$tips}" data-placement="right"></i>
tips;
        $this->tips = $tips_html;
        return $this;
    }

    public function setIcon($icon, $bg = ''){
        $bg_class = $bg ? 'bg-' . $bg : '';

        $this->icon = <<<icon
<span class="info-box-icon {$bg_class}"><i class="fa fa-lg fa-{$icon}"></i></span>
icon;
        return $this;
    }

    public function setBg($bg){
        $this->bg = ' bg-' . $bg;

        return $this;
    }

    public function __toString(){

        return <<<html
<div class="info-box{$this->bg}">
  {$this->icon}
  <div class="info-box-content">
    <span class="info-box-text">{$this->text}{$this->tips}</span>
    <span class="info-box-number">
      {$this->amount}
    </span>
  </div>
</div>
html;
    }
}