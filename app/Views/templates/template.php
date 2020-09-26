<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle; ?></title>

  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/fa/css/all.css'); ?>">
</head>

<body>

  <div class="wraper">


    <?= $this->include('templates/navigation'); ?>

    <?= $this->renderSection('main-content'); ?>

    <!-- Footer -->
    <footer class="py-5 bg-light mt-5">
      <div class="container">
        <p class="m-0 text-center text-dark">Copyright CI-4 &copy; <?= date('Y'); ?></p>
      </div>
    </footer>
  </div>


  <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <script>
    function thumbnail() {

      const image = document.querySelector('#preview_image');
      const imageLabel = document.querySelector('.form-file-text');
      const imageThumbnail = document.querySelector('.img-thumbnail');

      imageLabel.textContent = image.files[0].name;

      const imageFile = new FileReader();
      imageFile.readAsDataURL(image.files[0]);

      imageFile.onload = function(e) {
        imageThumbnail.src = e.target.result;
      }
    }
  </script>
</body>

</html>