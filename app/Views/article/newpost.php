<?= $this->extend('templates/template'); ?>

<?= $this->section('main-content'); ?>

<div class="container">

  <!-- page heading -->
  <div class="d-sm-flex align-item-center justify-content-between mt-3 mb-4">
    <h1 class="h3 mb-4"><?= $pageTitle; ?></h1>
  </div>

  <div class="row">
    <div class="col-xl-12 mb-3">

      <!-- form -->

      <form action="/article/create" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="form-group my-3">
          <label for="author">Author</label>
          <input type="text" class="form-control <?= ($validation->hasError('author')) ? 'is-invalid' : ''; ?>" name="author" value="<?= old('author'); ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('author'); ?>
          </div>
        </div>
        <div class="form-group my-3">
          <label for="title">Title</label>
          <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" name="title" value="<?= old('title'); ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('title'); ?>
          </div>
        </div>
        <div class="form-group my-3">
          <label for="description">Description</label>
          <input type="text" class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : ''; ?>" name="description" value="<?= old('description'); ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('description'); ?>
          </div>
        </div>
        <div class="form-group my-3">
          <label for="date_create"></label>
          <input type="hidden" class="form-control" name="date_create" value="<?= date('D, d M Y H:i:s'); ?>">
        </div>

        <div class="row">
          <div class="col-md-2">
            <img src="/assets/img/default.png" alt="Thumbnail" class="img-thumbnail">
          </div>
          <div class="col-md-10 my-auto">
            <div class="form-file">
              <input type="file" class="form-file-input <?= ($validation->hasError('preview_image')) ? 'is-invalid' : ''; ?>" id="preview_image" name="preview_image" onchange="thumbnail()">
              <div class="invalid-feedback">
                <?= $validation->getError('preview_image'); ?>
              </div>
              <label class="form-file-label" for="preview_image">
                <span class="form-file-text">Choose Image...</span>
                <span class="form-file-button">Browse</span>
              </label>
            </div>
          </div>
        </div>

        <div class="form-group my-3">
          <label for="content">Content</label>
          <textarea type="text" class="form-control <?= ($validation->hasError('content')) ? 'is-invalid' : ''; ?>" name="content" rows="7"><?= old('content'); ?></textarea>
          <div class="invalid-feedback">
            <?= $validation->getError('content'); ?>
          </div>
        </div>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= base_url('article'); ?>'">Back</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>