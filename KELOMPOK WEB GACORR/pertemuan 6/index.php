<?php

class BarterinProfile
{
    public string $name;
    public string $period;
    public array $programs;

    public function __construct(string $name, string $period, array $programs)
    {
        $this->name = $name;
        $this->period = $period;
        $this->programs = $programs;
    }

    public function getProfile(): string
    {
        return $this->name . " " . $this->period;
    }

    public function getPrograms(): array
    {
        return $this->programs;
    }
}

$profile = new BarterinProfile(
    "Adha Muddin",
    "2026 - 2027",
    [
        ["icon" => "📦", "label" => "Tukar Barang"],
        ["icon" => "🤝", "label" => "Barter"],
        ["icon" => "🏬", "label" => "Marketplace"]
    ]
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Barterin</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="page">
        <header class="topbar">
            <div class="brand">Barterin</div>
            <nav class="nav" aria-label="Navigasi utama">
                <span>Beranda</span>
                <span>Program</span>
                <span>Profil</span>
            </nav>
            <div class="menu">☰</div>
        </header>

        <section class="hero">
            <div class="cloud one"></div>
            <div class="cloud two"></div>

            <div class="hero-card">
                <div class="figure">
                    <div class="hair"></div>
                    <div class="head"></div>
                    <div class="body"></div>
                    <div class="tie"></div>
                </div>

                <div class="flag"></div>
                <div class="gov-building"></div>
            </div>

            <div class="name-box">
                <h1><?= htmlspecialchars($profile->name); ?></h1>
                <div class="period"><?= htmlspecialchars($profile->period); ?></div>
            </div>
        </section>

        <section class="programs">
            <h2>Program Utama</h2>
            <div class="program-grid">
                <?php foreach ($profile->getPrograms() as $program): ?>
                    <div class="program-item">
                        <div class="icon-wrap"><?= htmlspecialchars($program["icon"]); ?></div>
                        <span><?= htmlspecialchars($program["label"]); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</body>
</html>

