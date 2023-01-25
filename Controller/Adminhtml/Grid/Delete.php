<?php
namespace Bluethink\Grid\Controller\Adminhtml\Grid;
 
use Magento\Backend\App\Action;
 
class Delete extends Action
{
    protected $_model;
 
    /**
     * @param Action\Context $context
     * @param \Maxime\Jobs\Model\Department $model
     */
    public function __construct(
        Action\Context $context,
        \Bluethink\Grid\Model\GridFactory $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }
 
    /**
     * {@inheritdoc}
     */
    // protected function _isAllowed()
    // {
    //     return $this->_authorization->isAllowed('Bluethink_Grid::row_data_delete');
    // }
 
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParams('entity_id');
        // print_r($id);
        // die("kjsdg");
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                // die("lgzx");
                $model = $this->_model->create();
                $model->load($id['id']);

                // print_r($model->getData());
                // die("ksgd");
                $model->delete();
                $this->messageManager->addSuccess(__('Department deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                
            }
        }
        $this->messageManager->addError(__('Department does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}