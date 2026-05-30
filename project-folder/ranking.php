<?php
session_start();
require "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: First_login.php");
    exit;
}

/* Calculate average score for each teacher */
$sql = "
    SELECT 
        t.registration_no,
        t.full_name,
        AVG((e.clarity + e.interaction + e.organization) / 3) AS avg_score
    FROM teachers t
    LEFT JOIN evaluations e 
        ON t.registration_no = e.teacher_reg_no
    GROUP BY t.registration_no, t.full_name
    ORDER BY avg_score DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>-Leaderboard- Hidden side</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="ranking.css" />
    <link rel="icon" href="images/TheHiddenSide.png" />
</head>
<body>

<div class="container">
    <h2>🏆 Teacher Leaderboard 🏆</h2>

    <?php if (empty($teachers)): ?>
        <p style="text-align:center; color: #eee; font-size: 1.2rem;">No evaluations available.</p>
    <?php else: ?>

        <div class="table-container">

            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Teacher Name</th>
                        <th>Type</th>
                        <th>Average Score</th>
                    </tr>
                </thead>
            </table>

            <div class="podium">
                <?php 
                $positions = [0,1,2];
                foreach($positions as $i):
                    if(!isset($teachers[$i])) continue;
                    $t = $teachers[$i];

                    if($i==0){ 
                        $class="podium-1";
                        $medal="🥇";
                    } elseif($i==1){
                        $class="podium-2";
                        $medal="🥈";
                    } else{
                        $class="podium-3";
                        $medal="🥉";
                    }
                ?>
                    <div class="podium-card <?= $class ?>">
                        <div class="podium-rank"><?= $medal ?> <?= $i+1 ?></div>
                        <div class="podium-name">
                            <a href="teacher_dashboard.php?registration_no=<?= $t['registration_no'] ?>">
                                <?= htmlspecialchars($t['full_name']) ?>
                            </a>
                                <div style="font-size:0.9rem; opacity:0.8;">
                                    <?= $types[$t['registration_no']] ?? '' ?>
                                </div>
                        </div>
                        <div class="podium-score"><?= $t['avg_score'] !== null ? round($t['avg_score'],2) : "0" ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <table>
                <tbody>
                    <?php
                    $rank = 4;
                    for($i=3; $i<count($teachers); $i++):
                        $t = $teachers[$i];
                    ?>
                        <tr>
                            <td data-label="Rank"><?= $rank ?></td>
                            <td data-label="Teacher Name">
                                <a href="teacher_dashboard.php?registration_no=<?= $t['registration_no'] ?>">
                                    <?= htmlspecialchars($t['full_name']) ?>
                                </a>
                            </td>

                            <td data-label="Type">
                                <?= $types[$t['registration_no']] ?? '' ?>
                            </td>

                            <td data-label="Average Score"><?= $t['avg_score'] !== null ? round($t['avg_score'],2) : "0" ?></td>
                        </tr>
                    <?php
                        $rank++;
                    endfor;
                    ?>
                </tbody>
            </table>

        </div>

    <?php endif; ?>
</div>

</body>
</html>
