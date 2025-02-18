<?php

namespace QuestBlue\Genesis\Data\SecureFax;

/**
 * Company Data Transfer Object
 *
 * Represents a company entity in the SecureFax system with its essential properties.
 * This DTO is used for transferring company data between different parts of the application.
 */
class CompanyData
{
    /**
     * Create a new company data instance
     *
     * @param string $id       Unique identifier of the company
     * @param string $name     Name of the company
     * @param string $timezone Company's operating timezone
     * @param bool   $locked   Whether the company is currently locked
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $timezone,
        public bool $locked,
    ) {}

    /**
     * Create a CompanyData instance from an array
     *
     * Constructs a new CompanyData object from an associative array
     * containing company information.
     *
     * @param array{
     *     id: string,
     *     name: string,
     *     timezone: string,
     *     locked: string|bool
     * } $data Array containing company data
     *
     * @return self New CompanyData instance
     */
    public static function fromArray(array $data): self
    {
        return new static(
            id: $data['id'],
            name: $data['name'],
            timezone: $data['timezone'],
            locked: (bool) $data['locked'],
        );
    }
}