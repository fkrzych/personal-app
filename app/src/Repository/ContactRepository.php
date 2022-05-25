<?php
/**
 * Record repository.
 */

namespace App\Repository;

/**
 * Class RecordRepository.
 */
class ContactRepository
{
    /**
     * Data.
     *
     * @var array<int, array<string, mixed>>
     */
    private array $data = [
        1 => [
            'id' => 1,
            'name' => 'Mama',
            'phone' => '123456789',
            'tags' => [
                'Rodzina',
                'Rodzice'
            ],
        ],
        2 => [
            'id' => 2,
            'name' => 'Tato',
            'phone' => '987654321',
            'tags' => [
                'Rodzina',
                'Rodzice'
            ],
        ],
        3 => [
            'id' => 3,
            'name' => 'Siostra',
            'phone' => '345126987',
            'tags' => [
                'Rodzina',
                'Rodzeństwo'
            ],
        ],
    ];

    /**
     * Find all.
     *
     * @return array[] Result
     *
     * @psalm-return array<int, array<string, mixed>>
     */
    public function findAll(): array
    {
        return $this->data;
    }

    /**
     * Find one by Id.
     *
     * @param int $id Id
     *
     * @return array<string, mixed>|null Result
     */
    public function findOneById(int $id): ?array
    {
        return count($this->data) && isset($this->data[$id])
            ? $this->data[$id]
            : null;
    }
}
