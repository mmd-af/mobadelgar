<script>

    $('#create').filemanager('image');
    $('#edit').filemanager('image');
    let showAlert = document.getElementById('show_alert');
    let title = document.querySelector('#editCategoryForm #title');
    let slug = document.querySelector('#editCategoryForm #slug');
    let image = document.querySelector('#editCategoryForm #image');
    let is_active = document.querySelector('#editCategoryForm #is_active');
    let category_id = document.querySelector('#editCategoryForm #category_id');
    let parent_id = document.querySelector('#editCategoryForm #parent_id');

    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function getCategory(id) {
        showAlert.innerHTML = `<div class="text-center">
                        <div class="spinner-border text-primary my-3"></div>
                    </div>`;
        const headersConfig = {
            categoryID: id,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        };
        axios.post("{{route('admin.categories.ajax.getCategory')}}", headersConfig)
            .then(response => {
                title.value = response.data.data.title;
                slug.value = response.data.data.slug;
                image.value = response.data.data.images.url;
                if (response.data.data.is_active === "فعال") {
                    is_active.value = 1;
                } else {
                    is_active.value = 0;
                }
                category_id.value = response.data.data.id;
                showAlert.innerHTML = ``;
            }).catch(error => {
            console.error(error);
        });
    }

    function updateCategoryForm() {
        showAlert.innerHTML = `<div class="text-center">
                        <div class="spinner-border text-primary my-3"></div>
                    </div>`;
        const headersConfig = {
            categoryID: category_id.value,
            title: title.value,
            url: image.value,
            is_active: is_active.value,
            parent_id: parent_id.value,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        };
        axios.put("{{route('admin.categories.ajax.updateCategory')}}", headersConfig)
            .then(response => {
                showAlert.innerHTML = `<div class="alert alert-success">
                    <ul class="mb-0">
                        <li class="alert-text">عملیات با موفقیت انجام شد</li>
                    </ul>
                </div>`;
            })
            .catch(error => {
                showAlert.innerHTML = `<div class="alert alert-danger">
            <ul class="mb-0" id="showErrors">
                </ul>
                </div>`;
                const obj = error.response.data.errors;
                for (const key in obj) {
                    if (obj.hasOwnProperty(key)) {
                        const values = obj[key];
                        values.forEach(value =>
                            showErrors.innerHTML += `<li class="alert-text">${value}</li>`
                        );
                    }
                }
            });
    }

    $('#editParentCategory').on('hidden.bs.modal', function (e) {
        location.reload();
    });

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

    $("#czFAQ").czMore();
</script>
