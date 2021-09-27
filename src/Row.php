<?php
namespace AdminLTE;

class Row{

    protected $columns = [];

    public function __construct($content = '', $width=12, $auth_node =null)
    {
        if($content != ''){
            if($content instanceof Column){
                $this->addColumn($content, null, $auth_node);
            }
            else{
                $this->addColumn(new Column($content, $width), null, $auth_node);
            }
        }
    }

    public function addColumn($column, $width = 12, $auth_node = null)
    {
        $column = filterOneItemWiAuthNode($column, $auth_node);

        if($column && $column instanceof Column){
            $this->columns[] = $column;
        }
        elseif($column){
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