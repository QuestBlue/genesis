<?php

namespace QuestBlue\Genesis\Data\SecureFax\Did;

/**
 * Class DidListData
 *
 * Represents the response structure for listing DIDs in SecureFax.
 */
readonly class DidListData
{
    /**
     * @param  DidData[]  $dids  The list of retrieved DID numbers.
     * @param  int  $total  The total count of DID numbers.
     */
    public function __construct(
        public array $dids,
        public int $total
    ) {}

    /**
     * Create a DidListData instance from an API response array.
     *
     * @param  array{
     *     data: array{
     *         dids: array<array{id: string, number: string, description?: string|null}>
     *     },
     *     meta: array{total: int}
     * }  $data  The API response array.
     *
     * @return self A new DidListData instance.
     */
    public static function fromArray(array $data): self
    {
        return new static(
            dids: array_map(static fn($did) => DidData::fromArray($did), $data['data']['dids']),
            total: $data['meta']['total']
        );
    }
}
