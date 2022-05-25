<?php
/**
 * Record repository.
 */

namespace App\Repository;

/**
 * Class RecordRepository.
 */
class EventRepository
{
    /**
     * Data.
     *
     * @var array<int, array<string, mixed>>
     */
    private array $data = [
        1 => [
            'id' => 1,
            'name' => 'Wizyta u lekarza',
            'datetime' => '2 czerwca 2022 19:00',
            'category' => 'Zdrowie',
            'tags' => [
                'Lekarz',
                'Wizyta'
            ],
        ],
        2 => [
            'id' => 2,
            'name' => 'Urodziny Ani',
            'datetime' => '19 września 21:00',
            'category' => 'Rozrywka',
            'tags' => [
                'Urodziny',
                'Znajomi'
            ],
        ],
        3 => [
            'id' => 3,
            'name' => 'Koncert Nickelback',
            'datetime' => '13 października 7:00',
            'category' => 'Zdrowie',
            'tags' => [
                'Kocham Nickelback',
                'Muzyka'
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
