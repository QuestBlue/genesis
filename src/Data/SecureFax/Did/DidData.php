<?php

namespace QuestBlue\Genesis\Data\SecureFax\Did;

/**
 * DID Data Transfer Object
 *
 * Represents a Direct Inward Dialing (DID) number in the SecureFax system,
 * containing its unique identifier, phone number, and optional description.
 */
readonly class DidData
{
    /**
     * Create a new DID data instance.
     *
     * @param  string  $id  Unique identifier of the DID.
     * @param  string  $number  The phone number associated with the DID.
     * @param  string|null  $description  Optional description of the DID.
     */
    public function __construct(
        public string $id,
        public string $number,
        public ?string $description = null,
    ) {}

    /**
     * Create a DidData instance from an array.
     *
     * Constructs a new DidData object from an associative array
     * containing DID information.
     *
     * @param  array{
     *     id: string,
     *     number: string,
     *     description?: string|null
     * }  $data  Array containing DID data.
     *
     * @return self New DidData instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            number: $data['number'],
            description: $data['description'] ?? null,
        );
    }
}
