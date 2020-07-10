<?php
namespace AdminLTE;

class Row{

    protected $columns = [];

    public function __construct($content = '', $width=12)
    {
        if($content != ''){
            $this->addColumn(new Column($content, $width));
        }
    }

    public function addColumn($column, $width = 12)
    {
        if($column instanceof Column){
            $this->columns[] = $column;
        }
        else{
            $this->columns[] = new Column($column, $width);
        }
        return $this;
    }

    protected function startRow(){
        return "<div class='row'>";
    }

    protected function endRow(){
        return '</div>';
    }

    public function __toString()
    {
        $all_columns = implode(PHP_EOL, $this->columns);
        return <<<html
{$this->startRow()}
{$all_columns}
{$this->endRow()}
html;
    }
}