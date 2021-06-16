@extends("layouts.admin")
@section("title")
    Üye Form
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
            <th>Uye No</th>
            <th>Uye Adı</th>
            <th>Uye Soyadı</th>
            <th>Cinsiyet</th>
            <th>Telefon</th>
            <th>Eposta</th>
            <th>İşlem</th>
        </tr>

        </thead>


        <tbody>
        @foreach($uyeler as $key => $item)
            <tr id="uye{{$item->Uye_no}}">
                <td>{{$item->Uye_no}}</td>

                <td>{{$item->Uye_adi}}</td>
                <td>{{$item->Uye_soyadi}}</td>
                @if($item->cinsiyet == 1)
                    <td>Kadın</td>
                @elseif($item->cinsiyet == 0)
                    <td>Erkek</td>
                @endif
                <td>{{$item->telefon}}</td>
                <td>{{$item->eposta}}</td>

                <td>
                    <button data-id="{{$item->Uye_no}}" data-adres_no="{{$item->adres_no}}" type="button"
                            class="btn btn-danger deleteUye">Sil
                    </button>
                    <button data-adres_no="{{$item->adres_no}}" type="button" class="btn btn-warning uyeGuncelle"
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
                <h5 class="modal-title" id="exampleModalLabel">Üye Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Üye Adı:</label>
                                <input type="text" class="form-control" id="uyeadi">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Üye Soyadı:</label>
                                <input type="text" class="form-control" id="uyesoyadi">
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Üye Cinsiyeti:</label>
                                <select id="uyecinsiyet" class="form-select" aria-label="Default select example">
                                    <option value="0">Erkek</option>
                                    <option value="1">Kadın</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Üye Telefon:</label>
                                <input type="number" class="form-control" id="uyetelefon">
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Üye Mail:</label>
                                <input type="text" class="form-control" id="uyemail">
                            </div>

                        </div>


                        <div class="col-md-6">


                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Cadde:</label>
                                <input type="text" class="form-control" id="adrescadde">
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Mahalle:</label>
                                <input type="text" class="form-control" id="adresmahalle">
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Bina No:</label>
                                <input type="number" class="form-control" id="adresbinano">
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Şehir:</label>
                                <input type="text" class="form-control" id="adresehir">
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Posta Kodu:</label>
                                <input type="number" class="form-control" id="adrespostakodu">
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Ülke:</label>
                                <input type="text" class="form-control" id="adresulke">
                            </div>
                            <input id="adresno" type="hidden" name="">

                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary uyeguncellepost">Güncelle</button>
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
        $(".deleteUye").click(function () {
            const id = $(this).data("id")
            const adres_no = $(this).data("adres_no")
            console.log(id)
            if (confirm("Silmek İstediğinize Emin misiniz ?")) {
                axios.delete(`/admin/uyesil/${id}/${adres_no}`).then(res => {
                    location.href = "/admin/uyelistesi"
                })
            } else {

            }


        })


        $(".uyeGuncelle").click(function () {
            const adres_no = $(this).data("adres_no")
            $("#adresno").val(adres_no)
            axios.get(`/admin/uyeguncelle/${adres_no}`).then(response => {
                $(".uyeguncelle").attr("data-bs-dismiss", "modal")
                let result = response.data
                let gender = response.data.cinsiyet
                $("#uyeadi").val(result.Uye_adi);
                $("#uyesoyadi").val(result.Uye_soyadi);
                $("#uyetelefon").val(result.telefon);
                $("#uyemail").val(result.eposta);
                $("#adrescadde").val(result.Cadde);
                $("#adresmahalle").val(result.Mahalle);
                $("#adresbinano").val(result.Bina_no);
                $("#adresehir").val(result.Sehir);
                $("#adrespostakodu").val(result.Posta_kodu);
                $("#adresulke").val(result.Ulke);
                if (gender === 0) {
                    $("#uyecinsiyet option:selected").text("Erkek")
                } else {
                    $("#uyecinsiyet option:selected").text("Kadın")
                }
            })
        })
        $(".uyeguncellepost").click(function () {
            let adres_no = $("#adresno").val()
            axios.put(`/admin/uyeguncelle/${adres_no}`, {
                uyead: $("#uyeadi").val(),
                uyesoyad: $("#uyesoyadi").val(),
                cinsiyet: $("#uyecinsiyet").val(),
                tel: $("#uyetelefon").val(),
                mail: $("#uyemail").val(),
                cadde: $("#adrescadde").val(),
                mahalle: $("#adresmahalle").val(),
                binano: $("#adresbinano").val(),
                sehir: $("#adresehir").val(),
                postakod: $("#adrespostakodu").val(),
                ulke: $("#adresulke").val(),
            }).then(res => {
                setTimeout(() => {
                    location.href = "/admin/uyelistesi"
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
