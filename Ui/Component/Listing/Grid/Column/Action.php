<?php

namespace Bluethink\Grid\Ui\Component\Listing\Grid\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;


class Action extends Column
{
    /** Url path */
    const ROW_EDIT_URL = 'grid/grid/addrow';
    const ROW_DELETE_URL = 'grid/grid/delete';
    const ROW_VIEW_URL = 'grid/grid/save';

    /** @var UrlInterface */
    protected $_urlBuilder;

    /**
     * @var string
     */
    private $_editUrl;
    private $_deleteUrl;
    private $_viewUrl;

    /**
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     * @param string             $editUrl
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::ROW_EDIT_URL
        // $deleteUrl = self::ROW_DELETE_URL
        // $viewUrl = self::ROW_VIEW_URL
    ) {
        $this->_urlBuilder = $urlBuilder;
        $this->_editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['entity_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            $this->_editUrl,
                            ['id' => $item['entity_id']]
                        ),
                        'label' => __('Edit'),
                    ];
                }
                if (isset($item['entity_id'])) {
                    $item[$name]['delete'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            static::ROW_DELETE_URL,
                            ['id' => $item['entity_id']]
                        ),
                        'label' => __('Delete'),
                    ];
                }
                if (isset($item['entity_id'])) {
                    $item[$name]['view'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            static::ROW_VIEW_URL,
                            ['id' => $item['entity_id']]
                        ),
                        'label' => __('Add'),
                    ];
                }
            }
        }

        return $dataSource;
    }
}

