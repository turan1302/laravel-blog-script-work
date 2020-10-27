<script>

    /** AKTİFLİK - PASİFLİK */
    $(".isActive").click(function (){

        var token = "{{csrf_token()}}"
        var data = $(this).prop("checked");
        var data_url = $(this).data("url");

        $.post(data_url,{
            data : data,
            _token : token
        });
    });

    /** SİLME KISMI */
    $(".isDelete").click(function (){

        var data_url = $(this).data("url");

        Swal.fire({
            title: 'Dikkat',
            text: "Kayıt Silinecektir. Onaylıyor Musunuz ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet! Kaydı Sil',
            cancelButtonText : 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : data_url,
                    type : "DELETE",
                    data : {
                        _token : "{{csrf_token()}}"  // CSRF İÇİN BU GEREKLİ
                    },
                    success : function (response){
                        window.location.href="{{route('admin.article.index')}}";
                    }
                });
            }
        })
    });

    /** KALICI SİLME KISMI */
    $(".isHardDelete").click(function (){
        var token = "{{csrf_token()}}";
        var data_url = $(this).data("url");

        $.ajax({
            type : "POST",
            url : data_url,
            data : {
                _token : token
            },
            success : function (response){
                window.location.href="{{route('admin.article.trashed')}}";
            }
        });

    });

</script>
