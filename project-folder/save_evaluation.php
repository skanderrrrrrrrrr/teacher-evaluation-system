<?php
session_start();
require "db.php";

header("Content-Type: application/json");

// التحقق من تسجيل الدخول
if (!isset($_SESSION['student_reg_no'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Session expirée."
    ]);
    exit;
}

// قراءة JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid data."
    ]);
    exit;
}

// التحقق من الحقول
$required_fields = [
    'teacher_reg_no',
    'subjectID',
    'clarity',
    'interaction',
    'organization'
];

foreach ($required_fields as $field) {
    if (!isset($data[$field])) {
        echo json_encode([
            "status" => "error",
            "message" => "Missing field: $field"
        ]);
        exit;
    }
}

$student_reg_no = $_SESSION['student_reg_no'];
$teacher_reg_no = $data['teacher_reg_no'];
$subjectID = $data['subjectID'];

try {

    // ✅ التحقق هل التقييم موجود مسبقًا
    $check = $pdo->prepare("
        SELECT id FROM evaluations
        WHERE student_reg_no = ?
        AND teacher_reg_no = ?
        AND subjectID = ?
    ");

    $check->execute([
        $student_reg_no,
        $teacher_reg_no,
        $subjectID
    ]);

    if ($check->fetch()) {
        echo json_encode([
            "status" => "error",
            "message" => "Vous avez déjà évalué cet enseignant pour cette matière."
        ]);
        exit;
    }

    // ✅ إدخال التقييم
    $sql = "
        INSERT INTO evaluations
        (student_reg_no, teacher_reg_no, subjectID, clarity, interaction, organization, comment)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $student_reg_no,
        $teacher_reg_no,
        $subjectID,
        $data['clarity'],
        $data['interaction'],
        $data['organization'],
        $data['comment'] ?? null
    ]);

    echo json_encode([
        "status" => "success",
        "message" => "Évaluation enregistrée avec succès."
    ]);

} catch (PDOException $e) {

    echo json_encode([
        "status" => "error",
        "message" => "Erreur serveur."
    ]);
}
?>
