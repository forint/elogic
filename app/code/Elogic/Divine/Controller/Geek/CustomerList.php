<?php
/**
 * Created by PhpStorm.
 * User: forint
 * Date: 4/8/19
 * Time: 9:28 PM
 */
namespace Elogic\Divine\Controller\Geek;

use Magento\Framework\App\Action\Context;

class CustomerList extends \Magento\Framework\App\Action\Action
{
    protected $filterBuilder;

    protected $customerRepository;

    protected $searchCriteriaBuilder;

    /**
     * CustomerList constructor.
     * @param Context $context
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     * @param \Magento\Framework\Api\Search\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\Framework\Api\FilterBuilder $filterBuilder
     */
    public function __construct(
        Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\Api\Search\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->customerRepository = $customerRepository;
        $this->filterBuilder = $filterBuilder;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($query = $this->getRequest()->getParam('q')) {
            $this->searchCriteriaBuilder->addFilter(
                $this->filterBuilder
                    ->setField('firstname')
                    ->setValue('%'.$query.'%')
                    ->setConditionType('like')
                    ->create()
            );
        }
        $this->searchCriteriaBuilder->addSortOrder('firstname', 'ASC');
        $this->searchCriteriaBuilder->setPageSize(10);
        $this->searchCriteriaBuilder->setCurrentPage(1);

        $customers = $this->customerRepository->getList($this->searchCriteriaBuilder->create())->getItems();
        $data = [];

        foreach ($customers as $customer) {
            if ($addresses = $customer->getAddresses()) {
                /** @var \Magento\Customer\Model\Data\Address $address */
                foreach ($addresses as $address) {

                }
            }
        }

        $data[] = [
            'id' => $customer->getId(),
            'firstName' => $customer->getFirstname(),
            'lastName' => $customer->getLastname(),
            'email' => $customer->getEmail(),
        ];

        /** @var \Magento\Framework\Controller\Result\Json $result */
        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);

        return $result->setData([
            'customers' => $data,
            'error' => false
         ]);
    }
}