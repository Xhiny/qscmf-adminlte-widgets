<?php
namespace AdminLTE\Widgets;

class Card{

    protected $title;
    protected $bg;
    protected $collapse;
    protected $remove;
    protected $body;

    protected $footer = null;
    protected $footer_extra_class = null;

    public function __construct($body = '', $title = '', $bg = 'info', $collapse = true, $remove = true)
    {
        $this->setBody($body);
        $this->setTitle($title);
        $this->setBg($bg);
        $this->setCollapse($collapse);
        $this->setRemove($remove);
    }

    public function setBody($body){
        $this->body = $body;
        return $this;
    }

    public function setCollapse($collapse){
        $this->collapse = $collapse;
        return $this;
    }

    public function setRemove($remove){
        $this->remove = $remove;
        return $this;
    }

    protected function buildCollapse(){
        if($this->collapse){
            return <<<html
<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
html;
        }
        else{
            return '';
        }
    }

    protected function buildRemove(){
        if($this->remove){
            return <<<html
<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
html;
        }
        else{
            return '';
        }
    }

    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function setBg($theme){
        $this->bg = $theme;
        return $this;
    }

    public function addFooterMore($url, $title = "查看更多"){
        $footer_url = <<<HTML
<a href="{$url}" class="uppercase">{$title}</a>
HTML;

        $this->setFooter($footer_url);
        $this->setFooterExtraClass($this->footer_extra_class." text-center");

        return $this;
    }

    public function setFooter($footer){
        $this->footer = $footer;
        return $this;
    }

    public function setFooterExtraClass($footer_extra_class){
        $this->footer_extra_class = $footer_extra_class;
        return $this;
    }

    protected function buildFooter(){
        $footer_html = <<<HTML
<div class="card-footer {$this->footer_extra_class}">
{$this->footer}
</div>
HTML;

        return $this->footer ? $footer_html : null;
    }

    public function __toString()
    {
        return <<<result
<div class="card">
  <div class="card-header qs-admin-lte-bg-{$this->bg}">
    <h3 class="card-title">{$this->title}</h3>
    <div class="card-tools">
      {$this->buildCollapse()}
      {$this->buildRemove()}
    </div>
  </div>
  <div class="card-body">
    {$this->body}
  </div>
    {$this->buildFooter()}
</div>
result;
    }
}