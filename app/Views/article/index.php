<?= $this->extend('templates/template'); ?>

<?= $this->section('main-content'); ?>
<div class="container">

  <!-- page heading -->
  <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
    <h1 class="h3 mb-4"><?= $pageTitle; ?></h1>
    <a href="<?= base_url('article/newpost'); ?>" class="btn btn-primary">
      Create New Post
    </a>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <?php if (session()->getFlashdata('message')) : ?>
        <div class="alert alert-success" role="alert">
          <?= session()->getFlashdata('message'); ?>
        </div>
      <?php endif; ?>

      <!-- Tables -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Status</th>
            <th scope="col">Date Create</th>
            <th scope="col">Publish Date</th>
            <th scope="col">Last Update</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($table as $t) : ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><?= $t['title']; ?></td>
              <td><?= $t['status']; ?></td>
              <td><?= $t['date_create']; ?></td>
              <td><?= $t['publish_date']; ?></td>
              <td><?= $t['last_update']; ?></td>
              <td>
                <a href="<?= base_url('article/edit' . '/' . $t['id']); ?>" class="badge bg-primary text-decoration-none">Edit</a>
                <a href="<?= base_url('article/delete' . '/' . $t['id']); ?>" class="badge bg-secondary text-decoration-none">Delete</a>

                <?php if ($t['status'] == 0) : ?>
                  <a href="<?= base_url('article/publish' . '/' . $t['id']); ?>" class="badge bg-light text-decoration-none text-dark">Publish</a>
                <?php else : ?>
                  <a href="<?= base_url('article/unpublish' . '/' . $t['id']); ?>" class="badge bg-danger text-decoration-none">Unpublish</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>