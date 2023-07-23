<!doctype html>
<html lang="en">
@include('site.layouts.partials.header')
<body>
@include('site.layouts.partials.navbar')
@yield('content')
<div class="modal" id="searchResultsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">نتایج جستجو</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="searchResultsContainer">
                    <!-- اینجا نتایج جستجو نمایش داده می‌شود -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
@include('site.layouts.partials.footer')
@yield('script')

<script>

    function getCategory() {
        let insertCategory = document.getElementById('insertCategory');
        insertCategory.innerHTML = `<div class="spinner-grow text-primary m-2 p-4" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-primary m-2 p-4" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>`;
        const headersConfig = {
            parent_id: 0,
        };
        axios.post("{{ route('site.categories.ajax.getCategories') }}", headersConfig)
            .then((response) => {
                insertCategory.innerHTML = ``;
                response.data.data.forEach((item) => {
                    let url = "{{route('site.categories.show',':slug')}}";
                    url = url.replace(':slug', item.slug);
                    insertCategory.innerHTML += `<li><a class="dropdown-item" href="${url}">${item.title}</a></li>`;
                })
            })
            .catch((error) => {
                console.error('خطا در ارسال درخواست:', error);
            });
    }

</script>
<script>
    const categories = [
        { id: 1, name: 'دسته بندی 1' },
        { id: 2, name: 'دسته بندی 2' },
        { id: 3, name: 'دسته بندی 3' },
        // و غیره...
    ];
    function searchCategories(event) {
        event.preventDefault();




        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const searchResultsContainer = document.getElementById('searchResultsContainer');

        // خالی کردن محتوای کارت‌های نتایج جستجو
        searchResultsContainer.innerHTML = '';

        // جستجو در دسته‌بندی‌ها
        const filteredCategories = categories.filter(category => category.name.toLowerCase().includes(searchInput));

        // نمایش نتایج جستجو با استفاده از کارت‌ها
        filteredCategories.forEach(category => {
            const card = `
        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">${category.name}</h5>
              <p class="card-text">شناسه: ${category.id}</p>
            </div>
          </div>
        </div>
      `;
            searchResultsContainer.insertAdjacentHTML('beforeend', card);
        });

        // نمایش مدال با نتایج جستجو
        const searchResultsModal = new bootstrap.Modal(document.getElementById('searchResultsModal'));
        searchResultsModal.show();
    }
</script>
</body>
</html>
