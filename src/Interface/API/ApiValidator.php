<?php

declare(strict_types=1);

namespace App\Interface\API;

use App\Error;
use App\Exception;
use App\Helpers\PathHelper;
use Fig\Http\Message\StatusCodeInterface;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class ApiValidator
{
    protected ValidatorInterface $validator;

    protected array $fields = [];
    protected Collection $constraints;

    abstract protected function getFields(ApiRequestDto $requestDto): array;

    abstract protected function getConstraints(): Collection;

    public function __construct()
    {
        $translator = new Translator('ru');
        $translator->addLoader('xlf', new XliffFileLoader());
        $translator->addResource(
            'xlf',
            PathHelper::getVendorPath() . 'symfony/validator/Resources/translations/validators.ru.xlf',
            'ru',
            'validators'
        );

        $this->validator = Validation::createValidatorBuilder()
            ->setTranslator($translator)
            ->setTranslationDomain('validators')
            ->getValidator();
    }

    public function validateDto(ApiRequestDto $requestDto): void
    {
        $this->fields = $this->getFields($requestDto);
        $this->constraints = $this->getConstraints();

        $this->violationHandler();
    }

    protected function violationHandler(): void
    {
        $violationList = $this->validator->validate($this->fields, $this->constraints);

        if (!$violationList->has(0)) {
            return;
        }

        $errors = [];

        /** @var ConstraintViolationInterface $violation */
        foreach ($violationList as $violation) {
            $errors[] = new Error(
                $violation->getMessage(),
                $violation->getPropertyPath(),
            );
        }

        $exception = new Exception('', 0, StatusCodeInterface::STATUS_BAD_REQUEST);
        $exception->addErrors($errors);

        throw $exception;
    }
}
