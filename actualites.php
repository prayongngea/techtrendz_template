<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/article.php";
require_once __DIR__ . "/templates/header.php";

// Récupération des articles
$articles = getArticles($pdo);
?>

<h1>TechTrendz Actualités</h1>

<div class="row text-center">

<?php if (!empty($articles)): ?>
    <?php foreach ($articles as $article): ?>

        <div class="col-md-4 my-2 d-flex">
            <div class="card">

                <img 
                    src="<?= !empty($article['image']) ? '/uploads/articles/' . htmlspecialchars($article['image']) : '/assets/images/default-article.jpg' ?>" 
                    class="card-img-top" 
                    alt="<?= htmlspecialchars($article['title']) ?>"
                >

                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>
                    <a href="actualite.php?id=<?= $article['id'] ?>" class="btn btn-primary">Lire la suite</a>
                </div>

            </div>
        </div>

    <?php endforeach; ?>
<?php else: ?>

    <p>Aucun article disponible.</p>

<?php endif; ?>

</div>

<?php require_once __DIR__ . "/templates/footer.php"; ?>
