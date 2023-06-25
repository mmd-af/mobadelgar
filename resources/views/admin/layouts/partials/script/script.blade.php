function showConfirm() {
    event.preventDefault();
    Swal.fire({
        title: "آیا از پاک کردن این اطلاعات مطمئن هستید؟",
        text: "در صورت تایید برای همیشه پاک می شود",
        icon: "error",
        buttons: true,
        dangerMode: true,
    })
        .then(function (isOkay) {
            if (isOkay) {
                form.submit();
            }
        });
}
