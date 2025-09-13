<?php

declare(strict_types=1);

namespace App\Interface\API;

use LogicException;

abstract class ApiRequestDto
{
    protected array $fields = [];

    abstract protected function setDefaultFields(): void;

    public function __construct(array $params)
    {
        $this->setDefaultFields();

        foreach ($params as $key => $value) {
            if (!array_key_exists($key, $this->fields)) {
                throw new LogicException("Field '{$key}' does not exist in class " . get_class($this));
            }

            $this->fields[$key] = $value;
        }
    }

    public function getByKey(string $key): mixed
    {
        if (!array_key_exists($key, $this->fields)) {
            throw new LogicException("Field '{$key}' does not exist in class " . get_class($this));
        }

        return $this->fields[$key];
    }

    public function getParamsByFields(array $fields): array
    {
        $params = [];

        foreach ($fields as $field) {
            $params[$field] = $this->getByKey($field);
        }

        return $params;
    }
}
