<?php


namespace AdminLTE\Widgets\ListBox;


class ListItem
{
    public $title;
    public $title_extra_class;
    public $title_color;
    public $column = [];
    public $right_tag = [];
    public $url = null;

    public function setTitle($title, $title_color = null){
        $this->title = $title;
        $this->setTitleColor($title_color);
        return $this;
    }

    protected function setTitleColor($title_color){
        $this->title_color = $title_color;
        return $this;
    }

    public function setUrl($url){
        $this->url = $url;
        return $this;
    }

    public function addRightTag($value, $bg = "primary"){
        $this->right_tag[] = ['value' => $value, 'bg' => $bg];
        return $this;
    }

    public function addColumn($value){
        $this->column[] = ["value" => $value, "color" => null];
        return $this;
    }

    protected function setTitleExtraClass($title_extra_class){
        $this->title_extra_class = $title_extra_class;
        return $this;
    }

    protected function getAUrl(){
        if (!$this->url){
            $this->setTitleExtraClass($this->title_extra_class." qs-admin-lte-no-point");
            $a_url = "javascript:void(0)";
        }else{
            $a_url = $this->url;
        }

        return $a_url;
    }

    protected function buildColumnHtml(){
        $summary_arr = collect($this->column)->map(function ($ent) {
            $value = $ent['value'];
            $color_class = $ent['color'] ? 'qs-admin-lte-text-'.$ent['color'] : null;
            return <<<HTML
<span class="{$color_class} description" title="{$value}">
        {$value}
</span>
HTML;
        })->all();

        return implode(" ", $summary_arr);
    }

    protected function buildRightTagHtml(){
        $right_tag_arr = collect($this->right_tag)->map(function ($ent){
            $value = $ent['value'];
            $bg = $ent['bg'];

            return <<<HTML
            <span class="badge badge-{$bg} float-right ml-2">{$value}</span>
HTML;
        })->all();

        return implode(" ", $right_tag_arr);
    }

    public function buildItemHtml(){
        $title_color = $this->title_color ? 'qs-admin-lte-text-'.$this->title_color : null;

        return <<<itemBody
 <li class="item">
    <div class="info">
        <a href="{$this->getAUrl()}" class="title {$title_color} {$this->title_extra_class}" title="{$this->title}">{$this->title}
            {$this->buildRightTagHtml()}
        </a>
        {$this->buildColumnHtml()}        
    </div>
 </li>
itemBody;

    }

}