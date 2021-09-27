<?php


namespace AdminLTE\Widgets\UlListCard;


class UlListCard
{
    protected $key;
    protected $bg;
    protected $header;
    protected $collapse;
    protected $remove;

    protected $li_item;
    protected $all_li_body;

    protected $footer = null;
    protected $footer_extra_class = null;


    public function __construct($header, $bg = "primary", $collapse = true, $remove = true)
    {
        self::setBg($bg);

        $this->setHeader($header);
        $this->setCollapse($collapse);
        $this->setRemove($remove);
    }

    public function setHeader($header){
        $this->header = $header;
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

    public function setBg($bg){
        $this->bg = $bg;
        return $this;
    }

    public function addFooterUrl($title, $url){
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

    protected function startCard(){
        return <<<html
<div class="card">
html;

    }

    protected function endCard(){
        return <<<html
</div>
html;

    }


    protected function startHeader(){
        return <<<html
<div class="card-header qs-admin-lte-bg-{$this->bg}">
html;

    }

    protected function endHeader(){
        return <<<html
</div>
html;

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

    protected function buildHeader(){
        return <<<header
{$this->startHeader()}
<h3 class="card-title">{$this->header}</h3>
    <div class="card-tools">
      {$this->buildCollapse()}
      {$this->buildRemove()}
    </div>
{$this->endHeader()}
header;

    }

    protected function startBody(){
        return <<<html
<div class="card-body">
html;

    }

    protected function endBody(){
        return <<<html
</div>
html;

    }

    protected function buildBody(){
        $body = implode(PHP_EOL, $this->all_li_body);
        return <<<body
{$this->startBody()}
<ul class="qs-admin-lte-list-card-list list-in-card pl-2 pr-2">
  {$body}
</ul>
{$this->endBody()}
body;

    }

    public function addLiItem(LiItem $item){
        $this->li_item[] = $item;
    }

    protected function buildFooter(){
        $footer_html = <<<HTML
<div class="card-footer {$this->footer_extra_class}">
{$this->footer}
</div>
HTML;

        return $this->footer ? $footer_html : null;
    }

    protected function parseItem(){
        $this->all_li_body = [];

        array_map(function ($option){
            $this->all_li_body[] = $option->buildItemBody();
        }, $this->li_item);
    }

    public function __toString()
    {
        $this->parseItem();

        $list_html = <<<HTML
{$this->startCard()}
{$this->buildHeader()}
{$this->buildBody()}
{$this->buildFooter()}
{$this->endCard()}
HTML;

        return $list_html;
    }

}