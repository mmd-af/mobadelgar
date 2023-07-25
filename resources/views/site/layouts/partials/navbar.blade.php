<nav class="navbar sticky-top navbar-expand-lg">
    <div class="container rounded-3 px-3 bg-white bg-opacity-50">
            <a class="navbar-title-cu mx-5" href="{{url('/')}}">
                مبدلگر
                <img class="img-fluid w-25 rounded-2" src="{{asset('logo/mobadelgarir-1.png')}}" alt="مبدل گر">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown" onclick="getCategory()">
                    <a class="nav-link dropdown-toggle active" aria-current="page" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        دسته بندی
                    </a>
                    <ul class="dropdown-menu text-center" id="insertCategory">
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ارتباط با ما</a>
                </li>
            </ul>
            <form class="d-flex px-2" role="search" onsubmit="searchCategories(event)">
                <input class="form-control me-2" type="search" placeholder="جستجو..." aria-label="جستجو..."
                       id="searchInput">
                <button class="btn btn-outline-info btn-sm text-dark" type="submit">جستجو</button>
            </form>
        </div>
    </div>
</nav>

