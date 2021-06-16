@extends("layouts.admin")
@section("title")
    Kitap Form
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
            <th>ISBN</th>
            <th>Kitap Adı</th>
            <th>Yayın Tarihi</th>
            <th>Sayfa Sayısı</th>
            <th>Kategori Adı</th>
            <th>Yazar </th>
            <th>Kütüphane Adı</th>
            <th>İşlem</th>

        </tr>

        </thead>

        <tbody>

        <div>
            <a href="/admin/kitapekle" type="button" class="btn btn-primary float-end">Kitap Ekle</a>
        </div>


        <tbody>
        @foreach($kitap as $key => $item)
        <tr id="kitap{{$item->ISBN}}">
            <td>{{$item->ISBN}}</td>
            <td>{{$item->kitap_adi}}</td>
            <td>{{ \Carbon\Carbon::parse($item->Yayın_tarihi)->format('d-m-Y') }}</td>
            <td>{{$item->S_sayisi}}</td>
            <td>{{$item->Kategori_adi}}</td>
            <td>{{$item->Yazar_adi}} {{$item->Yazar_soyadi}}</td>
            <td>{{$item->kutuphane_ismi}}</td>
            <td>
                <button data-id="{{$item->ISBN}}" type="button" class="btn btn-danger deleteKitap">Sil</button>
                <button data-id="{{$item->ISBN}}" type="button" class="btn btn-warning kitapguncelleme" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Güncelle</button>
            </td>

        </tr>
        @endforeach

        </tbody>
    </table>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kitap Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="mb-3">
                                    <label for="kitapadi" class="col-form-label">Kitap Adi</label>
                                    <input type="text" class="form-control kitapadi" id="kitapadi">
                                </div>

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Kategori Adı:</label>
                                    <select  class="form-select kategoriler" aria-label="Default select example">
                                        <option value=""></option>
                                        @foreach($kategori as $item)
                                            <option value="{{$item->Kategori_no}}">{{$item->Kategori_adi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input id="isbnos" type="hidden" name="">
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Yazar Adı:</label>
                                    <select  class="form-select yazarlar" aria-label="Default select example">
                                        <option value=""></option>
                                        @foreach($yazar as $item)
                                            <option value="{{$item->Yazar_no}}">{{$item->Yazar_adi}} {{$item->Yazar_soyadi}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Kütüphane Adı:</label>
                                    <select class="form-select kutuphane" aria-label="Default select example">
                                        <option value=""></option>
                                        @foreach($kutuphane as $item)
                                            <option value="{{$item->kutuphane_no}}">{{$item->kutuphane_ismi}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Sayfa Sayısı:</label>
                                    <input type="number" class="form-control sayfasayisi" id="sayfasayisi">
                                </div>

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 col-form-label">Yayın Tarihi</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="date"  id="yayintarihi" name="yayintarihi">
                                    </div>
                                </div>


                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary kitapguncellepost">Güncelle</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section("js")

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".deleteKitap").click(function () {
            const id = $(this).data("id")
            console.log(id)
            if (confirm("Silmek İstediğinize Emin misiniz ?")) {
                axios.delete(`/admin/kitapsil/${id}`).then(res => {
                    location.href = "/admin/kitaplistesi"
                })
            } else {

            }


        })

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }

        $(".kitapguncelleme").click(function () {
            let kitapno = $(this).data("id");
            $("#isbnos").val(kitapno)
            axios.get("/admin/kitapguncelle/" +kitapno).then(res => {
                let kitapget = res.data
                $(".kitapguncellepost").attr("data-bs-dismiss","modal")

                $( ".kategoriler option:selected" ).text(kitapget.Kategori_adi);
                $( ".kategoriler option:selected" ).val(kitapget.Kategori_no);
                $( ".yazarlar option:selected" ).text(kitapget.Yazar_adi + ' ' + kitapget.Yazar_soyadi);
                $( ".yazarlar option:selected" ).val(kitapget.Yazar_no);
                $( ".kutuphane option:selected" ).text(kitapget.kutuphane_ismi);
                $( ".kutuphane option:selected" ).val(kitapget.kutuphane_no);
                $( ".kutuphane option:selected" ).val(kitapget.kutuphane_no);
                $( ".sayfasayisi" ).val(kitapget.S_sayisi);
                $( ".kitapadi" ).val(kitapget.kitap_adi);
                $( "#yayintarihi" ).val(formatDate(kitapget.Yayın_tarihi));

            })
        })



        $(".kitapguncellepost").click(function () {
           let kitapno = $("#isbnos").val();

            axios.put(`/admin/kitapguncelle/${kitapno}`,{
                kitapadi: $("#kitapadi").val(),
                yayintarihi: $("#yayintarihi").val(),
                sayfasayisi: $("#sayfasayisi").val(),
                kategorino: $(".kategoriler").val(),
                yazarno: $(".yazarlar").val(),
                kutuphaneno: $(".kutuphane").val(),

            }).then(res => {
                setTimeout(() => {
                    location.href = "/admin/kitaplistesi"
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
