<?= $this->extend('base') ?>

<?= $this->section('content') ?>

<?php if (!empty(session()->getFlashdata('message'))) : ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> <?= session()->getFlashdata('message'); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<div class="row">
  <?php foreach ($articles as $article) : ?>
    <div class="col-sm-12 col-md-6 col-lg-3">
        <div class="card">
          <img src="/img/<?= $article['thumbnail']; ?>" class="card-img-top" alt="<?= $article['title']; ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $article['title']; ?></h5>
            <p class="card-text"><?= ellipsize($article['content'], 100); ?></p>
            <a href="/<?= $article['id']; ?>" class="btn btn-primary">View Article</a>
          </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?= $pager->links(); ?>

<?= $this->endSection() ?>
