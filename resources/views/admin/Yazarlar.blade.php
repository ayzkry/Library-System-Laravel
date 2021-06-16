@extends("layouts.admin")
@section("title")
    Yazar Form
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
            <th>Yazar No</th>
            <th>Yazar Adı</th>
            <th>Yazar Soyadı</th>
            <th>İşlem</th>

        </tr>

        </thead>

        <div>
            <a href="/admin/yazarekle" type="button" class="btn btn-primary float-end">Yazar Ekle</a>
        </div>

        <tbody>
        @foreach($yazarlar as $key => $item)
            <tr id="yazar{{$item->Yazar_no}}">
                <td>{{$item->Yazar_no}}</td>

                <td>{{$item->Yazar_adi}}</td>
                <td>{{$item->Yazar_soyadi}}</td>
                <td>
                    <button data-id="{{$item->Yazar_no}}" type="button" class="btn btn-danger deleteYazar">Sil</button>
                    <button data-id="{{$item->Yazar_no}}" type="button" class="btn btn-warning yazarGuncelle"
                            data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Güncelle
                    </button>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yazar Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Yazar Adı:</label>
                                <input type="text" class="form-control" id="yazaradi">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Yazar Soyadı:</label>
                                <input type="text" class="form-control" id="yazarsoyadi">
                            </div>
                            <input id="yazarno" type="hidden" name="">

                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary yazarguncellepost">Güncelle</button>
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
        })
        $(".deleteYazar").click(function () {
            const id = $(this).data("id")
            if (confirm("Silmek İstediğinize Emin misiniz ?")) {
                axios.delete(`/admin/yazarsil/${id}`).then(res => {
                    location.href = "/admin/yazarlistesi"

                })
            }
        });
        $(".yazarGuncelle").click(function () {
            console.log("calisti")
            const yazar_no = $(this).data("id")
            $("#yazarno").val(yazar_no)
            axios.get(`/admin/yazarguncelle/${yazar_no}`).then(response => {
                $(".yazarguncelle").attr("data-bs-dismiss", "modal")
                let result = response.data
                $("#yazaradi").val(result.Yazar_adi);
                $("#yazarsoyadi").val(result.Yazar_soyadi);
            })
        })
        $(".yazarguncellepost").click(function () {
            let yazar_no = $("#yazarno").val();
            axios.put(`/admin/yazarguncelle/${yazar_no}`, {
                yazarad: $("#yazaradi").val(),
                yazarsoyad: $("#yazarsoyadi").val(),
            }).then(res => {
                setTimeout(() => {
                    location.href = "/admin/yazarlistesi"
                }, 1000)
                Swal.fire(
                    'Başarılı',
                    'Güncellendi ',
                    'success'
                )
            })
        })


    </script>
@endsection
