<?php

namespace M2\CliEmail\Helper;

use M2\CliEmail\Config\Parameters;
use Magento\Framework\App\Area;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class Data extends AbstractHelper
{
    /**
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        protected Context $context,
        private readonly StoreManagerInterface $storeManager,
    ) {
    }

    /**
     * @return bool
     */
    public function emailServiceEnabled(): bool
    {
        return (bool)$this->scopeConfig->getValue(
            Parameters::EMAIL_SERVICE_ENABLE,
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );

    }

    /**
     * @return StoreInterface
     */
    public function getStore(): StoreInterface
    {
        return $this->storeManager->getStore();
    }

    /**
     * @return int
     */
    public function getStoreId(): int
    {
        return (int)$this->getStore()->getId();
    }

    /**
     * @return string
     */
    private function getTemplate(): string
    {
        return (string)$this->scopeConfig->getValue(
            Parameters::EMAIL_TEMPLATE,
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
    }

    /**
     * @return string
     */
    private function getSender(): string
    {
        return (string)$this->scopeConfig->getValue(
            Parameters::EMAIL_SENDER,
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
    }
}

