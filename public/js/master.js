var route = document.getElementsByName('routeName')[0].getAttribute('content');
document.addEventListener('DOMContentLoaded', function () {
    //MODULO ACTIVO
    route_active = document.getElementsByClassName('lko-'+route)[0].classList.add('menu-open');
    route_active = document.getElementsByClassName('lkm-'+route)[0].classList.add('active');
    route_active = document.getElementsByClassName('lk-'+route)[0].classList.add('active');
});
