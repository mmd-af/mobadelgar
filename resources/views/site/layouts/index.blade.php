<!doctype html>
<html lang="fa">
@include('site.layouts.partials.header')
<!-- Google Tag Manager -->
<script>(function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start':
                new Date().getTime(), event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NC3WVC25');</script>
<!-- End Google Tag Manager -->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P4W2PW53FQ"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'G-P4W2PW53FQ');
</script>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NC3WVC25"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
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
<script src="{{ asset('build/js/site.js') }}"></script>
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
    }

    function copyToClipboard(elementId) {
        var range = document.createRange();
        range.selectNode(document.getElementById(elementId));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
        alert("متن کپی شد!");
    }
</script>
</body>
</html>
