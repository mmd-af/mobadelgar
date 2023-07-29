<div class="offcanvas  offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">منو</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-group list-group-flush" style="font-size: 18px; font-weight: bold">
            <li class="list-group-item"><a class="text-decoration-none" href="{{route('admin.dashboard.index')}}"><i class="fa fa-home"></i> داشبورد </a></li>
            <li class="list-group-item"><a class="text-decoration-none" href="{{route('site.home.index')}}" target="_blank"><i class="fa-brands fa-cc-mastercard"></i> نمایش سایت </a></li>
            <li class="list-group-item"><a class="text-decoration-none" href="{{route('admin.categories.index')}}"><i class="fa-solid fa-diagram-project"></i> دسته بندی ها </a></li>
        </ul>
    </div>
</div>
