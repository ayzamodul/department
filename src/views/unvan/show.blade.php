@extends('yonetim.layouts.master')
@section('title','Şube | Ünvan Ekle')
@section('content')
    <style>
        table td {
            background-color: white;
        }
        #deneme1 {
            width: 51%;
        }
    </style>

    <header class="page-header" style="width: 111%;margin-left: -5%">
        <div class="row-fluid">
            <h2 class="no-margin-bottom" id="h2" style="margin-left: 2%">&nbsp; Ünvan Yönetimi</h2>
        </div>
    </header>
    @if(Session::has('success'))
        <div class="alert alert-success jquery-error-alert">
            <ul>
                <li>{{Session::get('success')}}</li>
            </ul>
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger jquery-error-alert">
            <ul>
                <li>{{Session::get('error')}}</li>
            </ul>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger jquery-error-alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="animated fadeIn">

        <div class="col-lg-12">


            <div class="row card" style="background-color: white" id="">


                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Ünvanlar</h3>
                </div>
                <div class="card-body row-list-table">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-md-5 col-lg-3 add-category" id="">
                                <div class="card" style="background-color: white" id="deneme">
                                    <div>
                                        <div class="card-header d-flex align-items-center">
                                            <h5 class=""><b>Ünvan {{isset($unvanUpdate) ? 'Güncelle' : 'Ekle'}}</b></h5>
                                        </div>

                                        <div class="card-body">
                                            @if(isset($unvanUpdate))
                                                <form class="form-horizontal" method="post" action="{{route('unvan.update',@$unvanUpdate->id)}}">
                                                    {{csrf_field()}}

                                                    <div class="form-group row">
                                                        <label class="col-sm-12 form-control-label">Ünvan Adı</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" name="unvan" value="{{$unvanUpdate->unvan}}" placeholder="Ünvan" class="form-control">
                                                        </div>
                                                    </div>





                                                    <div class="line"></div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 offset-sm-6">
                                                            <button type="submit" name="insert" class="btn btn-primary">
                                                                Güncelle
                                                            </button>
                                                        </div>
                                                    </div>


                                                </form>

                                            @else
                                                <form class="form-horizontal" method="post" action="{{route('unvan.create')}}">
                                                    {{csrf_field()}}

                                                    <div class="form-group row">
                                                        <label class="col-sm-12 form-control-label">Ünvan Adı</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" name="unvan" placeholder="Ünvan" class="form-control">
                                                        </div>
                                                    </div>



                                                    <div class="line"></div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 offset-sm-7">
                                                            <button type="submit" name="insert" class="btn btn-primary">
                                                                Ekle
                                                            </button>
                                                        </div>
                                                    </div>


                                                </form>

                                            @endif



                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-9 col-12">
                                <div class="table-responsive">
                                    <table class="responsive table table-hover table-bordered" id="myTab" style="width: 100%">
                                        <thead class="thead-dark">
                                        <th>Sıra</th>
                                        <th>id</th>
                                        <th>Ünvan</th>
                                        <th>Düzenle</th>
                                        <th>Sil</th>


                                        </thead>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection
@section('footer')
    <script>
        $(document).ready(function () {
            var dttable = $('.table-responsive table').DataTable({
                "order": [[0, "asc"]],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "{{url('yonetim/sube/unvan/datatable')}}?type=cons_demo_st",
                    type: 'GET'
                },

                'columns': [
                    {data: 'sira',
                        width: "7%",
                    },
                    {data: 'id',
                        className: "text-center",
                        width: "7%",
                    },
                    {data:'unvan',
                        width: "72%",
                    },
@can('sube-ekleDuzenle')
                    {
                        width: "7%",
                        className: "text-center",
                        data: null,
                        render: function (data, type, customer) {
                            var html = "<a  class='btn btn-warning' href='{{url('/yonetim/sube/unvan/edit')}}/" + data.id + "'><i class='far fa-edit' aria-hidden='true'></i></a>";

                            return html;
                        },
                        "searchable": false,
                        "orderable": false,
                    },
                        @endcan
                        @can('sube-sil')
                    {
                            width: "7%",
                            className: "text-center",
                        data: null,
                        render: function (data) {

                            return '<a class="btn btn-danger"  onclick="$.unvan_delete(' + data.id + ')"><i class="fa fa-trash" aria-hidden="true" style="color: white"></i></a>'
                        },
                        "searchable": false, "orderable": false
                    },
                    @endcan
                    //{data: 'postMD.seo_title', name: 'postMD.seo_title',            "defaultContent": "", "searchable": false, "targets": 0}

                ],
                rowReorder: {
                    dataSrc: 'sira'
                },
                scrollY: 400,
                paging: false,
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/a5734b29083/i18n/Turkish.json"
                }
            });

            dttable.on('row-reorder', function (e, diff, edit) {
                console.log(diff);
                for (var i = 0, ien = diff.length; i < ien; i++) {
                    var rowData = dttable.row(diff[i].node).data(),
                        data_id = rowData.id,
                        sira = diff[i].newPosition;

                    $.post("{{url('yonetim/sube/unvan/ajax')}}", {
                        _token: '{{csrf_token()}}',
                        type: 'unvan',
                        data_id: data_id,
                        sira: sira
                    }, function (ret) {

                    });

                }
            });
            $.unvan_delete = function(data_id) {

                $.confirm({

                    type: 'red',
                    typeAnimated: true,
                    icon: 'fa fa-trash',
                    title: 'Uyarı!',
                    content: 'Ünvanı silmek istiyor musunuz?',

                    buttons: {
                        formSubmit: {
                            text: 'Sil',
                            btnClass: 'btn-red',
                            action: function () {

                                var name = this.$content.find('.name').val();
                                var tid = data_id;
                                var ajaxurl = "{{url('/yonetim/sube/unvan/delete')}}";
                                var token = ' {{csrf_token()}}';
                                console.log(ajaxurl);
                                $.post(ajaxurl, {
                                    _token: token,
                                    tid: tid
                                }, function (ret) {

                                    if (ret == 1) {
                                        dttable.ajax.reload()
                                        $.confirm({
                                            title: 'Bilgi',

                                            type: 'red',
                                            icon: 'fa fa-info-circle',
                                            content: 'Ünvan silindi!',
                                            buttons: {
                                                formSubmit: {
                                                    text: 'Tamam',
                                                    btnClass: 'btn-red',

                                                    action: function () {

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
        });

    </script>

@endsection
