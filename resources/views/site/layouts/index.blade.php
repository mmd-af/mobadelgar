<!doctype html>
<html lang="fa">
@include('site.layouts.partials.header')
<style>
    .breadcrumb {
        background-color: #f8f9fa;
        padding: 8px 16px;
        border-radius: 5px;
    }

    .breadcrumb .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
    }

    .breadcrumb .breadcrumb-item.active {
        color: #333;
    }
</style>
<body>
@include('site.layouts.partials.navbar')

<div class="container" dir="ltr">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            @yield('breadcrumb')
        </ol>
    </nav>
</div>

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
                    <div class="spinner-grow text-primary m-2 p-4" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-primary m-2 p-4" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
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
    function searchCategories(event) {
        event.preventDefault();

        axios.post("{{ route('site.categories.ajax.getAllCategories') }}")
            .then((response) => {
                let categories = response.data.data;
                searchAction(categories);
            })
            .catch((error) => {
                console.error('خطا در ارسال درخواست:', error);
            });
    }

    function searchAction(categories) {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const searchResultsContainer = document.getElementById('searchResultsContainer');
        searchResultsContainer.innerHTML = '';
        const filteredCategories = categories.filter(category => category.title.toLowerCase().includes(searchInput));
        filteredCategories.forEach(category => {

            var subText = '';
            let description = category.meta_description;
            let start = 0;
            let end = 100;
            if (description != null) {
                var subText = description.slice(start, end);
            }
            if (category.parent === null) {
                var url = "{{route('site.categories.show',['slug'=>':slug'])}}";
                url = url.replace(':slug', category.slug);
            } else {
                var url = "{{route('site.categories.child',['category'=>':category','slug'=>':slug'])}}";
                url = url.replace(':slug', category.slug);
                url = url.replace(':category', category.parent.slug);
            }

            const card = `
        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
<a href="${url}">
          <div class="form-control">
            <div class="card-body">
              <h2 class="card-title text-primary">${category.title}</h2>
<p class="btn">${subText}</p>
            </div>
          </div>
</a>
</div>
      `;
            searchResultsContainer.insertAdjacentHTML('beforeend', card);
        });

        const searchResultsModal = new bootstrap.Modal(document.getElementById('searchResultsModal'));
        searchResultsModal.show();
    }
</script>
</body>
</html>
