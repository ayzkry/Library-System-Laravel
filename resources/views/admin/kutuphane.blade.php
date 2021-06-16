@extends("layouts.admin")
@section("title")
    Kütüphane Form
@endsection

@section("css")
    <style>
        #success_message {
            display: none;
        }
    </style>
@endsection

@section("content")
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Kütüphane No</th>
            <th>Kütüphane İsmi</th>
            <th>Acıklama</th>
            <th>İşlem</th>
        </tr>

        </thead>


        <tbody>
        <div>
            <a href="/admin/kutuphanekle" type="button" class="btn btn-primary float-end">Kütüphane Ekle</a>
        </div>
            @foreach($kutuphane as $key => $item)
                <tr id="kutuphane{{$item->kutuphane_no}}">
                    <td>{{$item->kutuphane_no}}</td>
                    <td>{{$item->kutuphane_ismi}}</td>
                    <td>{{$item->aciklama}}</td>

                    <td>
                        <button data-id="{{$item->kutuphane_no}}" type="button" class="btn btn-danger deleteKutuphane">Sil</button>
                       <button data-id="{{$item->kutuphane_no}}" type="button" class="btn btn-warning kutuphaneGuncelle" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Güncelle</button>                    </td>


                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kütüphane Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="row">
                        <div class="col-md-6">
                            <input id="kutuphaneno" type="hidden" name="">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Kütüphane Adı:</label>
                                <input type="text" class="form-control" id="kutuphaneismi">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Açıklama:</label>
                                <input type="text" class="form-control" id="aciklama">
                            </div>


                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary kutuphaneguncellepost">Güncelle</button>
            </div>
        </div>
    </div>
</div>

@section("js")
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".deleteKutuphane").click(function () {
        const id = $(this).data("id")
        if (confirm("Silmek İstediğinize Emin misiniz ?")) {
            axios.delete(`/admin/kutuphanesil/${id}`).then(res => {
                location.href = "/admin/kutuphanelistesi"
            })
        } else {

        }


    })
    $(".kutuphaneGuncelle").click(function () {
        const kutuphane_no = $(this).data("id")
        $("#kutuphaneno").val(kutuphane_no)
        axios.get(`/admin/kutuphaneguncelle/${kutuphane_no}`).then(response => {
            $(".kutuphaneguncelle").attr("data-bs-dismiss","modal")
            let result = response.data
            $("#kutuphaneismi").val(result.kutuphane_ismi);
            $("#aciklama").val(result.aciklama);
        })
    })
    $(".kutuphaneguncellepost").click(function () {
        let kutuphane_no = $("#kutuphaneno").val()
        axios.put(`/admin/kutuphaneguncelle/${kutuphane_no}`,{
            kutuphaneismi: $("#kutuphaneismi").val(),
            aciklama: $("#aciklama").val(),
        }).then(res => {
            setTimeout(() => {
                location.href = "/admin/kutuphanelistesi"
            },1000)
            Swal.fire(
                'Başarılı',
                'Güncellendi ',
                'success'
            )
        })
    })



    </script>
@endsection
