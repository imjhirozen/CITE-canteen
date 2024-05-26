<?php require 'View/partials/header.php'; ?>
<link rel="stylesheet" href="../View/assets/css/admin_style.css.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <header>
        <div id="img_container">
        <img src="../View/assets/img/cite_logo.png" alt="CITE LOGO" id="fit_cover">
        </div>
        <h1>CITE'S CANTEEN</h1>
    </header>

    <div id="container">

        <!-- Button trigger modal -->
        

        <aside>
            <h1>PRODUCTS</h1>
            <button data-bs-toggle="modal" data-bs-target="#add_product">ADD</button>
            <button id="menu">MENU</button>
            <button id="logout">Logout</button>
        </aside>

        <main>

            <nav>
                <button id="btn-food">FOOD</button>
                <button id="btn-drink">DRINKS</button>
                <button id="btn-dessert">DESSERT</button>
                <button id="btn-snack">SNACKS</button>
            </nav>

            <div id="list_container">
                <table border="1" class="table table-bordered">
                    <thead>
                        <th>type</th>
                        <th>name</th>
                        <th>price</th>
                        <th>UPDATE</th>
                        <th>REMOVE</th>
                    </thead>
                    <?php foreach($items as $item) : ?>
                    <tr>
                        <td><?= $item['product_type'] ?></td>
                        <td><?= $item['product_name'] ?></td>
                        <td><?= $item['product_price'] ?></td>
                        <td>
                            <a href="/index.php/admin/edit?id=<?= $item['id'] ?>">EDIT</a>
                        </td>
                        <td>
                            <form action="/index.php/admin" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <button type="submit">DELETE</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>

        </main>

        <!-- Modal -->
        <div class="modal fade" id="add_product" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">ADD PRODUCT</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row d-flex justify-content-center" action="/index.php/admin" method="POST" enctype="multipart/form-data">
                        <label class="mb-2">
                            PRODUCT NAME :
                            <input type="text" name="product_name" style="width: 150px;" required>
                        </label>
                        <label class="mb-2">
                            PRODUCT PRICE :
                            <input type="number" name="product_price" style="width: 150px;" required>
                        </label>
                        <label>
                        <select name="type" class="form-select form-select-sm mb-3" aria-label="Selection" style="width: 250px;" required>
                            <option selected disabled value="">TYPE</option>
                            <option name="type" value="FOOD">FOOD</option>
                            <option name="type" value="DRINK">DRINK</option>
                            <option name="type" value="DESSERT">DESSERT</option>
                            <option name="type" value="SNACK">SNACK</option>
                        </select> 
                        </label>
                        <label>
                            IMAGE :
                            <input type="file" name="image" required>
                        </label>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

    </div>

<script src="../View/assets/js/index.admin.js"></script>
<?php require 'View/partials/footer.php'; ?>