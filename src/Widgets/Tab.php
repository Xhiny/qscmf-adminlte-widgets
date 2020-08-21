<?php
namespace AdminLTE\Widgets;

use Illuminate\Support\Str;

class Tab{

    protected $key;
    protected $bg;
    protected $title;
    protected $tab_options;
    protected $all_header;
    protected $all_body;

    public function __construct($bg='primary', $title='')
    {
        $this->key = Str::uuid()->toString();
        self::setBg($bg);
        $title && self::setTitle($title);
    }

    public function setBg($bg){
        $this->bg = $bg;
    }

    public function setTitle($title){
        $this->title = <<<title
<li class="py-3 px-4">
<h3 class="card-title">{$title}</h3>
</li>
title;

    }

    public function addTab($header, $body, $tip = null){
        $uuid = Str::uuid()->toString();
        $this->tab_options[] = ['key' => $uuid, 'title' => $header, 'text' => $body, 'tip' => $tip];
    }

    protected function startHeader(){
        return <<<html
<div class="card-header qs-admin-lte-bg-{$this->bg} p-0 pt-1">
html;

    }

    protected function endHeader(){
        return <<<html
</div>
html;

    }

    protected function buildItemHeader($tab_key, $title, $is_active = false, $tips = null){
        $active_class = $is_active === true ? 'active show' : null;
        $is_select = $is_active === true ? 'true' : 'false';
        $tips = $tips ? $this->setTips($tips) : '';

        return <<<itemHrader
<li class="nav-item">
    <a class="nav-link {$active_class}" id="custom-tabs-{$tab_key}-tab" data-toggle="pill" href="#custom-tabs-{$tab_key}" role="tab" aria-controls="custom-tabs-{$tab_key}" aria-selected="{$is_select}">
{$title}{$tips}
</a>
</li>
itemHrader;

    }

    protected function setTips($tips){
        return <<<tips
<span><i class="fa fa-question-circle page-tooltip" data-toggle="tooltip" data-original-title="{$tips}" data-placement="right"></i></span>
tips;

    }

    protected function buildItemBody($tab_key, $text, $is_active = false){
        $active_str = $is_active === true ? 'active show' : null;

        return <<<itemBody
<div class="tab-pane fade {$active_str}" id="custom-tabs-{$tab_key}" role="tabpanel" aria-labelledby="custom-tabs-{$tab_key}-tab">
{$text}
</div>
itemBody;

    }

    protected function buildHeader(){
        $header = implode(PHP_EOL, $this->all_header);

        return <<<header
{$this->startHeader()}
<ul class="nav nav-tabs" id="custom-tabs-{$this->key}-tab" role="tablist">
    {$this->title}
    {$header}
</ul>
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

    protected function startTab(){
        return <<<html
<div class="card card-tabs">
html;

    }

    protected function endTab(){
        return <<<html
</div>
html;

    }

    protected function buildBody(){
        $body = implode(PHP_EOL, $this->all_body);
        return <<<body
{$this->startBody()}
<div class="tab-content" id="custom-tabs-{$this->key}-tabContent">
  {$body}
</div>
{$this->endBody()}
body;

    }

    protected function parseTab(){
        if (!empty($this->tab_options)){
            $this->tab_options[0]['default_active'] = true;
        }
        $this->all_header = [];
        $this->all_body = [];

        array_map(function ($option){
            $this->all_header[] = $this->buildItemHeader($option['key'], $option['title'], $option['default_active'], $option['tip']);
            $this->all_body[] = $this->buildItemBody($option['key'], $option['text'], $option['default_active']);
        }, $this->tab_options);
    }

    public function __toString(){
        $this->parseTab();

        return <<<html
{$this->startTab()}
{$this->buildHeader()}
{$this->buildBody()}
{$this->endTab()}
html;

    }
}