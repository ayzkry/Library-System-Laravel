@extends("layouts.admin")
@section("title")
    Emanet Form
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
            <th>Emanet No</th>
            <th>Kitap Adı</th>
            <th>Üye Adı</th>
            <th>Kütüphane Adı</th>
            <th>Emanet Tarihi</th>
            <th>Teslim Tarihi</th>
            <th>İşlem</th>
        </tr>

        </thead>

        <div>
            <a href="{{route("emaneteklegoster")}}" type="button" class="btn btn-primary float-end">Emanet Ekle</a>
        </div>
        <tbody>
        @foreach($emanet as $key => $item)
            <tr id="uye{{$item->Emanet_no}}">
                <td>{{$item->Emanet_no}}</td>
                <td>{{$item->kitap_adi}}</td>
                <td>{{$item->Uye_adi}} {{$item->Uye_soyadi}}</td>
                <td>{{$item->kutuphane_ismi}}</td>
                <td>{{ \Carbon\Carbon::parse($item->emanet_tarihi)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->teslim_tarihi)->format('d-m-Y') }}</td>

                <td>
                    <button data-id="{{$item->Emanet_no}}" type="button" class="btn btn-danger deleteEmanet">Sil</button>
                    <button  data-id="{{$item->Emanet_no}}" type="button" class="btn btn-warning emanetGuncelleGetir" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Güncelle</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Emanet Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>

                        <div class="row">
                            <div class="col-md-12">
                                <input id="emanetno" type="hidden" name="">
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Kitap Adı:</label>
                                    <select id="kitapadi" class="form-select" aria-label="Default select example">
                                        <option value=""></option>
                                        @foreach($kitap as $item)
                                        <option value="{{$item->ISBN}}">{{$item->kitap_adi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input id="emanetno" type="hidden" name="">
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Üye Adı:</label>
                                    <select id="uyeadi" class="form-select uyeadlari" aria-label="Default select example">
                                        <option value=""></option>
                                        @foreach($uyeler as $item)
                                            <option value="{{$item->Uye_no}}">{{$item->Uye_adi}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Kütüphane Adı:</label>
                                    <select id="kutuphane" class="form-select" aria-label="Default select example">
                                        <option value=""></option>
                                        @foreach($kutuphane as $item)
                                            <option value="{{$item->kutuphane_no}}">{{$item->kutuphane_ismi}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 col-form-label">Emanet Tarihi</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="date"  id="emanetarihi" name="emanetarihi">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 col-form-label">Teslim Tarihi</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="date"  id="teslimtarihi" name="teslimtarihi">
                                    </div>
                                </div>


                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary emanetguncellepost">Güncelle</button>
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
    $(".deleteEmanet").click(function () {
        const id = $(this).data("id")
        console.log(id)
        if (confirm("Silmek İstediğinize Emin misiniz ?")) {
            axios.delete(`/admin/emanetsil/${id}`).then(res => {
                location.href = "/admin/emanetlerlistesi"
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

    $(".emanetGuncelleGetir").click(function () {
        let emanetno = $(this).data("id");
        $("#emanetno").val(emanetno);
        axios.get(`/admin/emanetguncelle/${emanetno}`).then(res => {
            $(".kutuphaneguncellepost").attr("data-bs-dismiss","modal")
            let emanet = res.data.emanet
            $( "#uyeadi option:selected" ).text(emanet.Uye_adi);
            $( "#uyeadi option:selected" ).val(emanet.Uye_no);
            $( "#kitapadi option:selected" ).text(emanet.kitap_adi);
            $( "#kitapadi option:selected" ).val(emanet.ISBN);
            $( "#kutuphane option:selected" ).text(emanet.kutuphane_ismi);
            $( "#kutuphane option:selected" ).val(emanet.kutuphane_no);
            $("#emanetarihi").val(formatDate(emanet.emanet_tarihi));
            $("#teslimtarihi").val(formatDate(emanet.teslim_tarihi));


        })
    })

    $(".emanetguncellepost").click(function () {
        let emanetno = $("#emanetno").val()
        axios.put(`/admin/emanetguncelle/${emanetno}`,{
            kutuphaneno: $("#kutuphane").val(),
            uyeno: $("#uyeadi").val(),
            ISBN: $("#kitapadi").val(),
            emanetarihi: $("#emanetarihi").val(),
            teslimtarihi: $("#teslimtarihi").val(),

        }).then(res => {
            setTimeout(() => {
                location.href = "/admin/emanetlerlistesi"
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
