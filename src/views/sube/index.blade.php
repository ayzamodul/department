@extends('yonetim.layouts.master')
@section('title','Şube Listele')
@section('content')
    <style>
        .jconfirm .jconfirm-box div.jconfirm-content-pane .jconfirm-content img {
            max-width: 100%;
            height: 250px;
        }
    </style>
    <header class="page-header" style="width: 110%;margin-left: -5%">
        <div class="row-fluid">
            <h2 class="no-margin-bottom" id="h2" style="margin-left: 2%">&nbsp; Şube Yönetimi</h2>
        </div>
    </header>
    <section>


        <div class="card" style="background-color: white" id="deneme">


            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Şube Bulunan İller</h3>
            </div>
            <div class="card-body row-list-table">


                <div class="table-responsive">
                    <table class="responsive table table-hover table-bordered" id="myTab" style="width: 100%">
                        <thead class="thead-dark">
                        <tr>
                            <th>id</th>
                            <th>Şube Adı</th>
                            @can('sube-ekleDuzenle')
                                <th>İşlem</th>
                            @endcan
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($il as $iller)
                            @if(isset($iller->sube[0]))
                                <tr>

                                    <td style="width: 50px">{{ $iller->id }}</td>
                                    <td>{{ $iller->ad }}<strong>({{$iller->sube->count()}})</strong></td>
                                    @can('sube-ekleDuzenle')
                                        <td style="width: 80px">
                                            <a href="{{ route('sube.show', $iller->id) }}"
                                               class="btn btn-warning "><font color="white"> <i class="fas fa-cog"></i></font></a>
                                        </td>
                                    @endcan
                                </tr>
                            @endif
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

        </div>

        @endsection
        @section('footer')
            <script>
                $(document).ready(function () {
                    $('#myTab').DataTable({
                        "order": [[ 1, "asc" ]],
                        "language": {
                            "url": "https://cdn.datatables.net/plug-ins/a5734b29083/i18n/Turkish.json"
                        },
                        resposive: true,
                        
                    });
                });
            </script>
    </section>

@endsection
