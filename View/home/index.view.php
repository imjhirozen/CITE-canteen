<?php require 'View/partials/header.php'; ?>
<link rel="stylesheet" href="../View/assets/css/general.css">
<link rel="stylesheet" href="../View/assets/css/media_query_600.css">
<link rel="stylesheet" href="../View/assets/css/media_query_900.css">
<link rel="stylesheet" href="../View/assets/css/mobile.css">

<div class="container" style="background-image: url(..\\View\\assets\\img\\menu_bg.png);">
    <!-- kani nga panel kay naa diri ang button para navigate to food, drinks, ect..  -->
    <nav>
        <button id="btn-food">FOOD</button>
        <button id="btn-drink">DRINKS</button>
        <button id="btn-dessert">DESSERT</button>
        <button id="btn-snack">SNACKS</button>
        <?php if($_SESSION['role'] == 'admin') :?>
            <button id="btn-admin">ADMIN</button>
        <?php endif?>
        <button id="btn-logout">LOG OUT</button>
    </nav>
    <!-- mao ni ang panel nga naay menu items -->
    <main>
      <!-- if mag add og lain nga item sa menu, copy lang ang div nga naay class 
      nga itemMenu
      pwede ra gamitan og JavaScript sa pag add.
      apila nalang sad ang mga class para naa na design daan-->
    </main>
    <!-- ari nga panel makita ang gi order nimo og ang total -->
    <aside>
        <!-- pwede diri ma cancel ang order  -->
        <div class="label">
            <h1>Order List</h1>
        </div>

        <div id="orderPanel" class="orderPanel">
        
        </div>

        <div class="totalPanel">
            <div id="display_total_amount" class="total" value="0">
                <h4 id="Total_amount">0</h4>
                <button id="check_out_button">Check out</button>
                
            </div>
        </div>
    </aside>

</div>

<div id="modal">
    <form id="form_container" action="/index.php/" method="POST">
        <div>
            <h1>PAYMENT</h1>
        </div>
        <input type="hidden" name="casher" value="">
        <input id="modal_receipt" type="hidden" name="receipt" value="">
        <label>
            Total : 
            <input id="modal_display_total" type="number" name="total" value="" readonly>
        </label>
        <label>
            Cash :
            <input id="modal_customer_pay" type="number" name="customer_pay" value="" required>
        </label>
        <input type="submit"><br>
        <button type="button" id="modal_cancel">Cancel</button>
    </form>
</div>

<script src="../View/assets/js/index.js"></script>
<?php require 'View/partials/footer.php'; ?>

