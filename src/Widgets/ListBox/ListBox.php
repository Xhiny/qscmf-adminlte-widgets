<?php


namespace AdminLTE\Widgets\ListBox;


class ListBox
{
    protected $list_item;
    protected $list_html;

    public function addListItem(ListItem $item){
        $this->list_item[] = $item;
    }

    protected function parseItem(){
        $this->list_html = [];

        array_map(function ($option){
            $this->list_html[] = $option->buildItemHtml();
        }, $this->list_item);
    }

    public function __toString()
    {
        $this->parseItem();

        $body = implode(PHP_EOL, $this->list_html);
        return <<<body
<ul class="qs-admin-lte-list-card-list list-in-card pl-2 pr-2">
  {$body}
</ul>
body;
    }

}