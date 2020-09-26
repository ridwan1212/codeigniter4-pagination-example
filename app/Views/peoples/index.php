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
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 + (6 * ($currentPage - 1)); ?>
          <?php foreach ($table as $t) : ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><?= $t['name']; ?></td>
              <td><?= $t['address']; ?></td>
              <td><?= $t['created_at']; ?></td>
              <td><?= $t['updated_at']; ?></td>
              <td>
                <a href="<?= base_url('peoples/edit' . '/' . $t['id']); ?>" class="badge bg-primary text-decoration-none">Edit</a>
                <a href="<?= base_url('peoples/delete' . '/' . $t['id']); ?>" class="badge bg-secondary text-decoration-none">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?= $pager->links('peoples', 'peoples_pagination'); ?>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>