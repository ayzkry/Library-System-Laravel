@extends("layouts.admin")
@section("title")
    Kitap Ekleme Form
@endsection

@section("css")
    <style>
        #success_message{ display: none;}
    </style>
@endsection

@section("content")

    <form class="well form-horizontal" method="post"  id="contact_form">
        @csrf
        <fieldset>

            <!-- Form Name -->
            <legend><center><h2><b>Kitap Ekleme Form</b></h2></center></legend><br>
            <hr>

            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label">ISBN</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  name="ISBN" placeholder="ISBN" class="form-control"  type="text">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Kitap Adı</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  name="kitapad" placeholder="Kitap Adı" class="form-control"  type="text">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Kitap Miktarı</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  name="miktar" placeholder="Kitap Miktarı" class="form-control"  type="number">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="example-date-input" class="col-2 col-form-label">Yayın Tarihi</label>
                <div class="col-md-4">
                    <input class="form-control" type="date"  id="example-date-input" name="yayintarihi">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Sayfa Sayısı</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  name="sayfasayisi" placeholder="Sayfa Sayisi" class="form-control"  type="text">
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label class="col-md-4 control-label">Kütüphane Seçiniz</label>

                <select class="form-select" aria-label="Default select example" name="kutuphaneno">
                    <option selected>Kütüphane Seçiniz</option>
                    @foreach($kutuphane as $item)
                        <option value="{{$item->kutuphane_no}}">{{$item->kutuphane_ismi}}</option>
                    @endforeach
                </select>
            </div>





            <div class="form-group col-md-4">
                <label class="col-md-4 control-label">Kategori Seçiniz</label>


            <select class="form-select" aria-label="Default select example" name="kategorino">
                <option selected>Kategori Seçiniz</option>
                @foreach($kategori as $item)
                <option value="{{$item->Kategori_no}}">{{$item->Kategori_adi}}</option>
                @endforeach
            </select>
            </div>


            <div class="form-group col-md-4">
                <label class="col-md-4 control-label">Yazar Seçiniz</label>

                <select class="form-select" aria-label="Default select example" name="yazarno">
                    <option selected>Yazar Seçiniz</option>
                    @foreach($yazar as $item)
                    <option value="{{$item->Yazar_no}}">{{$item->Yazar_adi}} {{$item->Yazar_soyadi}}</option>
                    @endforeach
                </select>
            </div>






            <!-- Text input-->




            <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4"><br>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspGÖNDER <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                </div>
            </div>

        </fieldset>
    </form>
@endsection


@section("js")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#contact_form').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    first_name: {
                        validators: {
                            stringLength: {
                                min: 2,
                            },
                            notEmpty: {
                                message: 'Please enter your First Name'
                            }
                        }
                    },
                    last_name: {
                        validators: {
                            stringLength: {
                                min: 2,
                            },
                            notEmpty: {
                                message: 'Please enter your Last Name'
                            }
                        }
                    },
                    user_name: {
                        validators: {
                            stringLength: {
                                min: 8,
                            },
                            notEmpty: {
                                message: 'Please enter your Username'
                            }
                        }
                    },
                    user_password: {
                        validators: {
                            stringLength: {
                                min: 8,
                            },
                            notEmpty: {
                                message: 'Please enter your Password'
                            }
                        }
                    },
                    confirm_password: {
                        validators: {
                            stringLength: {
                                min: 8,
                            },
                            notEmpty: {
                                message: 'Please confirm your Password'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your Email Address'
                            },
                            emailAddress: {
                                message: 'Please enter a valid Email Address'
                            }
                        }
                    },
                    contact_no: {
                        validators: {
                            stringLength: {
                                min: 11,
                                max: 11,
                                notEmpty: {
                                    message: 'Please enter your Contact No.'
                                }
                            }
                        },
                        department: {
                            validators: {
                                notEmpty: {
                                    message: 'Please select your Department/Office'
                                }
                            }
                        },
                    }
                }
            })
                .on('success.form.bv', function(e) {
                    $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                    $('#contact_form').data('bootstrapValidator').resetForm();

                    // Prevent form submission
                    location.href="/admin/kitaplistesi"

                    // Get the form instance
                    var $form = $(e.target);

                    // Get the BootstrapValidator instance
                    var bv = $form.data('bootstrapValidator');

                    // Use Ajax to submit form data
                    $.post($form.attr('action'), $form.serialize(), function(result) {
                        console.log(result);
                    }, 'json');
                });
        });
    </script>

@endsection
