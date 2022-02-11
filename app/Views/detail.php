<?= $this->extend('base') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12 col-lg-8">
            <img src="/img/<?= $article['thumbnail']; ?>" alt="<?= $article['title']; ?>" class="mb-4" style="width: 100%; height: 400px;" >

            <h1><?= $article['title']; ?></h1>
            <p>
                <?= $article['content']; ?>
            </p>
        </div>
        <div class="col-sm-12 col-lg-4">
            <ul class="list-group">
                <?php foreach ($articles as $a) : ?>
                <li class="list-group-item"><a href="/<?= $a['id']; ?>"><?= $a['title']; ?></a></li>
                <?php endforeach; ?>
            </ul>
            
            <form action="/<?= $article['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger w-100 mt-5" onclick="return confirm('Are you sure to delete this data?');">Delete</button>
            </form>

            <a href="/update/<?= $article['id']; ?>" class="btn btn-warning mt-2 w-100">Update</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>