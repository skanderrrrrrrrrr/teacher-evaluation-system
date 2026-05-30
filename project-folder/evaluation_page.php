<?php
session_start();
require "db.php";

$student_reg_no = $_SESSION['student_reg_no'];

// جلب الأساتذة الذين قيمهم الطالب
$stmt = $pdo->prepare("SELECT teacher_reg_no FROM evaluations WHERE student_reg_no = ?");
$stmt->execute([$student_reg_no]);
$evaluated_teachers = $stmt->fetchAll(PDO::FETCH_COLUMN);

?>

<script>
  // إرسال بيانات الأساتذة الذين قيمهم الطالب إلى جافاسكريبت
  const evaluatedTeachers = <?php echo json_encode($evaluated_teachers); ?>;
</script>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>-Evalution- Hidden Side</title>
    <link rel="icon" href="images/TheHiddenSide.png" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="evaluation.css" />
</head>


<body>

<div class="top-left-control">
    <button id="backToList" style="display:none;">&#8592;</button>
</div>

<div class="top-controls">
    <select id="languageSwitcher" onchange="changeLanguage()">
        <option value="fr">FR</option>
        <option value="en">EN</option>
        <option value="ar">AR</option>
    </select>

    <button class="theme-toggle" onclick="toggleTheme()">
        🌙
    </button>
</div>
<div class="container" id="welcomePage">
    <h1>Bienvenue sur le système d'évaluation L3 Informatique</h1>
    <p>Utilisez ce site pour évaluer vos enseignants. Votre niveau, semestre et spécialité sont déjà définis. Cliquez sur un enseignant pour commencer l'évaluation. Une fois terminé, vous ne pourrez plus réévaluer le même enseignant.</p>

    <label>Niveau :</label>
    <p class="static-info">Licence 3</p>

    <label>Semestre :</label>
    <p class="static-info">S5</p>

    <label>Spécialité :</label>
    <p class="static-info">Informatique</p>


<table class="teacher-table">
    <thead>
        <tr>
            <th>Matière</th>
            <th>Nom de l'enseignant</th>
            <th>Type de cours</th>
            
            <th>État</th>
        </tr>
    </thead>
    <tbody id="teacherList">
        <tr class="teacher-item" data-teacher="Dr. Kherici" data-teacher-reg-no="TCH1001" data-subject-id="SUB01" data-type="Cours"><td rowspan="3">Compilers</td><td>Dr. Kherici</td><td>Cours</td><td class="statusCell"></td></tr>
        <tr class="teacher-item" data-teacher="Dr. Amrane" data-teacher-reg-no="TCH1002" data-subject-id="SUB02" data-type="TD"><td>Dr. Amrane</td><td>TD</td><td class="statusCell"></td></tr>
        <tr class="teacher-item" data-teacher="Dr. Debbache" data-teacher-reg-no="TCH1003" data-subject-id="SUB03" data-type="TP"><td>Dr. Debbache</td><td>TP</td><td class="statusCell"></td></tr>        
        
        <tr class="teacher-item" data-teacher="Pr. Farah" data-teacher-reg-no="TCH1004" data-subject-id="SUB04" data-type="Cours"><td rowspan="3">Operating systems</td><td>Pr. Farah</td><td>Cours</td><td class="statusCell"></td></tr>
        <tr class="teacher-item" data-teacher="Dr. Bouhaouche" data-teacher-reg-no="TCH1005" data-subject-id="SUB05" data-type="TD"><td>Dr. Bouhaouche</td><td>TD</td><td class="statusCell"></td></tr>
        <tr class="teacher-item" data-teacher="Dr. Bouhaouche" data-teacher-reg-no="TCH1006" data-subject-id="SUB06" data-type="TP"><td>Dr. Bouhaouche</td><td>TP</td><td class="statusCell"></td></tr>        
 
        <tr class="teacher-item" data-teacher="Dr. Rouabhia" data-teacher-reg-no="TCH1007" data-subject-id="SUB07" data-type="Cours"><td rowspan="3">Human-Computer Interface</td><td>Dr. Rouabhia</td><td>Cours</td><td class="statusCell"></td></tr>
        <tr class="teacher-item" data-teacher="Dr. Rouabhia" data-teacher-reg-no="TCH1008" data-subject-id="SUB08" data-type="TD"><td>Dr. Rouabhia</td><td>TD</td><td class="statusCell"></td></tr>
        <tr class="teacher-item" data-teacher="Dr. Rouabhia" data-teacher-reg-no="TCH1009" data-subject-id="SUB09" data-type="TP"><td>Dr. Rouabhia</td><td>TP</td><td class="statusCell"></td></tr>

        <tr class="teacher-item" data-teacher="Dr. Layachi" data-teacher-reg-no="TCH1010" data-subject-id="SUB10" data-type="Cours"><td rowspan="3">Software engineering</td><td>Dr. Layachi</td><td>Cours</td><td class="statusCell"></td></tr>
        <tr class="teacher-item" data-teacher="Dr. Menghour" data-teacher-reg-no="TCH1011" data-subject-id="SUB11" data-type="TD"><td>Dr. Menghour</td><td>TD</td><td class="statusCell"></td></tr>
        <tr class="teacher-item" data-teacher="Dr. Berrezzek" data-teacher-reg-no="TCH1012" data-subject-id="SUB12" data-type="TP"><td>Dr. Berrezzek</td><td>TP</td><td class="statusCell"></td></tr>

        <tr class="teacher-item" data-teacher="Dr. Chouia" data-teacher-reg-no="TCH1013" data-subject-id="SUB13" data-type="Cours"><td rowspan="2">Probabilities and statistics</td><td>Dr. Chouia</td><td>Cours</td><td class="statusCell"></td></tr>
        <tr class="teacher-item" data-teacher="Dr. Chouia" data-teacher-reg-no="TCH1014" data-subject-id="SUB14" data-type="TD"><td>Dr. Chouia</td><td>TD</td><td class="statusCell"></td></tr>

        <tr class="teacher-item" data-teacher="Dr. Sobhi" data-teacher-reg-no="TCH1015" data-subject-id="SUB15" data-type="Cours"><td rowspan="2">Linear programming</td><td>Dr. Sobhi</td><td>Cours</td><td class="statusCell"></td></tr>
        <tr class="teacher-item" data-teacher="Dr. Hamissi" data-teacher-reg-no="TCH1016" data-subject-id="SUB16" data-type="TD"><td>Dr. Hamissi</td><td>TD</td><td class="statusCell"></td></tr>

        <tr class="teacher-item" data-teacher="Mme. Babes N" data-teacher-reg-no="TCH1017" data-subject-id="SUB17" data-type="Cours"><td>Digital economy</td><td>Mme. Babes N</td><td>Cours</td><td class="statusCell"></td></tr>

    </tbody>
</table>
</div>

<!-- صفحة التقييم -->
<div class="container" id="evaluationPage" style="display:none;">
    <h2 id="evalTeacherName"></h2>
    <p>Évaluez les critères suivants :</p>

    <div class="question" data-criterion="clarity">
        <label>Clarté des explications</label>
        <div class="stars"></div>
    </div>
    <div class="question" data-criterion="interaction">
        <label>Interaction avec les étudiants</label>
        <div class="stars"></div>
    </div>
    <div class="question" data-criterion="organization">
        <label>Organisation du cours</label>
        <div class="stars"></div>
    </div>
    <label>Commentaire (facultatif)</label>
    <textarea id="comment"></textarea>

    <button id="submitEvaluation">Envoyer l'évaluation</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    /*Dark / Light Mode*/
    function toggleTheme() {
        document.body.classList.toggle("dark");
        const btn = document.querySelector(".theme-toggle");
        btn.textContent = document.body.classList.contains("dark") ? "☀️" : "🌙";
    }

    function changeLanguage() {
    const lang = document.getElementById("languageSwitcher").value;

    const translations = {
        fr: {
            welcomeTitle: "Bienvenue sur le système d'évaluation L3 Informatique",
            welcomeText: "Utilisez ce site pour évaluer vos enseignants. Votre niveau, semestre et spécialité sont déjà définis. Cliquez sur un enseignant pour commencer l'évaluation. Une fois terminé, vous ne pourrez plus réévaluer le même enseignant.",

            level: "Niveau :",
            semester: "Semestre :",
            specialty: "Spécialité :",

            evalIntro: "Évaluez les critères suivants :",
            clarity: "Clarté des explications",
            interaction: "Interaction avec les étudiants",
            organization: "Organisation du cours",
            comment: "Commentaire (facultatif)",
            submit: "Envoyer l'évaluation"
        },
        en: {
            welcomeTitle: "Welcome to the L3 Computer Science Evaluation System",
            welcomeText: "Use this platform to evaluate your teachers. Your level, semester, and specialty are already defined. Click on a teacher to start the evaluation. Once completed, you cannot re-evaluate the same teacher.",

            level: "Level:",
            semester: "Semester:",
            specialty: "Specialty:",

            evalIntro: "Evaluate the following criteria:",
            clarity: "Clarity of explanations",
            interaction: "Interaction with students",
            organization: "Course organization",
            comment: "Comment (optional)",
            submit: "Submit evaluation"
        },
        ar: {
            welcomeTitle: "مرحبا بكم في نظام تقييم أساتذة السنة الثالثة إعلام آلي",
            welcomeText: "استخدم هذا الموقع لتقييم أساتذتك. مستواك والسداسي والتخصص محددة مسبقًا. اضغط على الأستاذ لبدء التقييم. بعد الإرسال لا يمكنك إعادة تقييم نفس الأستاذ.",

            level: "المستوى :",
            semester: "السداسي :",
            specialty: "التخصص :",

            evalIntro: "قيّم المعايير التالية:",
            clarity: "وضوح الشرح",
            interaction: "التفاعل مع الطلبة",
            organization: "تنظيم الدرس",
            comment: "تعليق (اختياري)",
            submit: "إرسال التقييم"
        }
    };

    const t = translations[lang];

    /* اتجاه الصفحة */
    document.body.dir = lang === "ar" ? "rtl" : "ltr";

    /*welcome page*/
    document.querySelector("#welcomePage h1").textContent = t.welcomeTitle;
    document.querySelector("#welcomePage p").textContent = t.welcomeText;

    const welcomeLabels = document.querySelectorAll("#welcomePage label");
    welcomeLabels[0].textContent = t.level;
    welcomeLabels[1].textContent = t.semester;
    welcomeLabels[2].textContent = t.specialty;

    /* evaluation page*/
    document.querySelector("#evaluationPage p").textContent = t.evalIntro;

    const questions = document.querySelectorAll("#evaluationPage .question label");
    questions[0].textContent = t.clarity;
    questions[1].textContent = t.interaction;
    questions[2].textContent = t.organization;

    document.querySelector("#comment").previousElementSibling.textContent = t.comment;
    document.getElementById("submitEvaluation").textContent = t.submit;
}

    const teacherItems = document.querySelectorAll(".teacher-item");
    const welcomePage = document.getElementById("welcomePage");
    const evaluationPage = document.getElementById("evaluationPage");
    const evalTeacherName = document.getElementById("evalTeacherName");
    const commentBox = document.getElementById("comment");
    let currentTeacherItem = null;

    // إنشاء النجوم في كل مجموعة تقييم
    function createStars() {
        document.querySelectorAll('.stars').forEach(starGroup => {
            starGroup.innerHTML = '';
            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('span');
                star.innerHTML = '★';
                star.classList.add('star');
                star.onclick = () => {
                    starGroup.dataset.rating = i;
                    [...starGroup.children].forEach((s, index) => {
                        s.classList.toggle('active', index < i);
                    });
                };
                starGroup.appendChild(star);
            }
            starGroup.dataset.rating = 0;
        });
    }

// ربط كل سؤال مع النجوم
document.querySelectorAll(".question .stars").forEach(sc=>createStars(sc));


const backBtn = document.getElementById("backToList");

backBtn.onclick = () => {
    evaluationPage.style.display = "none";
    welcomePage.style.display = "block";
    backBtn.style.display = "none";  // إخفاء الزر في صفحة الترحيب
};
// الضغط على أي أستاذ
teacherItems.forEach(item=>{
    item.addEventListener("click",function(){
        if(item.classList.contains("disabled")) return;
        currentTeacherItem = item;
        evalTeacherName.textContent =`Évaluation de ${item.dataset.teacher} (${item.dataset.type})`;
        welcomePage.style.display="none";
        evaluationPage.style.display="block";
        backBtn.style.display = "inline-block";  // إظهار الزر
        // إعادة ضبط النجوم والتعليق
        document.querySelectorAll(".stars").forEach(s=>s.dataset.rating=0);
        document.querySelectorAll(".stars span").forEach(s=>{
            s.classList.remove("active");
        });
        commentBox.value="";
    });
});

// إرسال التقييم
document.getElementById("submitEvaluation").onclick = function () {

    if (!currentTeacherItem) return;

    const currentTeacherRegNo = currentTeacherItem.dataset.teacherRegNo;
    const currentSubjectID = currentTeacherItem.dataset.subjectId;

    const data = {};
    const starsContainers = document.querySelectorAll(".question .stars");

    for (const sc of starsContainers) {
        if (Number(sc.dataset.rating) === 0) {
            Swal.fire("Erreur","Veuillez remplir toutes les évaluations.","error");
            return;
        }
        data[sc.parentElement.dataset.criterion] = Number(sc.dataset.rating);
    }

    fetch("save_evaluation.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            teacher_reg_no: currentTeacherRegNo,
            subjectID: currentSubjectID,
            clarity: data.clarity,
            interaction: data.interaction,
            organization: data.organization,
            comment: commentBox.value
        })
    })
    .then(res => res.json())
    .then(response => {

        if (response.status === "success") {

            currentTeacherItem.classList.add("disabled");
            currentTeacherItem.querySelector(".statusCell").textContent = "✅";

            Swal.fire("Merci!", response.message, "success").then(() => {
                evaluationPage.style.display = "none";
                welcomePage.style.display = "block";
            });

        } else {
            Swal.fire("Erreur", response.message, "error");
        }
    })
    .catch(() => {
        Swal.fire("Erreur", "Erreur serveur.", "error");
    });
};


window.addEventListener('DOMContentLoaded', () => {
  evaluatedTeachers.forEach(teacherRegNo => {
    // البحث عن عنصر الأستاذ الذي لديه data-teacher-reg-no يساوي teacherRegNo
    const teacherItem = document.querySelector(`.teacher-item[data-teacher-reg-no="${teacherRegNo}"]`);
    if (teacherItem) {
      teacherItem.classList.add('disabled');
      const statusCell = teacherItem.querySelector('.statusCell');
      if (statusCell) {
        statusCell.textContent = "✅";
      }
    }
  });
});

</script>

</body>
</html>
