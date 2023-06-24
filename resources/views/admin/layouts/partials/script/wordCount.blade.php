<script>
    document
        .querySelector("#word")
        .addEventListener("input", function countWord() {
            let res = [];
            let str = this.value.replace(/[\t\n\r\.\?\!]/gm, " ").split(" ");
            str.map((s) => {
                let trimStr = s.trim();
                if (trimStr.length > 0) {
                    res.push(trimStr);
                }
            });
            document.querySelector("#show").innerText = res.length;
        });

    $('textarea').keyup(function () {

        var characterCount = $(this).val().length,
            current = $('#current'),
            maximum = $('#maximum'),
            theCount = $('#the-count');

        current.text(characterCount);


        /*This isn't entirely necessary, just playin around*/
        if (characterCount < 40) {
            current.css('color', '#666');
        }
        if (characterCount > 40 && characterCount < 60) {
            current.css('color', '#6d5555');
        }
        if (characterCount > 60 && characterCount < 80) {
            current.css('color', '#793535');
        }
        if (characterCount > 80 && characterCount < 110) {
            current.css('color', '#841c1c');
        }
        if (characterCount > 110 && characterCount < 125) {
            current.css('color', '#8f0001');
        }

        if (characterCount >= 125) {
            maximum.css('color', '#8f0001');
            current.css('color', '#8f0001');
            theCount.css('font-weight', 'bold');
        } else {
            maximum.css('color', '#666');
            theCount.css('font-weight', 'normal');
        }
    });
</script>
