@extends('yonetim.layouts.master')
@section('title','Şube | Personel Ekle')
@section('content')
    <style>
        .jconfirm .jconfirm-box div.jconfirm-content-pane .jconfirm-content img {
            max-width: 100%;
            height: 250px;
        }
    </style>
    <header class="page-header" style="width: 110%;margin-left: -5%">
        <div class="row-fluid">
            <h2 class="no-margin-bottom" id="h2" style="margin-left: 2%">&nbsp; Personel Yönetimi</h2>
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

    @can('personel-ekleDuzenle')
        <section class="forms animated fadeIn">
            <form method="post" action="{{route('personel.create')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card" style="background-color: white" id="">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Personel Ekle :</h3>
                    </div>
                    <div class="card-body" id="deneme">
                        <div class="add-properties row" style="background: white">

                            <div class="col-md-12 private-pro-list" style="background: white">
                                <div class="card col-md-12" id="">
                                    <br>
                                    <div class="form-group row col-md-6 ">

                                        <label class="col-sm-3 form-control-label">İl</label>
                                        <div class="col-sm-9 select">

                                            <select name="il_id[]" id="il_id" class="form-control"
                                                    onchange="$.verigonder1(value,this)" required>
                                                @foreach($iller as $il)

                                                    <option value="{{$il->id}}">{{$il->ad}}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row col-md-6">
                                        <label class="col-sm-3 form-control-label">Şube</label>
                                        <div class="col-sm-9 select">

                                            <select name="sube_id[]" id="sube_id" class="form-control"

                                                    required>


                                                <option value="0">Şube Seçiniz</option>


                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row col-md-6">
                                        <label class="col-sm-3 form-control-label">Ad</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control gfull_name"
                                                   name="ad[]"
                                                   value="" placeholder="Ad" required>
                                        </div>
                                    </div>

                                    <div class="form-group row col-md-6">
                                        <label class="col-sm-3 form-control-label">Soyad</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control soyad"
                                                   name="soyad[]"
                                                   value=""
                                                   placeholder="soyad" required>
                                        </div>
                                    </div>

                                    <div class="form-group row col-md-6">
                                        <label class="col-sm-3 form-control-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control email" name="email[]"
                                                   value=""
                                                   placeholder="örn; test@tuzeronline.com" required>

                                        </div>
                                    </div>

                                    <div class="form-group row  col-md-6">
                                        <label class="col-sm-3 form-control-label">Telefon</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control gtc" name="telno[]"
                                                   value=""
                                                   placeholder="örn; 0555 555 5555" required>
                                        </div>
                                    </div>

                                    <div class="form-group row  col-md-6">
                                        <label class="col-sm-3 form-control-label">Şifre</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control gtc" name="password[]"
                                                   value=""
                                                   placeholder="*********" required>
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-6">
                                        <label class="col-sm-3 form-control-label">Ünvan</label>
                                        <div class="col-sm-9 select">

                                            <select name="unvan_id[]" id="unvan_id" class="form-control"

                                                    required>

                                                @foreach($unvanlar as $unvan)
                                                    <option value="{{$unvan->id}}">{{$unvan->unvan}}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>
<div class="col-md-12 row">

                                    <div class="form-group row col-md-6">
                                        <label class="form-control-label col-sm-3">Görsel</label>
                                        <div class="col-sm-9">

                                            <div class="row col-md-12">
                                                <p class="btn btn-info form-control midia-toggle" data-input="my-file">
                                                    Dosya Seç</p>
                                                <p class="image-del"><i class="fa fa-times" aria-hidden="true"></i></p>
                                            </div>
                                            <br><br>

                                            <img id="preview" class="img-fluid" alt="">
                                            <input type="hidden" class="form-control" name="foto_ad[]" id="my-file">
                                        </div>


                                        <div class="i-checks">
                                            <!--
                                            <input type="file" name="image" accept="image/*" >
                                            <span class="help-block-none">Max boyut : 2mb</span>
                                            -->
                                        </div>

                                    </div>
                                    <div class="form-group   col-md-6">
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
    @endcan


@endsection
@section('footer')


    <script language="JavaScript" type="text/javascript">

        var sa ={!! $iller !!}
        var as = {!! $unvans !!}


            $(document).ready(function () {
                $("#myonoffswitch").on('change', function () {
                    if ($(this).is(':checked')) {
                        $(this).attr('value', 'true');
                    } else {
                        $(this).attr('value', 'false');
                        $("#myonoffswitch").prepend('<input type="hidden" name=onoffswitch[] value="false"></input>')
                    }
                });
                $(".midia-toggle").midia({
                    base_url: '{{url('/')}}',
                    directory_name: 'personel'
                });
                $.verigonder = function (kategoriId, this_item, sayac) {
                    //önemli burası  .

                    let url = '/yonetim/sube/subeList/' + kategoriId;
                    $.get(url, function (data) {
                        console.log(data);
                        $.each(data, function (k, v) {

                            if (v.isDelete == 0) {
                                $("#sube_id" + sayac + "").prepend('<option class="item" value="' + v.id + '">' + v.ad + '</option>')
                            }

                        });
                    });

                }
                $.verigonder1 = function (kategoriId, this_item) {
                    //önemli burası  .
                    $("#sube_id").empty();
                    let url = '/yonetim/sube/subeList/' + kategoriId;
                    $.get(url, function (data) {
                        console.log(data);
                        $.each(data, function (k, v) {

                            if (v.isDelete == 0) {
                                $("#sube_id").prepend('<option class="item" value="' + v.id + '">' + v.ad + '</option>')
                            }

                        });
                    });

                }

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
                            '<label class="col-sm-3 form-control-label"> İl</label>' +
                            '<div class="col-md-9">' +
                            ' <select name="il_id[]" id="il_id' + sayac + '" class="form-control" required onchange="$.verigonder(value,this,' + sayac + ')">' +
                            sa.map(function (s) {
                                return '<option value="' + s.id + '">' + s.ad + '</option>';
                            }) +
                            '</select>' +
                            '</div></div>' +
                            '<div class="form-group row col-sm-6">' +
                            '<label class="col-sm-3 form-control-label"> Şube</label>' +
                            '<div class="col-md-9">' +
                            ' <select name="sube_id[]" required id="sube_id' + sayac + '" class="form-control">' +

                            '<option value="0" >Şube Seçiniz</option>' +

                            '</select>' +
                            '</div></div>' +
                            '<div class="form-group row col-sm-6">' +
                            '<label class="col-sm-3 form-control-label"> Ad</label>' +
                            '<div class="col-md-9">' +
                            '<input type="text" class="form-control" name="ad[]" placeholder="Ad" required>' +
                            '</div></div>' +
                            '<div class="form-group row col-sm-6">' +
                            '<label class="col-sm-3 form-control-label">Soyad</label>' +
                            '<div class="col-md-9">' +
                            '<input type="text" class="form-control" name="soyad[]" placeholder="örn; 0555 555 5555" required> ' +
                            '</div></div>' +


                            '<div class="form-group row col-sm-6">' +
                            '<label class="col-sm-3 form-control-label">Email</label>' +
                            '<div class="col-md-9">' +
                            '<input type="text" class="form-control" name="email[]" placeholder="T.C. kimlik numarası" required>' +
                            '</div></div>' +
                            '<div class="form-group row col-sm-6">' +
                            '<label class="col-sm-3 form-control-label">Telefon</label>' +
                            '<div class="col-md-9">' +
                            '<input type="text" class="form-control" name="telno[]" placeholder="T.C. kimlik numarası" required>' +
                            '</div></div>' +
                            '<div class="form-group row col-sm-6">' +
                            '<label class="col-sm-3 form-control-label">Şifre</label>' +
                            '<div class="col-md-9">' +
                            '<input type="text" class="form-control" name="password[]" placeholder="T.C. kimlik numarası" required>' +
                            '</div></div>' +


                            '<div class="form-group row col-sm-6">' +
                            '<label class="col-sm-3 form-control-label"> Ünvan</label>' +
                            '<div class="col-md-9">' +
                            ' <select name="unvan_id[]" id="unvan_id" class="form-control"> ' +
                            as.map(function (s) {
                                return '<option value="'+ s.id +'">' + s.unvan + '</option>';
                            }) +
                            '</select>' +
                            '</div></div>' +


                            '<div class="col-md-12 row">'+
                            '<div class="form-group row col-sm-6">' +
                            '<label class="col-sm-3 form-control-label">resim </label>' +
                            '<div class="col-md-9">' +
                            '<div class="row col-sm-12">' +
                            '<p class="btn btn-info form-control midia-toggle" data-input="' + sayac + '">Dosya Seç</p>' +
                            ' <p class="image-del"><i class="fa fa-times" aria-hidden="true"></i></p>' +
                            '</div>' +
                            ' <img id="preview" class="img-fluid" alt="">' +
                            ' <input type="hidden" class="form-control foto_ad" name="foto_ad[]" id="' + sayac + '">' +
                            ' <script>' +
                            '$(".midia-toggle").midia({' +
                            'base_url: "{{url("/")}}",' +
                            'directory_name: "personel" ' +
                            '});' +
                            '            <\/script>' +
                            '</div>' + '</div>' +

                            '<div class="form-group col-sm-6">' +
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
                            '  $("#myonoffswitch' + sayac + '").on(\'change\', function () {\n' +
                            '                if ($(this).is(\':checked\')) {\n' +
                            '                    $(this).attr(\'value\', \'true\');\n' +
                            '                } else {\n' +
                            '                    $(this).attr(\'value\', \'false\');\n' +
                            '                    $("#myonoffswitch' + sayac + '").prepend(\'<input type="hidden" name=onoffswitch[] value="false"></input>\')\n' +
                            '                }\n' +
                            '            });'+
                            '<\/script>' +
                            '</div>'+
                            '<small class="btn btn-danger " style="float: right" onclick="$.guardian_del(\'pripro-' + priprolen + '\')"><font color="white">Kaldır</font></small><br><br><br>' +
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
