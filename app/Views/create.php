<?= $this->extend('base') ?>

<?= $this->section('content') ?>

<form action="/create/save" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>

    <div class="row mt-5">
        <div class="col-12 col-lg-7">
            <div class="mb-3">
                <label for="article-content" class="form-label">Content</label>
                <textarea name="content" class="form-control <?= ($validation->hasError('content')) ? 'is-invalid' : ''; ?>" id="article-content" rows="10"> <?= old('content'); ?> </textarea>
                <div class="invalid-feedback">
                    <?= $validation->getError('content'); ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" id="title" value="<?= old('title'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('title'); ?>
                </div>
            </div>
            <div class="mb-3">    
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <input class="form-control <?= ($validation->hasError('thumbnail')) ? 'is-invalid' : ''; ?>" type="file" name="thumbnail" id="thumbnail" onchange="getImagePreview()">
                <div class="invalid-feedback">
                    <?= $validation->getError('thumbnail'); ?>
                </div>

                <img src="/img/default.jpeg" alt="default" class="mt-3 img-preview" style="width: 100px; height: auto;">
            </div>
        </div>
    </div>
    <button class="btn btn-success">Create Article</button>
</form>
<?= $this->endSection() ?>