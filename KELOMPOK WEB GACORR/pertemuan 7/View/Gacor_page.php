<?php
$items = $items ?? [];
$item = $item ?? null;
$title = $title ?? 'PresidenKu';
$message = $message ?? null;
$viewMode = $viewMode ?? 'list';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef2f4;
            color: #1f2d3d;
        }
        .main-wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 26px 18px;
        }
        .theme-box {
            background: #dfe8ec;
            border: 3px solid #2b4d6b;
            border-radius: 0;
            padding: 0;
            overflow: hidden;
        }
        .topbar {
            height: 18px;
            background: #dfe8ec;
            border-bottom: 3px solid #2b4d6b;
        }
        .content {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 22px;
            padding: 26px 20px 30px;
        }
        .panel {
            background: #edf6f7;
            border-radius: 16px;
            border: 1px solid #d0e5eb;
            padding: 18px 20px;
        }
        .panel h3 {
            margin: 0 0 16px;
            font-size: 18px;
            color: #1d4d66;
        }
        .model-box, .controller-box, .view-box {
            background: #e9f7f5;
            border: 1px solid #cfe6e0;
            border-radius: 12px;
            padding: 10px 14px;
            margin-bottom: 12px;
        }
        .model-box { background: #dff3ef; }
        .controller-box { background: #e9eef8; border-color: #d4dff0; }
        .view-box { background: #fff4dc; border-color: #f1dfab; }
        .label {
            display: block;
            font-weight: 700;
            color: #1f2d3d;
            margin-bottom: 6px;
            font-size: 14px;
        }
        .method-name {
            display: block;
            font-weight: 700;
            margin-top: 2px;
        }
        .nav {
            display: flex;
            gap: 10px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }
        .nav a {
            display: inline-block;
            background: #2d5878;
            color: white;
            text-decoration: none;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
        }
        .profile-card {
            background: #d7eef7;
            border: 1px solid #c1dfe9;
            border-radius: 16px;
            padding: 18px 18px 14px;
            margin-top: 10px;
            text-align: center;
        }
        .avatar {
            width: 78px;
            height: 78px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2db39f, #1f7ea2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            font-weight: bold;
            margin: 0 auto 10px;
        }
        .profile-card h2 {
            margin: 8px 0 2px;
            font-size: 32px;
            color: #1f2d3d;
        }
        .profile-card .periode {
            color: #3f6b7c;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .profile-card ul {
            margin: 10px auto 0;
            padding-left: 20px;
            width: fit-content;
            text-align: left;
        }
        .profile-card li {
            margin-bottom: 4px;
        }
        .task-box {
            background: #f5f5f5;
            border: 1px solid #dfe3e7;
            border-radius: 16px;
            padding: 14px 18px 18px;
        }
        .task-box h3 {
            margin-top: 0;
            font-size: 18px;
            color: #1d4d66;
        }
        .task-box p {
            margin: 0 0 12px;
            line-height: 1.5;
        }
        .checklist {
            margin: 10px 0 0;
            padding-left: 18px;
            line-height: 1.8;
        }
        form {
            margin-top: 18px;
        }
        label {
            display: block;
            font-weight: 700;
            margin-top: 10px;
            margin-bottom: 6px;
        }
        input, textarea {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #c8d6de;
            background: white;
            font-size: 14px;
        }
        button {
            background: #2d5878;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            margin-top: 10px;
            font-weight: 700;
            cursor: pointer;
        }
        .message {
            background: #eaf8f1;
            border: 1px solid #bfe6d0;
            color: #205f44;
            padding: 10px 12px;
            border-radius: 8px;
            margin: 12px 0;
            font-weight: 600;
        }
        .link-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 18px;
        }
        .link-list a {
            color: #29607d;
            font-weight: 700;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="main-wrap">
        <div class="theme-box">
            <div class="topbar"></div>
            <div class="content">
                <section class="panel">
                    <div class="nav">
                        <a href="index.php?action=index">Home</a>
                        <a href="index.php?action=show&id=1">Profil</a>
                        <a href="index.php?action=process">Process</a>
                    </div>

                    <div class="model-box">
                        <span class="label">MODEL</span>
                        <strong>PresidenKu</strong>
                    </div>

                    <div class="controller-box">
                        <span class="label">CONTROLLER</span>
                        <span class="method-name">index()</span>
                        <span class="method-name">show()</span>
                        <span class="method-name">process()</span>
                    </div>

                    <div class="view-box">
                        <span class="label">VIEW</span>
                        <strong>PresidenKu Page</strong>
                    </div>

                    <?php if ($viewMode === 'list' && !empty($items)): ?>
                        <div class="task-box">
                            <h3>Daftar Data</h3>
                            <ul class="checklist">
                                <?php foreach ($items as $itemList): ?>
                                    <li>
                                        <strong><?= htmlspecialchars($itemList['nama']) ?></strong>
                                        - <?= htmlspecialchars($itemList['periode']) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php elseif ($viewMode === 'detail' && $item): ?>
                        <div class="profile-card">
                            <div class="avatar"><?= htmlspecialchars(substr($item['nama'], 0, 1)) ?></div>
                            <h2><?= htmlspecialchars($item['nama']) ?></h2>
                            <div class="periode"><?= htmlspecialchars($item['periode']) ?></div>
                            <strong>Program:</strong>
                            <ul>
                                <?php foreach ($item['program'] as $program): ?>
                                    <li><?= htmlspecialchars($program) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php elseif ($viewMode === 'process'): ?>
                        <?php if ($message): ?>
                            <div class="message"><?= htmlspecialchars($message) ?></div>
                        <?php endif; ?>

                        <form method="POST" action="index.php?action=process">
                            <label>Nama</label>
                            <input type="text" name="nama" placeholder="Masukkan nama">

                            <label>Periode</label>
                            <input type="text" name="periode" placeholder="Contoh: 2044 - 2049">

                            <label>Program</label>
                            <textarea name="program" rows="4" placeholder="Pisahkan dengan koma, contoh: Pendidikan, Kesehatan"></textarea>

                            <button type="submit">Simpan</button>
                        </form>
                    <?php else: ?>
                        <div class="profile-card">
                            <div class="avatar"><?= htmlspecialchars(substr($items[0]['nama'], 0, 1)) ?></div>
                            <h2><?= htmlspecialchars($items[0]['nama']) ?></h2>
                            <div class="periode"><?= htmlspecialchars($items[0]['periode']) ?></div>
                            <strong>Program:</strong>
                            <ul>
                                <?php foreach ($items[0]['program'] as $program): ?>
                                    <li><?= htmlspecialchars($program) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="link-list">
                            <?php foreach ($items as $row): ?>
                                <a href="index.php?action=show&id=<?= urlencode((string) $row['id']) ?>"><?= htmlspecialchars($row['nama']) ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </section>

                <aside class="task-box">
                    <h3>Task</h3>
                    <p><strong>Hubungkan Model, Controller, dan View sehingga data PresidenKu dapat ditampilkan melalui MVC.</strong></p>

                    <h3>Contoh Data</h3>
                    <div class="profile-card" style="background:#ebf6ef; border-color:#cae5d7; margin-top: 10px;">
                        <div class="avatar">E</div>
                        <h2>Eko Felix</h2>
                        <div class="periode">2044 - 2049</div>
                        <strong>Program:</strong>
                        <ul>
                            <li>Pendidikan</li>
                            <li>Kesehatan</li>
                            <li>Infrastruktur</li>
                        </ul>
                    </div>

                    <h3>Checklist</h3>
                    <ul class="checklist">
                        <li>Data berasal dari Model</li>
                        <li>Controller memproses data</li>
                        <li>Data dikirim ke View</li>
                        <li>View menampilkan data</li>
                        <li>Tidak ada error</li>
                    </ul>
                </aside>
            </div>
        </div>
    </div>
</body>
</html>
