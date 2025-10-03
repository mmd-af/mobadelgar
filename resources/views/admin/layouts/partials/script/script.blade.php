<script>

    $('#create').filemanager('image');
    $('#edit').filemanager('image');
    let showAlert = document.getElementById('show_alert');
    let category_title = document.querySelector('#editCategoryForm #title');
    let category_slug = document.querySelector('#editCategoryForm #slug');
    let category_image = document.querySelector('#editCategoryForm #image');
    let category_is_active = document.querySelector('#editCategoryForm #is_active');
    let category_id = document.querySelector('#editCategoryForm #category_id');
    let category_parent_id = document.querySelector('#editCategoryForm #parent_id');
    let noteShow = document.getElementById('note-show');
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let post_title = document.querySelector('#editPostForm #title');
    let post_slug = document.querySelector('#editPostForm #slug');
    let post_image = document.querySelector('#editPostForm #image');
    let post_is_active = document.querySelector('#editPostForm #is_active');
    let post_id = document.querySelector('#editPostForm #post_id');

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
                category_title.value = response.data.data.title;
                category_slug.value = response.data.data.slug;
                category_image.value = response.data.data.images.url;
                category_parent_id.value = response.data.data.parent_id;
                if (response.data.data.is_active === "فعال") {
                    category_is_active.value = 1;
                } else {
                    category_is_active.value = 0;
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
            title: category_title.value,
            url: category_image.value,
            is_active: category_is_active.value,
            parent_id: category_parent_id.value,
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

    function getPost(id) {
        showAlert.innerHTML = `<div class="text-center">
                        <div class="spinner-border text-primary my-3"></div>
                    </div>`;
        const headersConfig = {
            postID: id,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        };
        axios.post("{{route('admin.posts.ajax.getPost')}}", headersConfig)
            .then(response => {
                post_title.value = response.data.data.title;
                post_slug.value = response.data.data.slug;
                post_image.value = response.data.data.images.url;
                if (response.data.data.is_active === "فعال") {
                    post_is_active.value = 1;
                } else {
                    post_is_active.value = 0;
                }
                post_id.value = response.data.data.id;
                showAlert.innerHTML = ``;
            }).catch(error => {
            console.error(error);
        });
    }

    function updatePostForm() {
        showAlert.innerHTML = `<div class="text-center">
                        <div class="spinner-border text-primary my-3"></div>
                    </div>`;
        const headersConfig = {
            postID: post_id.value,
            title: post_title.value,
            url: post_image.value,
            is_active: post_is_active.value,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        };
        axios.put("{{route('admin.posts.ajax.updatePost')}}", headersConfig)
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

    $('#editParentPost').on('hidden.bs.modal', function (e) {
        location.reload();
    });

    function showConfirm(event) {
        event.preventDefault();
        const form = event.target;
        Swal.fire({
            title: 'آیا از پاک کردن این اطلاعات مطمئن هستید؟',
            text: 'در صورت تایید برای همیشه پاک می شود',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'تایید',
            cancelButtonText: 'کنسل'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else if (result.dismiss === Swal.DismissReason.cancel) {

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

    function storeCategoryFaq() {
        var showFaqAlert = document.getElementById('showFaqAlert');
        var faq_question = document.querySelectorAll('input[name="faq_question[]"]');
        var faq_answer = document.querySelectorAll('input[name="faq_answer[]"]');
        var faq_questions = Array.from(faq_question).map(function (input) {
            return input.value;
        });
        var faq_answers = Array.from(faq_answer).map(function (input) {
            return input.value;
        });
        showFaqAlert.innerHTML = `<div class="text-center">
                        <div class="spinner-border text-primary my-3"></div>
                    </div>`;
        const headersConfig = {
            categoryID: "{{$category->id ?? 0}}",
            faq_questions: faq_questions,
            faq_answers: faq_answers,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        };
        axios.post("{{route('admin.categories.ajax.storeFaqCategory')}}", headersConfig)
            .then(response => {
                showFaqAlert.innerHTML = `<div class="alert alert-success">
                    <ul class="mb-0">
                        <li class="alert-text">اطلاعات ذخیره شد...</li>
                    </ul>
                </div>`;
                // setTimeout(removeDivContent, 5000);
            })
            .catch(error => {
                showFaqAlert.innerHTML = `<div class="alert alert-danger">
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
                // setTimeout(removeDivContent, 5000);
            });
    }

    function storePostFaq() {
        var showFaqAlert = document.getElementById('showFaqAlert');
        var faq_question = document.querySelectorAll('input[name="faq_question[]"]');
        var faq_answer = document.querySelectorAll('input[name="faq_answer[]"]');
        var faq_questions = Array.from(faq_question).map(function (input) {
            return input.value;
        });
        var faq_answers = Array.from(faq_answer).map(function (input) {
            return input.value;
        });
        showFaqAlert.innerHTML = `<div class="text-center">
                        <div class="spinner-border text-primary my-3"></div>
                    </div>`;
        const headersConfig = {
            postID: "{{$post->id ?? 0}}",
            faq_questions: faq_questions,
            faq_answers: faq_answers,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        };
        axios.post("{{route('admin.posts.ajax.storeFaqPost')}}", headersConfig)
            .then(response => {
                showFaqAlert.innerHTML = `<div class="alert alert-success">
                    <ul class="mb-0">
                        <li class="alert-text">اطلاعات ذخیره شد...</li>
                    </ul>
                </div>`;
                // setTimeout(removeDivContent, 5000);
            })
            .catch(error => {
                showFaqAlert.innerHTML = `<div class="alert alert-danger">
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
                // setTimeout(removeDivContent, 5000);
            });
    }

    function deleteFaq(id) {
        const headersConfig = {
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        };
        axios.delete("{{route('admin.faqs.ajax.destroy', ['faq' => ':id']) }}".replace(':id', id), headersConfig)
            .then(response => {
                let faqDestroy = document.getElementById(`faq-destroy-${response.data.data}`);
                faqDestroy.remove();
            }).catch(error => {
            console.log(error)
        });
    }

    $("#czFAQ").czMore();

</script>
