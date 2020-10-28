<script>

    /** AKTİFLİK - PASİFLİK */
    $(".isActive").click(function () {

        var token = "{{csrf_token()}}"
        var data = $(this).prop("checked");
        var data_url = $(this).data("url");

        $.post(data_url, {
            data: data,
            _token: token
        });
    });

    /** SİLME KISMI (ARTİCLE) */
    $(".isDelete").click(function () {

        var data_url = $(this).data("url");

        Swal.fire({
            title: 'Dikkat',
            text: "Kayıt Silinecektir. Onaylıyor Musunuz ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet! Kaydı Sil',
            cancelButtonText: 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: data_url,
                    type: "DELETE",
                    data: {
                        _token: "{{csrf_token()}}"  // CSRF İÇİN BU GEREKLİ
                    },
                    success: function (response) {
                        window.location.href = "{{route('admin.article.index')}}";
                    }
                });
            }
        })
    });

    /** KALICI SİLME KISMI (ARTİCLE) */
    $(".isHardDelete").click(function () {
        var token = "{{csrf_token()}}";
        var data_url = $(this).data("url");

        $.ajax({
            type: "POST",
            url: data_url,
            data: {
                _token: token
            },
            success: function (response) {
                window.location.href = "{{route('admin.article.trashed')}}";
            }
        });

    });


    /****************************** *****************************************/

    /** SİLME KISMI (CATEGORY) */
    $(".isDeleteCategory").click(function () {
        var data_url = $(this).data("url");
        var article_count = $(this).attr("article-count");
        var alert_message = (article_count > 0) ? "(Bu kategoriye ait " + article_count + " Adet Yazı var!!!)" : '';


        Swal.fire({
            title: 'Dikkat',
            text: "Kayıt Silinecektir. Onaylıyor Musunuz ? " + alert_message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet! Kaydı Sil',
            cancelButtonText: 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: data_url,
                    type: "DELETE",
                    data: {
                        _token: "{{csrf_token()}}",  // CSRF İÇİN BU GEREKLİ
                        article_count: article_count
                    },
                    success: function (response) {
                        window.location.href = "{{route('admin.category.index')}}";
                    }
                });
            }
        })

    });

    /****************************** *****************************************/

    /** SORTABLE KISMI */
    $(".sortable").sortable();
    $(".sortable").on("sortupdate", function () {
        var data = $(this).sortable("serialize");
        var data_url = $(this).data("url");

        $.ajax({
            url: data_url,
            type : "POST",
            data: {
                _token: "{{csrf_token()}}",
                data: data
            }
        });

    });

    /** SİLME KISMI (PAGE) */
    $(".isDeletePage").click(function () {
        var data_url = $(this).data("url");

        Swal.fire({
            title: 'Dikkat',
            text: "Kayıt Silinecektir. Onaylıyor Musunuz ? ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet! Kaydı Sil',
            cancelButtonText: 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: data_url,
                    type: "DELETE",
                    data: {
                        _token: "{{csrf_token()}}",  // CSRF İÇİN BU GEREKLİ
                    },
                    success: function (response) {
                        window.location.href = "{{route('admin.page.index')}}";
                    }
                });
            }
        })

    });

    /** KALICI SİLME KISMI (HARD DELETE) */
    $(".isPageHardDelete").click(function () {
        var data_url = $(this).data("url");

        Swal.fire({
            title: 'Dikkat',
            text: "Kayıt Kalıcı Olarak Silinecektir. Onaylıyor Musunuz ? ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet! Kaydı Sil',
            cancelButtonText: 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: data_url,
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",  // CSRF İÇİN BU GEREKLİ
                    },
                    success: function (response) {
                        window.location.href = "{{route('admin.page.trashed')}}";
                    }
                });
            }
        })

    });

</script>
