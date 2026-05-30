<?php
session_start();
require "db.php";

// Determine teacher registration number
if (isset($_GET['registration_no'])) {
    $teacher_reg_no = $_GET['registration_no'];
} elseif (isset($_SESSION['teacher_reg_no'])) {
    $teacher_reg_no = $_SESSION['teacher_reg_no'];
} else {
    die("No teacher specified!");
}


// Fetch teacher info
$stmt = $pdo->prepare("SELECT full_name FROM teachers WHERE registration_no=?");
$stmt->execute([$teacher_reg_no]);
$teacher_name = $stmt->fetchColumn();

// تحديد نوع الحصة حسب رقم الأستاذ
$types = [
    "TCH1001" => "Cours",
    "TCH1002" => "TD",
    "TCH1003" => "TP",
    "TCH1004" => "Cours",
    "TCH1005" => "TD",
    "TCH1006" => "TP",
    "TCH1007" => "Cours",
    "TCH1008" => "TD",
    "TCH1009" => "TP",
    "TCH1010" => "Cours",
    "TCH1011" => "TD",
    "TCH1012" => "TP",
    "TCH1013" => "Cours",
    "TCH1014" => "TD",
    "TCH1015" => "Cours",
    "TCH1016" => "TD",
    "TCH1017" => "Cours"
];

$type = $types[$teacher_reg_no] ?? "";

// Fetch evaluations
$stmt = $pdo->prepare("
    SELECT * FROM evaluations 
    WHERE teacher_reg_no=?
    ORDER BY created_at DESC
");
$stmt->execute([$teacher_reg_no]);
$evaluations = $stmt->fetchAll();


// Calculate averages
$total = count($evaluations);
$sumClarity = $sumInteraction = $sumOrganization = 0;

foreach ($evaluations as $e) {
    $sumClarity += intval($e['clarity']);
    $sumInteraction += intval($e['interaction']);
    $sumOrganization += intval($e['organization']);
}

$avgClarity = $total ? round($sumClarity / $total, 2) : 0;
$avgInteraction = $total ? round($sumInteraction / $total, 2) : 0;
$avgOrganization = $total ? round($sumOrganization / $total, 2) : 0;
$overallAvg = $total ? round(($avgClarity + $avgInteraction + $avgOrganization) / 3, 2) : 0;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Teacher Results: <?= htmlspecialchars($teacher_name) ?></title>
    <link rel="icon" href="images/TheHiddenSide.png" />
    <link rel="stylesheet" href="teacher_dashboard.css"/>
</head>
<body>

<div class="container">
    <h2>Teacher Results: <?= htmlspecialchars($teacher_name) ?><?= $type ? " - " . $type : "" ?></h2>

    <?php if ($total == 0): ?>
        <p style="text-align:center; color: #eee; font-size: 1.2rem;">No evaluations available at the moment.</p>
    <?php else: ?>
        <div class="summary" aria-label="Summary of evaluations">
            <h3>Average Results</h3>
            <div class="avg-values">
                <div>
                    <div class="avg-label">Clarity</div>
                    <div class="avg-score"><?= $avgClarity ?></div>
                </div>
                <div>
                    <div class="avg-label">Interaction</div>
                    <div class="avg-score"><?= $avgInteraction ?></div>
                </div>
                <div>
                    <div class="avg-label">Organization</div>
                    <div class="avg-score"><?= $avgOrganization ?></div>
                </div>
            </div>
            <div class="overall">
                Overall Average: <?= $overallAvg ?>/5
            </div>
        </div>

        <?php foreach ($evaluations as $e): ?>
            <div class="card" tabindex="0" aria-label="Evaluation">
                <div class="ratings">
                    <div class="rating-item" title="Clarity">
                        <span class="star">⭐</span> Clarity: <?= intval($e['clarity']) ?>
                    </div>
                    <div class="rating-item" title="Interaction">
                        <span class="star">⭐</span> Interaction: <?= intval($e['interaction']) ?>
                    </div>
                    <div class="rating-item" title="Organization">
                        <span class="star">⭐</span> Organization: <?= intval($e['organization']) ?>
                    </div>
                </div>
                <div class="comment">
                    📝 <?= nl2br(htmlspecialchars($e['comment'])) ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>
