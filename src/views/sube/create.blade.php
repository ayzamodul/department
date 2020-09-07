@extends('yonetim.layouts.master')
@section('title','Şube | Şube Ekle')
@section('content')
    <style>
        .jconfirm .jconfirm-box div.jconfirm-content-pane .jconfirm-content img {
            max-width: 100%;
            height: 250px;
        }
    </style>
    <header class="page-header" style="width: 110%;margin-left: -5%">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="row-fluid">
            <h2 class="no-margin-bottom" id="h2" style="margin-left: 2%">&nbsp; Şube Yönetimi</h2>
        </div>
    </header>
    @if(Session::has('success'))
        <div class="alert alert-success jquery-error-alert">
            <ul>
                <li>{{Session::get('success')}}</li>
            </ul>
        </div>

    @elseif(Session::has('errors'))
        <div class="alert alert-danger jquery-error-alert">
            <ul>
                <li>{{Session::get('errors')}}</li>
            </ul>
        </div>
    @endif
    <section class="forms animated fadeIn">
        <form action="{{route('sube.create')}}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="card" style="background-color: white" id="">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4" style="margin-right: 5%">Şube Ekle :</h3>
                </div>
                <div class="card-body" id="deneme">
                    <div class="add-properties row" style="background: white">

                        <div class="col-md-12 private-pro-list" style="background: white">
                            <div class="card col-md-12" id="">
                                <br>
                                <div class="form-group row col-md-6 ">
                                    <label class="col-sm-3 form-control-label">İl:</label>
                                    <div class="col-sm-9 select">

                                        <select name="ils_id[]" id="ils_id" class="form-control"
                                                required>
                                            @foreach($iller as $il)

                                                <option value="{{$il->id}}">{{$il->ad}}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row col-md-6">
                                    <label class="col-sm-3 form-control-label">Şube Adı:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control gfull_name"
                                               name="ads[]"
                                               value="" placeholder="Ad" required>
                                    </div>
                                </div>

                                <div class="form-group row col-md-6">
                                    <label class="col-sm-3 form-control-label">Adres:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control gphone"
                                               name="adress[]"
                                               value=""
                                               placeholder="adress" required>
                                    </div>
                                </div>

                                <div class="form-group row col-md-6">
                                    <label class="col-sm-3 form-control-label">Email:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control gtc" name="emails[]"
                                               value=""
                                               placeholder="örn; test@tuzeronline.com" required>

                                    </div>
                                </div>

                                <div class="form-group row  col-md-6">
                                    <label class="col-sm-3 form-control-label">Telefon-1:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control gtc" name="telno1s[]"
                                               value=""
                                               placeholder="örn; 0555 555 5555" required>
                                    </div>
                                </div>
                                <div class="form-group row  col-md-6">
                                    <label class="col-sm-3 form-control-label">Telefon-2:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control gtc" name="telno2s[]"
                                               value=""
                                               placeholder="örn; 0555 555 5555">
                                    </div>
                                </div>
                                <div class="form-group row  col-md-6">
                                    <label class="col-sm-3 form-control-label">Harita:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control gtc" name="haritas[]"
                                               value=""
                                               placeholder="*********" required>
                                    </div>
                                </div>
                                <div class="form-group row  col-md-6">
                                    <label class="col-sm-3 form-control-label">Link:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control gtc" name="links[]"
                                               value=""
                                               placeholder="*********" required>
                                    </div>
                                </div>

                                <div class="form-group row col-md-6">
                                    <label class="form-control-label col-sm-3">Görsel</label>
                                    <div class="col-sm-9">

                                        <div class="row col-md-12">
                                            <p class="btn btn-info form-control midia-toggle" data-input="my-file">Dosya
                                                Seç</p>
                                            <p class="image-del"><i class="fa fa-times" aria-hidden="true"></i></p>
                                        </div>
                                        <br><br>

                                        <img id="preview" class="img-fluid" alt="">
                                        <input type="hidden" class="form-control" name="foto_ads[]" id="my-file">
                                    </div>


                                    <div class="i-checks">
                                        <!--
                                        <input type="file" name="image" accept="image/*" >
                                        <span class="help-block-none">Max boyut : 2mb</span>
                                        -->
                                    </div>

                                </div>
                                <div class="form-group row  col-md-6">
                                    <label class="col-sm-3 form-control-label">Durum:</label>
                                    <div class="col-sm-9">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="onoffswitch[]" class="onoffswitch-checkbox"
                                                   id="myonoffswitch" checked value="1">
                                            <label class="onoffswitch-label" for="myonoffswitch">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-md-12">
                            <a class="btn btn-warning add" onclick="$.newGuardian()" style="float: left"><font
                                    color="white"> Yeni ekle</font></a>
                        </div>

                    </div>
                    <button type="submit" name="update" class="btn btn-primary pull-right">Ekle</button>
                    <br>
                </div>

            </div>

        </form>

    </section>
@endsection
@section('footer')

    <script language="JavaScript" type="text/javascript">
        $("#myonoffswitch").on('change', function () {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'true');
            } else {
                $(this).attr('value', 'false');
                $("#myonoffswitch").prepend('<input type="hidden" name=onoffswitch[] value="false"></input>')
            }
        });
        var sa = {!! $iller !!}



        $(document).ready(function () {
            var switchStatus = false;

            $(".midia-toggle").midia({
                base_url: '{{url('/')}}',
                directory_name: 'sube'
            });
            setTimeout(function () {
                $(".jquery-error-alert").fadeOut(1000);
            }, 3500);
            var priprolen = 0;
            var sayac = 1;

            $.newGuardian = function () {
                var key = $(".new-private-pro-key").val();
                var val = $(".new-private-pro-val").val();


                if (key != 0) {
                    $(".private-pro-list").append(
                        '<div class="row  pri-pro pripro-' + priprolen + '" id="deneme">' +
                        '<div class="card col-md-12" id="">' +
                        '<br><div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label"> İl:</label>' +
                        '<div class="col-md-9">' +
                        ' <select name="ils_id[]" id="ils_id" class="form-control" required>' +
                        sa.map(function (s) {
                            return '<option value="' + s.id + '">' + s.ad + '</option>';
                        }) +
                        '</select>' +
                        '</div></div>' +
                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label"> Şube Adı:</label>' +
                        '<div class="col-md-9">' +
                        '<input type="text" class="form-control" name="ads[]" placeholder="Ad" required>' +
                        '</div></div>' +
                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label">Adres:</label>' +
                        '<div class="col-md-9">' +
                        '<input type="text" class="form-control" name="adress[]" placeholder="örn; 0555 555 5555" required> ' +
                        '</div></div>' +

                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label">Email:</label>' +
                        '<div class="col-md-9">' +
                        '<input type="text" class="form-control" name="emails[]" placeholder="T.C. kimlik numarası" required>' +
                        '</div></div>' +
                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label">Telefon-1:</label>' +
                        '<div class="col-md-9">' +
                        '<input type="text" class="form-control" name="telno1s[]" placeholder="T.C. kimlik numarası" required>' +
                        '</div></div>' +
                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label">Telefon-2:</label>' +
                        '<div class="col-md-9">' +
                        '<input type="text" class="form-control" name="telno2s[]" placeholder="T.C. kimlik numarası" required>' +
                        '</div></div>' +
                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label">Harita:</label>' +
                        '<div class="col-md-9">' +
                        '<input type="text" class="form-control" name="haritas[]" placeholder="T.C. kimlik numarası" required>' +
                        '</div></div>' +
                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label">Link:</label>' +
                        '<div class="col-md-9">' +
                        '<input type="text" class="form-control" name="links[]" placeholder="T.C. kimlik numarası" required>' +
                        '</div></div>' +
                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label">resim </label>' +
                        '<div class="col-md-9">' +
                        '<div class="row col-sm-12">' +
                        '<p class="btn btn-info form-control midia-toggle" data-input="my-file' + sayac + '">Dosya Seç</p>' +
                        ' <p class="image-del"><i class="fa fa-times" aria-hidden="true"></i></p>' +
                        '</div>' +
                        ' <img id="preview-' + sayac + '" class="img-fluid" alt="">' +
                        ' <input type="hidden" class="form-control foto_ads" name="foto_ads[]" id="my-file' + sayac + '">' +
                        ' <script>' +
                        '$(".midia-toggle").midia({' +
                        'base_url: "{{url("/")}}",' +
                        'directory_name: "sube" ' +
                        '});' +
                        '            <\/script>' +
                        '</div>' + '</div>' +
                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label">Durum:</label>' +
                        '<div class="col-md-9">' +
                        '<div class="onoffswitch">' +
                        '<input type="checkbox" name="onoffswitch[]" class="onoffswitch-checkbox" id="myonoffswitch' + sayac + '" checked>' +
                        '  <label class="onoffswitch-label" for="myonoffswitch' + sayac + '">' +
                        ' <span class="onoffswitch-inner"></span>' +
                        ' <span class="onoffswitch-switch"></span>' +
                        '</label>' +
                        '</div>' +
                        '</div></div>' +
                        ' <script>' +
                        '  $("#myonoffswitch'+sayac+'").on(\'change\', function () {\n' +
                        '                if ($(this).is(\':checked\')) {\n' +
                        '                    $(this).attr(\'value\', \'true\');\n' +
                        '                } else {\n' +
                        '                    $(this).attr(\'value\', \'false\');\n' +
                        '                    $("#myonoffswitch").prepend(\'<input type="hidden" name=onoffswitch[] value="false"></input>\')\n' +
                        '                }\n' +
                        '            });'+
                        '<\/script>' +
                        '<small class="btn btn-danger " style="float: right" onclick="$.guardian_del(\'pripro-' + priprolen + '\')"><font color="white"> Kaldır</font></small>' +
                        '</div></div>' +
                        '</div>');

                    sayac += 1;
                    priprolen += 1;
                    $(".new-private-pro-key").val(0);
                    $(".new-private-pro-val").val("");

                } else {
                    $.alert({
                        title: 'Uyarı!',
                        content: 'Lütfen bir değer girin!',
                        theme: 'modern',
                        buttons: {
                            tamam: function () {
                            }
                        }
                    });
                }

            };

            $.guardian_del = function (div) {
                $("." + div).remove();
            };


        });
        /*
    function veriGonder(kategoriId)
    {
       // console.log(kategoriId);
        let url = 'http://127.0.0.1:8000/subeList/'+kategoriId;

        fetch(url)
            .then(res => res.json()
            )
            .then((out) => {
                var select=document.getElementById("sube_id")

               out.forEach(function (item) {

                   var opt=document.createElement("option");
                   opt.text=item.ad;
                   select.appendChild(opt);
               })

               console.log(out);
            })
            .catch(err => { throw err });

    }*/

    </script>
@endsection
