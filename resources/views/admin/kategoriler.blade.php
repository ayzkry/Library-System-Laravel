@extends("layouts.admin")
@section("title")
    Kategori Form
@endsection

@section("css")
    <style>
        #success_message{ display: none;}
    </style>
@endsection

@section("content")
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Kategori No</th>
            <th>Kategori Adı</th>
            <th>İşlem</th>

        </tr>

        </thead>

        <tbody>
        <div>
            <a href="/admin/kategoriekle" type="button" class="btn btn-primary float-end">Kategori Ekle</a>
        </div>


        <tbody>
        @foreach($kategoriler as $key => $item)
        <tr id="kategori{{$item->Kategori_no}}">
            <td>{{$item->Kategori_no}}</td>

            <td>{{$item->Kategori_adi}}</td>
            <td>
                <button data-id="{{$item->Kategori_no}}" type="button" class="btn btn-danger deleteKategori">Sil</button>
                <button data-id="{{$item->Kategori_no}}" type="button" class="btn btn-warning kategoriGuncelle" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Güncelle</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Kategori Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Kategori Adı:</label>
                                <input type="text" class="form-control" id="kategoriadi">
                                <inpu id="kategorino" type="hidden" name="">

                            </div>

                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary kategoriguncellepost">Güncelle</button>
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
        $(".deleteKategori").click(function () {
            const id = $(this).data("id")
            console.log(id)
            if (confirm("Silmek İstediğinize Emin misinz ?")) {
                axios.delete(`/admin/kategorisil/${id}`).then(res => {
                    location.href = "/admin/kategorilistesi"
                })
            } else {

            }


        })

        $(".kategoriGuncelle").click(function () {
            const Kategori_no = $(this).data("id")
            $("#kategorino").val(Kategori_no)
            axios.get(`/admin/kategoriguncelle/${Kategori_no}`).then(response => {
                $(".kategoriguncelle").attr("data-bs-dismiss","modal")
                let result = response.data
                $("#kategoriadi").val(result.Kategori_adi);
            })
        })
        $(".kategoriguncellepost").click(function () {
            let Kategori_no = $("#kategorino").val()
            axios.put(`/admin/kategoriguncelle/${Kategori_no}`,{
                kategoriadi: $("#kategoriadi").val(),
            }).then(res => {
                setTimeout(() => {
                    location.href = "/admin/kategorilistesi"
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
