function verCargando() {
    Swal.fire({
        toast: true,
        title: 'Cargando...',
        didOpen: () => {
            Swal.showLoading()
        },
        allowOutsideClick: false,
        showConfirmButton: false,
    });
    //window.location.href = url;
}
