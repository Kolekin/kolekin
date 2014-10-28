<?php
 
Yii::import('bootstrap.widgets.TbGridView');
 
class TbGridViewPlus extends TbGridView {
 
    public $addingHeaders = array();
 
    public function renderTableHeader() {
        if (!empty($this->addingHeaders))
            $this->multiRowHeader();
 
        parent::renderTableHeader();
    }
 
    protected function multiRowHeader() {
        echo CHtml::openTag('thead') . "\n";
        foreach ($this->addingHeaders as $row) {
            $this->addHeaderRow($row);
        }
        echo CHtml::closeTag('thead') . "\n";
    }
 
    protected function addHeaderRow($row) {
        // add a single header row
        echo CHtml::openTag('tr') . "\n";
        // inherits header options from first column
        
        $fcol = 0;
		while (!isset($this->columns[$fcol])) {
			$fcol++;
		}
		$options = $this->columns[$fcol]->headerHtmlOptions;
        foreach ($row as $header => $width) {
            $options['colspan'] = $width;
            echo CHtml::openTag('th', $options);
            echo $header;
            echo CHtml::closeTag('th');
        }
        echo CHtml::closeTag('tr') . "\n";
    }
 
}
?>
