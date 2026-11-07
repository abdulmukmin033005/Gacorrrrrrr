<?php

require_once __DIR__ . '/../Model/Gacor.php';

class GacorController
{
    private Gacor $model;

    public function __construct()
    {
        $this->model = new Gacor();
    }

    public function index()
    {
        $items = $this->model->getAll();
        $title = 'PRESIDEN ORM';
        $viewMode = 'list';

        require __DIR__ . '/../View/Gacor_page.php';
    }

    public function show($id)
    {
        $item = $this->model->getById((int) $id);
        $title = 'Detail PRESIDEN ORM';
        $viewMode = 'detail';
        $message = $item ? null : 'Data tidak ditemukan.';

        require __DIR__ . '/../View/Gacor_page.php';
    }

    public function process()
    {
        $items = $this->model->getAll();
        $title = 'Hasil Proses';
        $viewMode = 'process';
        $message = 'Tidak ada request POST.';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $payload = [
                'nama' => trim($_POST['nama'] ?? ''),
                'periode' => trim($_POST['periode'] ?? ''),
                'program' => trim($_POST['program'] ?? ''),
            ];

            if (empty($payload['nama']) || empty($payload['periode'])) {
                $message = 'Nama dan periode harus diisi.';
            } else {
                $saved = $this->model->save($payload);
                $message = 'Data berhasil diproses: ' . $saved['nama'];
            }
        }

        require __DIR__ . '/../View/Gacor_page.php';
    }
}
