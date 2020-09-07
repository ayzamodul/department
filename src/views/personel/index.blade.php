@extends('yonetim.layouts.master')
@section('title', 'Personel Yönetimi | '.$setting->title)
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

    </style>
    <header class="page-header" style="width: 111%;margin-left: -5%">
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
    <section class="animated fadeIn">


        <div class="card " style="background-color: white" id="deneme">


            @can('personel-ekleDuzenle')
                <div class="" style="float: right; margin-top: 1%"><a href="{{route('personel.indexpersonel')}}"
                                                                      class="btn btn-primary">Personel Ekle</a></div>
            @endcan

            <div class="card-header d-flex align-items-center">

                <h3 class="h4">Personel Listesi</h3>

            </div>

            <div class="card-body row-list-table">


                <div class="table-responsive">
                    <table class="responsive table table-hover table-bordered" id="myTab" style="width: 100%">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Ad Soyad</th>
                            <th>İl</th>
                            <th>Şube Adı</th>
                            <th>Durum</th>

                            @can('personel-ekleDuzenle')
                                <th>Düzenle</th>
                            @endcan
                            @can('personel-sil')
                                <th>Sil</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($personel as $pers)
                            <tr>

                                <td>      @if(isset($pers->foto_ad) && $pers->foto_ad!=null)
                                        <img class="img-avatar img-avatar48"
                                             src="{{$pers->foto_ad}}" alt="">
                                    @else
                                        <img class="img-avatar img-avatar48"
                                             src="{{asset('anasayfa/assets/images/comment-1-1.png')}}" alt="">
                                    @endif
                                </td>

                                <td>{{$pers->ad}} {{$pers->soyad}}</td>

                                <td>

                                    {{$pers->sehir['ad']}}

                                </td>

                                <td>

                                    {{$pers->sube['ad']}}

                                </td>
                                <td width="30px">@if($pers->isAktif==1)
                                        <span class="label label-success label-many">Aktif</span>
                                    @else
                                        <span class="label label-warning label-many">Pasif</span>
                                    @endif
                                </td>

                                @can('personel-ekleDuzenle')
                                    <td style="width: 20px">
                                        <a onclick="$.upd_personal({{$pers->id}})" class="btn btn-xl btn-warning"
                                           data-toggle="tooltip"
                                           data-placement="top" title="Düzenle">
                                            <span class="far fa-edit"></span>
                                        </a>
                                    </td>
                                @endcan
                                @can('personel-sil')
                                    <td style="width: 70px">

                                        <a onclick="personal_delete({{$pers->id}})" type="submit" name=""

                                           class="btn btn-danger"><i class="fas fa-trash"></i></a>


                                    </td>

                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <br>
            </div>

        </div>

        @endsection
        @section('footer')


            <script>
                var as =
                    {!! $unvan !!}

                var ass =
                    {!! $subeler !!}
                var sa = {!! $iller !!}
                    $(document).ready(function () {
                        var table = $('#myTab').DataTable({


                            "language": {
                                "url": "https://cdn.datatables.net/plug-ins/a5734b29083/i18n/Turkish.json"
                            },

                            "order": [[0, "desc"]],
                            responsive: true,
                        });
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

                        $.upd_personal = function (id) {
                            $.post('{{url('/yonetim/sube/personel/edit')}}', {
                                _token: '{{csrf_token()}}',
                                id: id
                            }, function (ret) {
                                if (ret.ret == 1) {
                                    var data = ret.data;


                                    $.confirm({
                                        title: 'Güncelle',
                                        type: 'dark',
                                        icon: 'fas fa-pencil-alt',
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
                                            '<input type="password" class="form-control password"   value="" placeholder="Şifre" autocomplete="off">' +
                                            '</div></div>' +


                                            '<div class="form-group row col-sm-6">' +
                                            '<label class="col-sm-3 form-control-label">Telefon</label>' +
                                            '<div class="col-sm-9">' +
                                            '<input type="text" class="form-control telno" value="' + data.telno + '" placeholder="">' +

                                            '</div> </div>' +
                                            ' <div class="form-group row col-sm-6">' +
                                            ' <label class="form-control-label col-sm-4">Görsel</label>' +
                                            '<div class="col-sm-8">' +
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
                                            '<input type="checkbox" name="onoffswitch[]" class="onoffswitch-checkbox" value="1" id="myonoffswitch"' +
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
                                            ' <script>' +
                                            '  $("#myonoffswitch").on(\'change\', function () {\n' +
                                            '                if ($(this).is(\':checked\')) {\n' +
                                            '                    $(this).attr(\'value\', \'true\');\n' +
                                            '                } else {\n' +
                                            '                    $(this).attr(\'value\', \'false\');\n' +
                                            '                    $("#myonoffswitch").prepend(\'<input type="hidden" name=onoffswitch[] value="false"></input>\')\n' +
                                            '                }\n' +
                                            '            });' +
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
                                                    var isAktif = this.$content.find('#myonoffswitch').val();
                                                

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
                    });

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
            </script>
    </section>
@endsection

