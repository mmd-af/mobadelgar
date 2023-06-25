<script>
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

    function moveContent(id) {
        var promo = prompt("محتوا بعد از کدام ID منتقل شود؟");
        const headersConfig = {
            entityId: id,
            positionEntityId: promo,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        };
        axios.post("{{route('admin.categories.ajax.changeCategoryPosition')}}", headersConfig)
            .then(response => {
                location.reload();
            })
            .catch(error => {
                console.log(error)
            });
    }
</script>
