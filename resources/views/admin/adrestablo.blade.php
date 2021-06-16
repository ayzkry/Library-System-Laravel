@extends("layouts.admin")
@section("title")
    Adres Form
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
            <th>Adres no</th>
            <th>Cadde</th>
            <th>Mahalle</th>
            <th>Bina No</th>
            <th>Sehir</th>
            <th>Posta Kodu</th>
            <th>Ulke</th>
        </tr>

        </thead>


        <tbody>
        @foreach($adresler as $key => $item)
            <tr id="adres{{$item->Adres_no}}">
                <td>{{$item->Adres_no}}</td>
                <td>{{$item->Cadde}}</td>
                <td>{{$item->Mahalle}}</td>
                <td>{{$item->Bina_no}}</td>
                <td>{{$item->Sehir}}</td>
                <td>{{$item->Posta_kodu}}</td>
                <td>{{$item->Ulke}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


@section("js")

@endsection

