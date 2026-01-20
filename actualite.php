<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/article.php";
require_once __DIR__ . "/templates/header.php";

// Vérifier si un ID est passé en URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Récupérer l'article
$article = getArticleById($pdo, $id);

// Si aucun article trouvé → message d’erreur
if (!$article) {
    echo "<h1>Article introuvable</h1>";
    require_once __DIR__ . "/templates/footer.php";
    exit;
}
?>

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">

    <div class="col-10 col-sm-8 col-lg-6">
        <img 
            src="<?= !empty($article['image']) ? '/uploads/articles/' . htmlspecialchars($article['image']) : '/assets/images/default-article.jpg' ?>" 
            class="d-block mx-lg-auto img-fluid" 
            alt="<?= htmlspecialchars($article['title']) ?>" 
            width="700" 
            height="500" 
            loading="lazy"
        >
    </div>

    <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">
            <?= htmlspecialchars($article['title']) ?>
        </h1>

        <p class="lead">
            <?= nl2br(htmlspecialchars($article['content'])) ?>
        </p>
    </div></div>

<?php require_once __DIR__ . "/templates/footer.php"; ?>
