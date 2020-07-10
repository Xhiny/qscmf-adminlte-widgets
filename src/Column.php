<?php
namespace AdminLTE;

class Column{

    protected $width;

    protected $contents = [];

    public function __construct($content, $width = 12)
    {
        $this->width = $width;

        $this->append($content);
    }

    public function append($content)
    {
        $this->contents[] = $content;

        return $this;
    }

    public function __toString(){

        $all_content = implode(PHP_EOL, $this->contents);
        return <<<html
{$this->startColumn()}
{$all_content}
{$this->endColumn()}
html;
    }

    protected function startColumn()
    {
        $class_name = "col-md-{$this->width}";

        return "<div class=\"{$class_name}\">";
    }

    protected function endColumn()
    {
        return "</div>";
    }
}