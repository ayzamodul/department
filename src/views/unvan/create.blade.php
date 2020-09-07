@extends('yonetim.layouts.master')
@section('title','Şube | Personel Ekle')
@section('content')
    <header class="page-header" style="width: 110%;margin-left: -5%">
        <div class="row-fluid" >
            <h2 class="no-margin-bottom"  id="h2" style="margin-left: 2%" >&nbsp; Şube Yönetimi</h2>
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
    <form method="post" action="{{route('unvan.create')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div id="unvan" style="display: none" class="row">

            <div id="perContainer">
                {{ csrf_field() }}

                <section class="animated fadeInUp">
                    <div class="panel panel-footer">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <h1 class="text-center">Ünvan Yönetimi
                                    <a href="{{route('unvan.show')}}" class="btn btn-info pull-right">Tüm Unvanlar</a>
                                </h1>
                            </tr>
                            <tr>
                                <th>Unvan bilgileri</th>

                            </tr>
                            </thead>

                            <tbody>

                            <tr>
                                <td><input placeholder="Unvan Adı" type="text" name="ad" class="form-control"
                                           required=""></td>

                            </tr>

                            </tbody>
                            <td><input type="submit" name="" value="Kaydı Tamamla" class="btn btn-success pull-right" required>
                            </td>

                        </table>
                    </div>
                </section>
            </div>


        </div>
    </form>

@endsection
