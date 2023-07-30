<div class="sticky-bottom">
    <input type="checkbox" id="check">
    <label class="chat-btn" for="check">
        <a class="" data-bs-toggle="offcanvas" href="#noteOffcanvas" role="button" aria-controls="offcanvasExample">
            <i class="fa-solid fa-book mt-2"></i>
        </a>
    </label>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="noteOffcanvas" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">یادداشت ها</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="note-show">
            </div>

            @yield('note-store')
        </div>
    </div>
</div>
