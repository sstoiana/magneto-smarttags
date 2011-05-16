<?php

/**
 * Popular tags block - popularity by number of products
 *
 * @category   Magneto
 * @package    Magneto_SmartTags
 */

class Magneto_SmartTags_Block_Popular extends Mage_Core_Block_Template
{

    protected $_tags;
    protected $_minPopularity;
    protected $_maxPopularity;

    protected function _loadTags()
    {
        if (empty($this->_tags)) {
            $this->_tags = array();

            $tags = Mage::getModel('tag/tag')->getCollection()
				->addSummary(Mage::app()->getStore()->getId())
                ->limit(20)
				->setOrder('products', 'DESC')
                ->load()
                ->getItems();

            if( count($tags) == 0 ) {
                return $this;
            }


            $this->_maxPopularity = reset($tags)->getProducts();
            $this->_minPopularity = end($tags)->getProducts();
            $range = $this->_maxPopularity - $this->_minPopularity;
            $range = ($range == 0) ? 1 : $range;
            foreach ($tags as $tag) {
                $tag->setRatio(($tag->getProducts()-$this->_minPopularity)/$range);
                $this->_tags[$tag->getName()] = $tag;
            }
            ksort($this->_tags);
        }
        return $this;
    }

    public function getTags()
    {
        $this->_loadTags();
        return $this->_tags;
    }

    public function getMaxPopularity()
    {
        return $this->_maxPopularity;
    }

    public function getMinPopularity()
    {
        return $this->_minPopularity;
    }

    protected function _toHtml()
    {
        if (count($this->getTags()) > 0) {
            return parent::_toHtml();
        }
        return '';
    }
}
