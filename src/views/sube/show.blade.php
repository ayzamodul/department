@extends('yonetim.layouts.master')
@section('title','Yönetim | Şube Yönetimi')
@section('content')
    <style>
        .img-avatar {
            display: inline-block !important;
            width: 64px;
            height: 64px;
            border-radius: 50%
        }

        .img-sube {

            width: 100%;
            opacity: 1;
            -webkit-transition: all .4s ease;
            transition: all .4s ease;
            height: 300px;

        }

        .img-avatar.img-avatar48 {
            width: 48px;
            height: 48px
        }

        .jconfirm .jconfirm-box div.jconfirm-content-pane .jconfirm-content {
            overflow: hidden;
        }

        .jconfirm {
            z-index: 10 !important;
        }

        .midia-content {
            z-index: 20 !important;
        }

    </style>

    <header class="page-header" style="width: 110%;margin-left: -5%"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
    @foreach($sube as $datas)
        <section class="forms animated fadeIn">


            {{ csrf_field() }}

            <div class="card" style="background-color: white" id="">
                <div style="float: right">
                    @can('sube-ekleDuzenle')
                        <a onclick="new_personal({{$datas->id}})" class="btn btn-primary"
                           style="margin-top: 15%">Personel Ekle</a>
                    @endcan
                </div>
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Şube Adı: {{$datas->ad}}</h3>
                </div>
                <div class="row card-body" id="deneme">
                    <div class=" card" id="">
                        <div class="row card-body max_h_c" id="deneme">
                            <div class=" card col-md-4 max_h" id="" style="background-color: #6c757d0d">
                                @if(isset($datas->foto_ad) && $datas->foto_ad!=null)
                                    <img class=" img-sube" src="{{$datas->foto_ad}}" alt="">
                                @else
                                    <img class=" img-sube" src="{{asset('img/noimage.png')}}" alt="">
                                @endif

                            </div>

                            <div class="card col-md-8 max_h" id="" style="background-color: #6c757d0d">

                                <h4>Şube Bilgileri
                                    @can('sube-ekleDuzenle')
                                        <a onclick="department_delete({{$datas->id}})" type="submit" name=""
                                           class="btn btn-danger pull-right"><i class="fa fa-trash"></i> </a>
                                    @endcan
                                    @can('sube-sil')
                                        <a onclick="upd_department({{$datas->id}})" type="submit" name=""
                                           class="btn btn-warning pull-right"><i class="fas fa-edit"></i> </a></h4><br>
                                @endcan
                                <p>
                                    <b>Email : </b> {{$datas->email}}<br>
                                </p>
                                <p>
                                    <b> Telefon-1 : </b> {{$datas->telno1}} <br>
                                </p>
                                <p>
                                    <b> Telefon-2 : </b> {{$datas->telno2}}<br>
                                </p>
                                <p>
                                    <b> Adres : </b> {{$datas->adres}} <br>
                                </p>
                                <p>
                                    <b> Link : </b> <a href="{{$datas->ink}}">{{$datas->link}}</a>
                                </p>
                                <p>
                                    <b> Durumu : </b>@if($datas->isAktif==0)
                                        Pasif
                                    @else
                                        Aktif
                                    @endif
                                </p>

                            </div>
                        </div>
                        @if(isset($datas->harita) && $datas->harita!=null)
                            <div>
                                <p align="row map">
                                    <iframe src="{{$datas->harita}}"
                                            width="100%"></iframe>
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="card-body row-list-table">


                        <div class="table-responsive">
                            <table class="responsive table table-hover table-bordered myTab" style="width: 100%">
                                <thead class="thead">
                                <tr>
                                    <th><i class="fas fa-user"></i></th>
                                    <th>Ünvan</th>
                                    <th>Ad</th>
                                    <th>Soyad</th>
                                    <th>Email</th>
                                    <th>Telefon</th>
                                    @can('sube-ekleDuzenle')
                                        <th style="width: 70px">Düzenle</th>
                                    @endcan
                                    @can('sube-ekleDuzenle')
                                        <th style="width: 70px">Sil</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($personel as $pers)
                                    @if ($datas->id == $pers->sube_id)
                                        <tr>
                                            <td>
                                                @if(isset($pers->foto_ad) && $pers->foto_ad!=null)
                                                    <img class="img-avatar img-avatar48"
                                                         src="{{$pers->foto_ad}}" alt="">
                                                @else
                                                    <img class="img-avatar img-avatar48"
                                                         src="{{asset('anasayfa/assets/images/comment-1-1.png')}}"
                                                         alt="">
                                                @endif
                                            </td>
                                              <td> @if(isset($pers->unvan->unvan) &&$pers->unvan->unvan!=null)
                                                {{$pers->unvan->unvan}}
                                                     @endif
                                            </td>
                                            <td>{{$pers->ad}}</td>

                                            <td>{{$pers->soyad}}</td>

                                            <td>{{$pers->email}}</td>
                                            <td>{{$pers->telno}}</td>

                                            @can('sube-ekleDuzenle')
                                                <td align="center">
                                                    <a onclick="upd_personal({{$pers->id}})" type="submit" name=""

                                                       class="btn btn-warning"><i class="fas fa-edit"></i> </a>


                                                </td>
                                            @endcan
                                            @can('sube-ekleDuzenle')
                                                <td align="center"><a onclick="personal_delete({{$pers->id}})"
                                                                      type="submit" name=""

                                                                      class="btn btn-danger"><i
                                                            class="fas fa-trash"></i></a></td>
                                            @endcan
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <br>
                    </div>
                </div>
            </div>

        </section>
    @endforeach


<script src="{{asset('deneme/jquery-3.2.1.slim.min.js')}}"></script>
<script>
    $(document).ready(function ($) {
        $(".max_h_c").each(function (j, d) {
            var maxHeight = 0;
            $(d).find('.max_h').each(function (i, e) {
                if (maxHeight < $(e).height()) maxHeight = $(e).height();

            });
            $(d).find('.max_h').height(maxHeight);
        });
    });
</script>

<script>
    var as =
        {!! $unvan !!}

    var ass =
        {!! $sube !!}
    var sa = {!! $iller !!}
        $(document).ready(function () {

            $.verigonder = function (kategoriId, this_item) {
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

            $('.myTab').DataTable({


                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/a5734b29083/i18n/Turkish.json"
                },

                "order": [[0, "desc"]],

                bFilter: false,
                paging: false,

            });


        });

    function new_personal(data_id) {

        $.confirm({
            columnClass: 'col-md-10 col-md-offset-1',
            type: 'dark',
            icon: 'fa fa-info-circle',
            title: 'Personel Ekle',
            content: '' +
                '<form action=""  class="formName" xmlns="http://www.w3.org/1999/html" enctype="multipart/form-data" files="true">' +

                '<div class="card col-md-12" id="">' +
                '<br><div class="form-group row col-sm-6">' +
                '<label class="col-sm-3 form-control-label"> Ünvan</label>' +
                '<div class="col-md-9">' +
                ' <select name="unvan_id[]" id="unvan_id" class="form-control unvan">' +
                as.map(function (s) {
                    return '<option value="' + s.id + '">' + s.unvan + '</option>';
                }) +
                '</select>' +
                '</div>' +

                '</div>' +
                '<div class="form-group row col-sm-6">' +
                '<label class="col-sm-3 form-control-label"> Ad</label>' +
                '<div class="col-md-9">' +
                '<input type="text" class="form-control ad" name="ad[]" placeholder="Ad">' +
                '</div></div>' +

                '<div class="form-group row col-sm-6">' +
                '<label class="col-sm-3 form-control-label ">Soyad</label>' +
                '<div class="col-md-9">' +
                '<input type="text" class="form-control soyad" name="soyad[]" placeholder="Soyad"> ' +
                '</div></div>' +

                '<div class="form-group row col-sm-6">' +
                '<label class="col-sm-3 form-control-label">Email</label>' +
                '<div class="col-md-9">' +
                '<input type="text" class="form-control email" name="email[]" placeholder="Örn:test1@img.com">' +
                '</div></div>' +

                '<div class="form-group row col-sm-6">' +
                '<label class="col-sm-3 form-control-label">Telefon</label>' +
                '<div class="col-md-9">' +
                '<input type="text" class="form-control telno" name="telno[]" placeholder="Örn:05555555555">' +
                '</div></div>' +

                '<div class="form-group row col-sm-6">' +
                '<label class="col-sm-3 form-control-label">Şifre</label>' +
                '<div class="col-md-9">' +
                '<input type="text" class="form-control password" name="password[]" placeholder="Örn:1234567">' +
                '</div></div>' +




                '<div class="form-group row col-sm-6">' +
                '<label class="col-sm-3 form-control-label">Resim </label>' +
                '<div class="col-md-9">' +
                '<div class="col-sm-12 row">' +
                '<p class="btn btn-info form-control midia-toggle" data-input="my-file">Dosya Seç</p>' +
                ' <p class="image-del"><i class="fa fa-times" aria-hidden="true"></i></p>' +
                '</div>' +
                ' <img id="preview" class="img-fluid" alt="">' +
                ' <input type="hidden" class="form-control foto_ad" name="image" id="my-file">' +
                ' <script>' +
                '$(".midia-toggle").midia({' +
                'base_url: "{{url("/")}}",' +
                'directory_name: "personel" ' +
                '});' +
                '<\/script>' +
                '</div>' + '</div>' +
                '<div class="form-group row col-sm-6 ">' +
                '<label class="col-sm-3 form-control-label">Durum:</label>' +
                '<div class="col-md-9">' +
                '<div class="onoffswitch">' +
                '<input type="checkbox" name="onoffswitch[]" class="onoffswitch-checkbox" id="myonoffswitch1"' +


                '>' +
                '  <label class="onoffswitch-label" for="myonoffswitch1">' +
                ' <span class="onoffswitch-inner"></span>' +
                ' <span class="onoffswitch-switch"></span>' +
                '</label>' +
                '</div>' +
                '</div></div>' +

                ' <script>' +
                '  $("#myonoffswitch1").on(\'change\', function () {\n' +
                '                if ($(this).is(\':checked\')) {\n' +
                '                    $(this).attr(\'value\', \'true\');\n' +
                '                } else {\n' +
                '                    $(this).attr(\'value\', \'false\');\n' +
                '                    $("#myonoffswitch1").prepend(\'<input type="hidden" name=onoffswitch[] value="false"></input>\')\n' +
                '                }\n' +
                '            });'+
                '<\/script>' +
                '</div>' +
                '</form>',
            buttons: {
                formSubmit: {
                    text: 'Kaydet',
                    btnClass: 'btn-blue',
                    action: function () {
                        var ad = this.$content.find('.ad').val();
                        var soyad = this.$content.find('.soyad').val();
                        var email = this.$content.find('.email').val();
                        var telno = this.$content.find('.telno').val();
                        var unvan = this.$content.find('.unvan').val();
                        var password = this.$content.find('.password').val();
                        var foto_ad = this.$content.find('#my-file').val();


                        var tid = data_id;
                        var ajaxurl = "{{url('yonetim/sube/newPersonal')}}";
                        var token = ' {{csrf_token()}}';
                        console.log(ajaxurl);
                        $.post(ajaxurl, {
                            _token: token,
                            ad: ad,
                            tid: tid,
                            soyad: soyad,
                            email: email,
                            telno: telno,
                            unvan: unvan,
                            password: password,
                            foto_ad: foto_ad


                        }, function (ret) {

                            if (ret == 1) {

                                $.confirm({
                                    title: 'Bilgi',

                                    type: 'dark',
                                    icon: 'fa fa-info-circle',
                                    content: 'Personel kaydedildi.',
                                    buttons: {
                                        formSubmit: {
                                            text: 'Tamam',
                                            btnClass: 'btn',

                                            action: function () {
                                                window.location.reload()
                                            }
                                        },

                                    },
                                });

                            } else {
                                $.alert("Ters giden bir şey oldu. Lütfen tekrar deneyin.")
                            }
                        });
                    }
                },
                İptal: function () {
                    //close
                },
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    }

    function upd_personal(id) {
        $.post('{{url('/yonetim/sube/personel/edit')}}', {
            _token: '{{csrf_token()}}',
            id: id
        }, function (ret) {
            if (ret.ret == 1) {
                var data = ret.data;


                $.confirm({
                    title: 'Güncelle',
                    type: 'dark',
                    icon: 'fa fa-pencil',
                    columnClass: 'col-md-10 col-md-offset-2',
                    content: '' +
                        '<form action="" class="formName">' +
                        '<input type="hidden" class="id" value="' + data.id + '" />' +
                        '<br><div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label"> İl</label>' +
                        '<div class="col-md-9">' +
                        ' <select name="il_id[]" id="il_id" class="form-control il_id" required onchange="$.verigonder(value,this)">' +
                        sa.map(function (s) {
                            if (s.id == data.il_id) {
                                return '<option selected value="' + s.id + '">' + s.ad + '</option>';
                            } else {
                                return '<option value="' + s.id + '">' + s.ad + '</option>';
                            }
                        }) +
                        '</select>' +
                        '</div></div>' +
                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label"> Şube</label>' +
                        '<div class="col-md-9">' +
                        ' <select name="sube_id[]" required id="sube_id" class="form-control sube_id">' +
                        (data.sube_id != null ?
                                ass.map(function (s) {
                                    if (s.il_id == data.il_id) {
                                        if (s.id == data.sube_id) {
                                            return '<option selected value="' + s.id + '">' + s.ad + '</option>';
                                        } else {
                                            return '<option value="' + s.id + '">' + s.ad + '</option>';
                                        }

                                    }

                                }) : '<option value="0">Şube Seçiniz</option>'
                        ) +


                        '</select>' +
                        '</div></div>' +

                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label"> unvan</label>' +
                        '<div class="col-md-9">' +
                        ' <select name="unvan_id[]" id="unvan_id" class="form-control unvan">' +
                        as.map(function (s) {
                            if (s.id == data.unvan_id) {
                                return '<option selected value="' + s.id + '">' + s.unvan + '</option>';
                            }
                            return '<option value="' + s.id + '">' + s.unvan + '</option>';
                        }) +
                        '</select>' +
                        '</div></div>' +

                        ' <div class="form-group row col-sm-6">' +
                        ' <label class="col-sm-3 form-control-label">Ad</label>' +
                        ' <div class="col-sm-9">' +
                        '<input type="text" class="form-control ad" required="required"  value="' + data.ad + '" placeholder="">' +
                        '</div></div>' +

                        ' <div class="form-group row col-sm-6">' +
                        ' <label class="col-sm-3 form-control-label">Soyad</label>' +
                        ' <div class="col-sm-9">' +
                        '<input type="text" class="form-control soyad" required="required"  value="' + data.soyad + '" placeholder="">' +
                        '</div></div>' +

                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label">Email </label>' +
                        '<div class="col-sm-9">' +
                        '<input type="text" class="form-control email"   value="' + data.email + '" placeholder="">' +
                        '</div> </div>' +

                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label">Şifre </label>' +
                        '<div class="col-sm-9">' +
                        '<input type="password" class="form-control password"   value="" placeholder="">' +
                        '</div></div>' +


                        '<div class="form-group row col-sm-6">' +
                        '<label class="col-sm-3 form-control-label">Telefon</label>' +
                        '<div class="col-sm-9">' +
                        '<input type="text" class="form-control telno" value="' + data.telno + '" placeholder="">' +

                        '</div> </div>' +
                        ' <div class="form-group row col-sm-6">' +
                        ' <label class="form-control-label col-sm-3">Görsel</label>' +
                        '<div class="col-sm-9">' +
                        '<div class="col-sm-12">' +
                        '<p class="btn btn-info form-control midia-toggle" data-input="my-file">Dosya Seç</p>' +
                        ' <p class="image-del"><i class="fa fa-times" aria-hidden="true"></i></p>' +
                        '</div>' +
                        ' <img id="preview" class="img-fluid" src="' + data.foto_ad + '" alt="">' +
                        ' <input type="hidden" class="form-control foto_ad" name="image" id="my-file">' +
                        '   <input type="hidden" class="form-control" name="last_image" value="' + data.foto_ad + '" id="last-my-file">' +
                        ' <script>' +

                        '$(".midia-toggle").midia({' +
                        'base_url: "{{url("/")}}",' +
                        'directory_name: "personel" ' +
                        '});' +
                        '            <\/script>' +
                        '</div>' + '</div>' +

                        '<div class="form-group row col-sm-6 ">' +
                        '<label class="col-sm-3 form-control-label">Durum:</label>' +
                        '<div class="col-md-9">' +
                        '<div class="onoffswitch">' +
                        '<input type="checkbox" name="onoffswitch[]" class="onoffswitch-checkbox" value="1" id="myonoffswitch1"' +
                        (data.isAktif == 1 ?
                                "checked" : ''

                        ) +


                        '>' +
                        '  <label class="onoffswitch-label" for="myonoffswitch1">' +
                        ' <span class="onoffswitch-inner"></span>' +
                        ' <span class="onoffswitch-switch"></span>' +
                        '</label>' +
                        '</div>' +
                        '</div></div>' +
                        ' <script>' +
                        '  $("#myonoffswitch1").on(\'change\', function () {\n' +
                        '                if ($(this).is(\':checked\')) {\n' +
                        '                    $(this).attr(\'value\', \'true\');\n' +
                        '                } else {\n' +
                        '                    $(this).attr(\'value\', \'false\');\n' +
                        '                    $("#myonoffswitch1").prepend(\'<input type="hidden" name=onoffswitch[] value="false"></input>\')\n' +
                        '                }\n' +
                        '            });'+
                        '<\/script>' +
                        '</form>',

                    buttons: {
                        formSubmit: {
                            text: 'Güncelle',
                            btnClass: 'btn-blue',
                            action: function () {

                                var id = this.$content.find('.id').val();
                                var ad = this.$content.find('.ad').val();
                                var soyad = this.$content.find('.soyad').val();
                                var email = this.$content.find('.email').val();
                                var telno = this.$content.find('.telno').val();
                                var unvan = this.$content.find('.unvan').val();
                                var password = this.$content.find('.password').val();
                                var il_id = this.$content.find('.il_id').val();
                                var sube_id = this.$content.find('.sube_id').val();
                                var foto_ad = this.$content.find('#my-file').val();
                                var isAktif = this.$content.find('#myonoffswitch1').val();
console.log(isAktif);
                                if (ad != "") {
                                    $.post('{{url('/yonetim/sube/personel/update')}}', {
                                        id: id,
                                        ad: ad,
                                        email: email,
                                        soyad: soyad,
                                        telno: telno,
                                        unvan: unvan,
                                        password: password,
                                        foto_ad: foto_ad,
                                        il_id: il_id,
                                        sube_id: sube_id,
                                        isAktif: isAktif,


                                        _token: '{{csrf_token()}}'
                                    }, function (ret) {
                                        if (ret.ret == 1) {

                                            $.confirm({
                                                title: 'Bilgi',

                                                type: 'dark',
                                                icon: 'fa fa-info-circle',
                                                content: 'Personel güncellendi.',
                                                buttons: {
                                                    formSubmit: {
                                                        text: 'Tamam',
                                                        btnClass: 'btn',

                                                        action: function () {
                                                            window.location.reload()
                                                        }
                                                    },

                                                },
                                            });

                                        } else {
                                            $.dialog({
                                                title: 'Hata!',
                                                content: ret.message,
                                            });
                                            return false;
                                        }
                                    }, "json");
                                } else {
                                    $.dialog({
                                        title: 'Hata!',
                                        content: 'Boş değer girilemez!',
                                    });
                                    return false;
                                }
                            }
                        },
                        cancel: {
                            text: 'Kapat',
                            action: function () {
                            }
                        }
                    },
                });
            } else {
                $.dialog({
                    title: 'Hata!',
                    content: 'Veri bulunamadı',
                });
            }
        }, "json");
    }

    function personal_delete(data_id) {

        $.confirm({

            type: 'red',
            typeAnimated: true,
            icon: 'fa fa-trash',
            title: 'Uyarı!',
            content: 'Personeli silmek istiyor musunuz?',

            buttons: {
                formSubmit: {
                    text: 'Sil',
                    btnClass: 'btn-red',
                    action: function () {

                        var name = this.$content.find('.name').val();
                        var tid = data_id;
                        var ajaxurl = "{{url('yonetim/sube/personel/delete')}}";
                        var token = ' {{csrf_token()}}';
                        console.log(ajaxurl);
                        $.post(ajaxurl, {
                            _token: token,
                            tid: tid
                        }, function (ret) {

                            if (ret == 1) {

                                $.confirm({
                                    title: 'Bilgi',

                                    type: 'red',
                                    icon: 'fa fa-info-circle',
                                    content: 'Personel silindi!',
                                    buttons: {
                                        formSubmit: {
                                            text: 'Tamam',
                                            btnClass: 'btn-red',

                                            action: function () {
                                                window.location.reload()
                                            }
                                        },

                                    },
                                });

                            } else {
                                $.alert("Ters giden bir şey oldu. Lütfen tekrar deneyin.")
                            }
                        });
                    }

                },
                İptal: function () {
                    //close

                },
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });

    }

    function upd_department(id) {
        $.post('{{url('/yonetim/sube/edit')}}', {
            _token: '{{csrf_token()}}',
            id: id
        }, function (ret) {
            if (ret.ret == 1) {
                var data = ret.data;


                $.confirm({
                    title: 'Güncelle',
                    type: 'dark',
                    icon: 'fas fa-pencil-alt',
                    columnClass: 'col-md-6 col-md-offset-3',
                    content: '' +
                        '<form action="" class="formName">' +
                        '<input type="hidden" class="id" value="' + data.id + '" />' +
                        ' <div class="form-group row">' +
                        ' <label class="col-sm-4 form-control-label">Şube Adı </label>' +
                        ' <div class="col-sm-8">' +
                        '<input type="text" class="form-control ad" required="required"  value="' + data.ad + '" placeholder="">' +
                        '</div></div>' +

                        '<div class="form-group row">' +
                        '<label class="col-sm-4 form-control-label">Email </label>' +
                        '<div class="col-sm-8">' +
                        '<input type="text" class="form-control email"   value="' + data.email + '" placeholder="">' +
                        '</div> </div>' +

                        ' <div class="form-group row">' +
                        '<label class="col-sm-4 form-control-label">Telefon-1 </label>' +
                        '<div class="col-sm-8">' +
                        '<input type="text" class="form-control telno1"  value="' + data.telno1 + ' " placeholder="">' +
                        '</div>  </div>' +


                        '<div class="form-group row">' +
                        '<label class="col-sm-4 form-control-label">Telefon-2 </label>' +
                        '<div class="col-sm-8">' +
                        '<input type="text" class="form-control telno2" value="' + data.telno2 + '" placeholder="">' +
                        '</div>  </div>' +

                        ' <div class="form-group row">' +
                        '<label class="col-sm-4 form-control-label">Adres </label>' +
                        '<div class="col-sm-8">' +
                        '<input type="text" class="form-control adres"  value="' + data.adres + ' " placeholder="">' +
                        '</div>  </div>' +

                        ' <div class="form-group row">' +
                        '<label class="col-sm-4 form-control-label">Link</label>' +
                        '<div class="col-sm-8">' +
                        '<input type="text" class="form-control link"  value="' + data.link + ' " placeholder="">' +
                        '</div> </div>' +
                        '<div class="form-group row ">' +
                        '<label class="col-sm-4 form-control-label">Durum:</label>' +
                        '<div class="col-md-8">' +
                        '<div class="onoffswitch">' +
                        '<input type="checkbox" name="onoffswitch[]" class="onoffswitch-checkbox" id="myonoffswitch"' +
                        (data.isAktif == 1 ?
                                "checked" : ''

                        ) +


                        '>' +
                        '  <label class="onoffswitch-label" for="myonoffswitch">' +
                        ' <span class="onoffswitch-inner"></span>' +
                        ' <span class="onoffswitch-switch"></span>' +
                        '</label>' +
                        '</div>' +
                        '</div></div>' +
                        ' <div class="form-group row">' +
                        ' <label class="form-control-label col-sm-4">Görsel</label>' +
                        '<div class="col-sm-8">' +
                        '<div class="col-sm-8 row">' +
                        '<p class="btn btn-info form-control midia-toggle" data-input="my-file">Dosya Seç</p>' +
                        ' <p class="image-del"><i class="fa fa-times" aria-hidden="true"></i></p>' +
                        '</div>' +
                        ' <img id="preview" class="img-fluid" src="' + data.foto_ad + '" alt="">' +
                        ' <input type="hidden" class="form-control foto_ad" name="image" id="my-file">' +
                        '   <input type="hidden" class="form-control" name="last_image" value="' + data.foto_ad + '" id="last-my-file">' +
                        ' <script>' +

                        '$(".midia-toggle").midia({' +
                        'base_url: "{{url("/")}}",' +
                        'directory_name: "sube" ' +
                        '});' +
                        '            <\/script>' +
                        '</div>' + '</div>' +

                        ' <script>' +
'  $("#myonoffswitch").on(\'change\', function () {\n' +
                        '                if ($(this).is(\':checked\')) {\n' +
                        '                    $(this).attr(\'value\', \'true\');\n' +
                        '                } else {\n' +
                        '                    $(this).attr(\'value\', \'false\');\n' +
                        '                    $("#myonoffswitch").prepend(\'<input type="hidden" name=onoffswitch[] value="false"></input>\')\n' +
                        '                }\n' +
                        '            });'+
                        '<\/script>' +
                        '</form>',

                    buttons: {
                        formSubmit: {
                            text: 'Güncelle',
                            btnClass: 'btn-blue',
                            action: function () {

                                var id = this.$content.find('.id').val();
                                var ad = this.$content.find('.ad').val();
                                var email = this.$content.find('.email').val();
                                var telno1 = this.$content.find('.telno1').val();
                                var telno2 = this.$content.find('.telno2').val();

                                var adres = this.$content.find('.adres').val();
                                var link = this.$content.find('.link').val();
                                var foto_ad = this.$content.find('#my-file').val();
                                var isAktif = this.$content.find('#myonoffswitch').val();

                                if (ad != "") {
                                    $.post('{{url('/yonetim/sube/update')}}', {
                                        id: id,
                                        ad: ad,
                                        email: email,
                                        telno1: telno1,
                                        telno2: telno2,
                                        adres: adres,
                                        link: link,
                                        foto_ad: foto_ad,
                                        isAktif: isAktif,


                                        _token: '{{csrf_token()}}'
                                    }, function (ret) {
                                        if (ret.ret == 1) {

                                            $.confirm({
                                                title: 'Bilgi',

                                                type: 'dark',
                                                icon: 'fa fa-info-circle',
                                                content: 'Şube güncellendi.',
                                                buttons: {
                                                    formSubmit: {
                                                        text: 'Tamam',
                                                        btnClass: 'btn',

                                                        action: function () {
                                                            window.location.reload()
                                                        }
                                                    },

                                                },
                                            });

                                        } else {
                                            $.dialog({
                                                title: 'Hata!',
                                                content: ret.message,
                                            });
                                            return false;
                                        }
                                    }, "json");
                                } else {
                                    $.dialog({
                                        title: 'Hata!',
                                        content: 'Boş değer girilemez!',
                                    });
                                    return false;
                                }
                            }
                        },
                        cancel: {
                            text: 'Kapat',
                            action: function () {
                            }
                        }
                    },
                });
            } else {
                $.dialog({
                    title: 'Hata!',
                    content: 'Veri bulunamadı',
                });
            }
        }, "json");
    }

    function department_delete(data_id) {

        $.confirm({

            type: 'red',
            typeAnimated: true,
            icon: 'fa fa-trash',
            title: 'Uyarı!',
            content: 'Şubeyi silmek istiyor musunuz?',

            buttons: {
                formSubmit: {
                    text: 'Sil',
                    btnClass: 'btn-red',
                    action: function () {

                        var name = this.$content.find('.name').val();
                        var tid = data_id;
                        var ajaxurl = "{{url('yonetim/sube/delete')}}";
                        var token = ' {{csrf_token()}}';
                        console.log(ajaxurl);
                        $.post(ajaxurl, {
                            _token: token,
                            tid: tid
                        }, function (ret) {

                            if (ret == 1) {

                                $.confirm({
                                    title: 'Bilgi',

                                    type: 'red',
                                    icon: 'fa fa-info-circle',
                                    content: 'Şube silindi!',
                                    buttons: {
                                        formSubmit: {
                                            text: 'Tamam',
                                            btnClass: 'btn-red',

                                            action: function () {
                                                window.location.reload()
                                            }
                                        },
                                    },
                                });

                            } else {
                                $.alert("Ters giden bir şey oldu. Lütfen tekrar deneyin.")
                            }
                        });
                    }
                },
                İptal: function () {
                    //close
                },
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    }


</script>

@endsection

