<?php require 'View/partials/header.php'; ?>
<link rel="stylesheet" href="../../View/assets/css/edit.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<main>
    <div id="wrapper" class="container">
        <form id="form_edit" action="/index.php/admin/edit" method="POST" class="p-4 rounded">
            <input type="hidden" name="id" value="<?= $value['id'] ?>">
            <div class="mb-4">
                <h1 class="text-center">EDIT</h1>
            </div>
            <div class="input-group">
                <select name="type" class="form-select form-select-sm mb-3" aria-label="Selection" required>
                    <option name="type" selected disabled value="<?= $value['product_type'] ?>"><?= $value['product_type'] ?></option>
                    <option name="type" value="FOOD">FOOD</option>
                    <option name="type" value="DRINK">DRINK</option>
                    <option name="type" value="DESSERT">DESSERT</option>
                    <option name="type" value="SNACK">SNACK</option>
                </select> 
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Name</span>
                <input type="text" name="product" class="form-control" aria-label="Name" value="<?= $value['product_name'] ?>" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Price</span>
                <input type="number" name="price" class="form-control" aria-label="Price" value="<?= $value['product_price'] ?>" required>
            </div>
            <input type="submit" value="Change" class="btn btn-primary">
            <a type="button" class="btn btn-danger" href="/index.php/admin" style="width: 100%; margin-top: 5px;" >Cancel</a>
        </form>
    </div>
</main>

<?php require 'View/partials/footer.php'; ?>