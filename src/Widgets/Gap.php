<?php
namespace AdminLTE\Widgets;

class Gap{

    protected $height = 0;

    public function __construct(int $height)
    {
        $this->setHeight($height);
    }

    public function setHeight(int $height){
        $this->height = $height;
        return $this;
    }

    public function __toString()
    {
        return <<<result
<div class="gap" style="height: {$this->height}px">
</div>
result;
    }
}