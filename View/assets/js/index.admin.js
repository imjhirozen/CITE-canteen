document.querySelector('#btn-food').addEventListener('click', e => {
    location.href = '/index.php/admin?type=FOOD';
    
});

document.querySelector('#btn-drink').addEventListener('click', e => {
    location.href = '/index.php/admin?type=DRINK';
});

document.querySelector('#btn-dessert').addEventListener('click', e => {
    location.href = '/index.php/admin?type=DESSERT';
});

document.querySelector('#btn-snack').addEventListener('click', e => {
    location.href = '/index.php/admin?type=SNACK';
});

document.querySelector('#menu').addEventListener('click', e => {
    location.href = '/index.php/';
});

document.querySelector('#logout').addEventListener('click', e => {
    location.href = '/index.php/destroy';
    
});


