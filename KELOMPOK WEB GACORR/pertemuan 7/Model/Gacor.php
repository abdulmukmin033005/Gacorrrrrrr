<?php

class Gacor
{
    private array $data = [
        [
            'id' => 1,
            'nama' => 'Adha Muddin',
            'periode' => '2044 - 2049',
            'program' => ['PRESIDEN ORM'],
        ],
    ];

    public function getAll(): array
    {
        return $this->data;
    }

    public function getById(int $id): ?array
    {
        foreach ($this->data as $item) {
            if ((int) $item['id'] === $id) {
                return $item;
            }
        }

        return null;
    }

    public function save(array $payload): array
    {
        $newItem = [
            'id' => count($this->data) + 1,
            'nama' => $payload['nama'] ?? 'Nama belum diisi',
            'periode' => $payload['periode'] ?? 'Belum ditentukan',
            'program' => !empty($payload['program']) ? explode(',', $payload['program']) : ['Belum ada program'],
        ];

        $this->data[] = $newItem;

        return $newItem;
    }
}
