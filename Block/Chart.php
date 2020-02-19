<?php

namespace JonathanMartz\WebApiStats\Block;

use JonathanMartz\WebApiStats\Model\ResourceModel\CollectionFactory;
use Magento\Backend\Block\Template;

/**
 * Class Chart
 * @package JonathanMartz\WebApiStats\Block
 */
class Chart extends Template
{
    /**
     * @var array
     */
    public $stats = [
        'standard' => []
    ];
    /**
     * @var array
     */
    public $labels = [
        'standard' => []
    ];

    /**
     * @var array
     */
    public $names = [
        'customers' => 'Customers'
    ];

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Chart constructor.
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->collectStats();
    }

    /**
     *
     */
    public function collectStats(): void
    {
        $this->loadStats('standard');
    }

    /**
     * @param string $name
     */
    public function loadStats(string $name): void
    {
        $this->loadPageStandard();
    }

    /**
     *
     */
    public function loadPageStandard()
    {
        for($i = 0; $i < 10; $i++) {
            $this->stats['standard'][] = $this->loadStatistic('customers');
            $this->labels['standard'][] = '"' . $this->convertStatisticName('customers') . '"';
        }
    }

    /**
     * @param string $name
     * @return int
     */
    public function loadStatistic(string $name)
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('url', ['eq' => $name]);
        return count($collection->getData());
    }

    /**
     * @param string $name
     * @return string
     */
    public function convertStatisticName(string $name): string
    {
        if(!empty($this->names[$name])) {
            return $this->names[$name];
        }

        return $name;
    }

    /**
     * @param int $page
     * @return string
     */
    public function getChart(string $page)
    {
        return $this->getPageStandard();
    }

    /**
     * @return string
     */
    public function getPageStandard()
    {
        return '{
            type: "bar",
            data: {
                labels: ' . $this->getLabels('standard') . ',
                datasets: [
                    {
                        label: "# of Requests",
                        data: ' . $this->getStats('standard') . ',
                        backgroundColor: ' . $this->getBackgroundColors(10) . ',
                        borderColor: ' . $this->getBorderColors(10) . ',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true
                            }
                        }
                    ]
                }
            }
        }';
    }

    /**
     * @param string $name
     * @return string
     */
    public function getLabels(
        string $name
    ): string {
        if(!empty($this->labels[$name])) {
            return '[' . implode(',', $this->labels[$name]) . ']';
        }

        return '[]';
    }

    /**
     * @param string $name
     * @return string
     */
    public function getStats(
        string $name
    ): string {
        if(!empty($this->stats[$name])) {
            return '[' . implode(',', $this->stats[$name]) . ']';
        }

        return '[]';
    }

    /**
     * @param int $count
     * @return string
     */
    public function getBackgroundColors(
        int $count
    ): string {
        $colors = [];

        for($i = 0; $i < $count; $i++) {
            $colors[] = '"' . $this->getBackgroundColor() . '"';
        }


        return '[' . implode(',', $colors) . ']';
    }

    /**
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return 'rgba(54, 162, 235, 0.5)';
    }

    /**
     * @param int $count
     * @return string
     */
    public function getBorderColors(
        int $count
    ): string {
        $colors = [];

        for($i = 0; $i < $count; $i++) {
            $colors[] = '"' . $this->getBorderColor() . '"';
        }


        return '[' . implode(',', $colors) . ']';
    }

    /**
     * @return string
     */
    public function getBorderColor(): string
    {
        return 'rgba(0,0,0,1)';
    }

}
