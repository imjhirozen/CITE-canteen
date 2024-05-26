<?php require 'View/partials/header.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<div class="d-flex flex-row align-items-center" style="min-height: 100vh">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block"><?php echo $error; ?></span>
                <div class="mb-4 lead"><?php echo $description; ?></div>
                <a href="<?php echo $redirect ?>" class="btn btn-link">Back to Home</a>
            </div>
        </div>
    </div>
</div>

<?php require 'View/partials/footer.php'; ?>