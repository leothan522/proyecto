document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('form_importar');
    form.addEventListener('submit', function () {
        Swal.fire({
            title: '¡Subiendo Archivo!',
            didOpen: () => {
                Swal.showLoading()
            },
            allowOutsideClick: false,
            showConfirmButton: false,
        });
    });
});
