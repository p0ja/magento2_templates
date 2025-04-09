<?php

declare(strict_types=1);

namespace Vendor\NewtypesGraphQl\Model\Resolver;

use DateTime;
use Exception;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Psr\Log\LoggerInterface;
use Vendor\NewtypesGraphQl\Model\Resolver\DataProvider\Newtypes as NewtypesDataProvider;

class NewtypeOutput implements ResolverInterface
{
    private const DATE_PARAM = 'date';

    /**
     * @param NewtypesDataProvider $newtypesDataProvider
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly NewtypesDataProvider $newtypesDataProvider,
        private readonly LoggerInterface $logger
    ){
    }

    /**
     * @inheritDoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array {

        $data = $this->cleanInput($args['input']);
        $this->validateInput($data);

        try {
            $result = $this->newtypesDataProvider->getData($data);
        } catch (Exception $e) {
            $this->logger->critical($e);

            throw new GraphQlInputException(
                __('An error occurred while processing your form. Please try again later.')
            );
        }

        return ['newtypes' => $result];
    }

    /**
     * @param string[] $input
     * @return string[]
     */
    public function cleanInput(array $input): array
    {
        $values = [];
        foreach ($input as $field => $value) {
            if (is_array($value)) {
                $cleanValue = $this->cleanInput($value);
            } else {
                $cleanValue = $value === null ? '' : trim($value);
            }

            $values[$field] = $cleanValue;
        }

        return $values;
    }

    /**
     * @param string[] $input
     * @return void
     * @throws GraphQlInputException
     */
    public function validateInput(array $input): void
    {
        if (!$this->isValidDate($input[self::DATE_PARAM])) {
            throw new GraphQlInputException(
                __('The Date format is invalid. Verify the Date value and try again.')
            );
        }
    }

    /**
     * @param string $value
     * @return bool
     */
    private function isValidDate(string $value): bool
    {
        if (!empty($value)) {
            try {
                new DateTime($value);

                return true;
            } catch (Exception $e) {
            }
        }

        return false;
    }
}
