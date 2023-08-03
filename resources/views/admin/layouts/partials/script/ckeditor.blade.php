<script>
    var editor = CKEDITOR.replace('editor', {
        language: 'fa',
        uiColor: '#9AB8F3',
        height: 700,
        filebrowserBrowseUrl: '/filemanager?type=image',
        filebrowserUploadUrl: '/filemanager/upload?type=Files&_token=YOUR_CSRF_TOKEN',
        allowedContent: true
    });
    editor.on('change', function (evt) {
        callFunction(evt);
    });


    var debounceTimer;
    var counter = 0;

    function eventHandler(evt) {
        updateContentCategory()
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            counter = 0; // صفر کردن شمارنده بعد از 3 ثانیه
        }, 8000);
    }

    function callFunction(evt) {
        if (counter < 1) {
            eventHandler(evt);
            counter++;
        }
    }

</script>
