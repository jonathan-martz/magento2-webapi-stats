<?php

namespace JonathanMartz\WebApiStats\Block;

use JonathanMartz\WebApiStats\Model\ResourceModel\CollectionFactory;
use Magento\Backend\Block\Template;

class Chart extends Template
{

    public $stats  = [
        'standard' => []
    ];
    public $labels = [
        'standard' => []
    ];

    protected $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->collectStats();
    }


    public
    function collectStats()
    {
        $this->stats['standard'][] = 12;
        $this->labels['standard'][] = 'test';

        $collection = $this->collectionFactory->create();

        var_dump(get_class($collection));
        var_dump(count($collection->getData()));

        var_dump('test');
    }


    public
    function getLabels(
        string $name
    ): string {
        if(!empty($this->labels[$name])) {
            return '[' . implode(',', $this->labels[$name]) . ']';
        }

        return '[]';
    }

    public
    function getStats(
        string $name
    ): string {
        if(!empty($this->stats[$name])) {
            return '[' . implode(',', $this->stats[$name]) . ']';
        }

        return '[]';
    }

    public
    function getBackgroundColors(
        int $count
    ): string {
        $colors = [];

        for($i = 0; $i < $count; $i++) {
            $colors[] = '"' . $this->getBackgroundColor() . '"';
        }


        return '[' . implode(',', $colors) . ']';
    }

    public
    function getBackgroundColor(): string
    {
        return 'rgba(54, 162, 235, 0.5)';
    }

    public
    function getBorderColors(
        int $count
    ): string {
        $colors = [];

        for($i = 0; $i < $count; $i++) {
            $colors[] = '"' . $this->getBorderColor() . '"';
        }


        return '[' . implode(',', $colors) . ']';
    }

    public
    function getBorderColor(): string
    {
        return 'rgba(0,0,0,1)';
    }

}
