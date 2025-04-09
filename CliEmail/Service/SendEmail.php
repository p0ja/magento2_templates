<?php

declare(strict_types=1);

namespace M2\CliEmail\Service;

use Exception;
use M2\CliEmail\Config\Parameters;
use M2\CliEmail\Helper\Data as DataHelper;

class SendEmail
{
    /**
     * @param DataHelper $helper
     * @param TransportBuilder $transportBuilder
     * @param StateInterface $inlineTranslation
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly DataHelper $helper,
        private readonly TransportBuilder $transportBuilder,
        private readonly StateInterface $inlineTranslation,
        private readonly LoggerInterface $logger
    ) {
    }

    /**
     * @param string $name
     * @return $this
     */
    public function sendMail(string $name): static
    {
        if (!$this->helper->emailServiceEnabled()) {
            return $this;
        }

        try {
            $this->inlineTranslation->suspend();

            $transport = $this->prepareEmailTemplate($name);
            $transport->sendMessage();

            $this->inlineTranslation->resume();
        } catch (Exception $e) {
            $msg = sprintf('[%s] Error sending email: %s', __CLASS__, $e->getMessage());
            $this->logger->critical($msg);
        }

        return $this;
    }

    /**
     * @param string $name
     * @return string
     */
    private function prepareEmailTemplate(string $name): string
    {
        $vars = [
            'name' => $name,
            'message_1' => Parameters::CUSTOM_MESSAGE_1,
            'message_2' => Parameters::CUSTOM_MESSAGE_2,
            'store' => $this->helper->getStore()
        ];

        return $this->transportBuilder
            ->setTemplateIdentifier($this->getTemplate())
            ->setTemplateOptions([
                'area' => Area::AREA_FRONTEND,
                'store' => $this->helper->getStoreId()
            ])->setTemplateVars($vars)
            ->setFromByScope($this->getSender())
            ->addTo(Parameters::EMAIL_RECEIVER)
            ->addBcc(Parameters::EMAIL_RECEIVERS_BCC)
            ->getTransport();
    }
}
