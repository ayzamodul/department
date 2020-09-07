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

    <div class="row">
        <form>
            <div class="panel panel-footer">
                <table class="table table-bordered">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">

                                <label for="kategori_ad">Ekle</label>
                                <tbody>
                                <tr>
                                    <td>
                                        <select name="kategori_id" id="kategori_id" class="form-control"
                                                onchange="kontrol(this.selectedIndex)">
                                            <option value="0">-Yapılacak işlemi seçiniz-</option>

                                            <option value="2">Personel Ekle</option>
                                            <option value="1">Şube Ekle</option>
                                            <option value="3">Unvan Ekle</option>

                                        </select>

                                    <th><a href="{{ route('sube.tumSubeler') }}" id="subeListele"><i
                                                class="btn btn-info">Subeleri Listele</i></a></th>


                                    </td>
                                </tr>
                                </tbody>

                            </div>
                        </div>
                    </div>
                </table>
            </div>
        </form>
    </div>


    <script>
        function kontrol($index) {

            if ($index === 0) {
                document.getElementById("sube").style.display = "none";
                document.getElementById("personel").style.display = "none";
                document.getElementById("unvan").style.display = "none";

            } else if ($index === 1) {
                document.getElementById("sube").style.display = "none";
                document.getElementById("personel").style.display = "block";
                document.getElementById("unvan").style.display = "none";

            } else if ($index === 2) {
                document.getElementById("sube").style.display = "block";
                document.getElementById("personel").style.display = "none";
                document.getElementById("unvan").style.display = "none";

            } else if ($index === 3) {
                document.getElementById("unvan").style.display = "block";
                document.getElementById("sube").style.display = "none";
                document.getElementById("personel").style.display = "none";
            }
        }
    </script>


    <script language="javascript" type="text/javascript">
        iller = @json($iller)

        window.addEventListener("load", function () {
            document.getElementById("add").addEventListener("click", function () {
                // Create a div

                var div = document.createElement("div");
                div.setAttribute("class", "row");

                var form = document.createElement("form");


                var th = document.createElement("th");
                th.append("Şube Bilgileri");

                var section = document.createElement("section");
                div.appendChild(section);

                var div1 = document.createElement("div");
                div1.setAttribute("class", "panel panel-footer");
                section.appendChild(div1);

                var table = document.createElement("table");
                table.setAttribute("class", "table table-bordered");
                div1.appendChild(table);
                //// tbody başlangıç

                var tbody = document.createElement("tbody");
                table.appendChild(tbody);
                var thSelect = document.createElement("select");
                thSelect.setAttribute("name", "ils_id[]");
                thSelect.setAttribute("id", "ils_id");
                thSelect.setAttribute("class", "form-control");
                tbody.appendChild(thSelect);
                for (var i = 0; i < iller.length; i++) {
                    var option = document.createElement("option");
                    option.text = iller[i].ad;
                    option.value = iller[i].id;
                    thSelect.appendChild(option);
                    //   console.log(option);
                }


                var tr1 = document.createElement("tr");
                tbody.appendChild(tr1);
                var td1 = document.createElement("td");
                tr1.appendChild(td1);
                var input1 = document.createElement("input");
                input1.setAttribute("placeholder", "ad");
                input1.setAttribute("type", "text");
                input1.setAttribute("name", "ads[]");
                input1.setAttribute("required", "");
                input1.setAttribute("class", "form-control");
                td1.appendChild(input1);

                var tr2 = document.createElement("tr");
                tbody.appendChild(tr2);
                var td2 = document.createElement("td");
                tr2.appendChild(td2);
                var input2 = document.createElement("input");
                input2.setAttribute("placeholder", "adres");
                input2.setAttribute("type", "text");
                input2.setAttribute("name", "adress[]");
                input2.setAttribute("required", "");
                input2.setAttribute("class", "form-control");
                td2.appendChild(input2);

                var tr3 = document.createElement("tr");
                tbody.appendChild(tr3);
                var td3 = document.createElement("td");
                tr3.appendChild(td3);
                var input3 = document.createElement("input");
                input3.setAttribute("placeholder", "email");
                input3.setAttribute("type", "text");
                input3.setAttribute("name", "emails[]");
                input3.setAttribute("required", "");
                input3.setAttribute("class", "form-control");
                td3.appendChild(input3);

                var tr4 = document.createElement("tr");
                tbody.appendChild(tr4);
                var td4 = document.createElement("td");
                tr4.appendChild(td4);
                var input4 = document.createElement("input");
                input4.setAttribute("placeholder", "Telno");
                input4.setAttribute("type", "text");
                input4.setAttribute("name", "telno1s[]");
                input4.setAttribute("required", "");
                input4.setAttribute("class", "form-control");
                td4.appendChild(input4);

                var tr5 = document.createElement("tr");
                tbody.appendChild(tr5);
                var td5 = document.createElement("td");
                tr5.appendChild(td5);
                var input5 = document.createElement("input");
                input5.setAttribute("placeholder", "Telno 2");
                input5.setAttribute("type", "text");
                input5.setAttribute("name", "telno2s[]");
                input5.setAttribute("required", "");
                input5.setAttribute("class", "form-control");
                td5.appendChild(input5);

                var tr6 = document.createElement("tr");
                tbody.appendChild(tr6);
                var td6 = document.createElement("td");
                tr6.appendChild(td6);
                var input6 = document.createElement("input");
                input6.setAttribute("placeholder", "Harita");
                input6.setAttribute("type", "text");
                input6.setAttribute("name", "haritas[]");
                input6.setAttribute("required", "");
                input6.setAttribute("class", "form-control");
                td6.appendChild(input6);

                var tr7 = document.createElement("tr");
                tbody.appendChild(tr7);
                var td7 = document.createElement("td");
                tr7.appendChild(td7);
                var input7 = document.createElement("input");
                input7.setAttribute("placeholder", "link");
                input7.setAttribute("type", "text");
                input7.setAttribute("name", "links[]");
                input7.setAttribute("required", "");
                input7.setAttribute("class", "form-control");
                td7.appendChild(input7);

                var tr8 = document.createElement("tr");
                tbody.appendChild(tr8);
                var td8 = document.createElement("td");
                tr8.appendChild(td8);
                var label1 = document.createElement("label");
                label1.append("Resim Seç");
                td8.appendChild(label1);

                var resim = document.createElement("input");
                resim.setAttribute("type", "file");
                resim.setAttribute("name", "foto_ads[]");
                td8.appendChild(resim);

                var tfoot = document.createElement("tfoot");
                table.appendChild(tfoot);

                var tr9 = document.createElement("tr");
                tfoot.appendChild(tr9);
                var td9 = document.createElement("td");
                tr9.appendChild(td9);
                var a9 = document.createElement("a");
                a9.setAttribute("href", "#");
                a9.setAttribute("class", "btn btn-danger remove");
                a9.append("sil");

                td9.appendChild(a9);


                div.appendChild(th);
                div.appendChild(form);

                //Append the div to the container div
                document.getElementById("row").appendChild(div);
                $(a9).on("click",function(){
                    $(div).remove();
                });
            });

        });



    </script>
    <script language="javascript" type="text/javascript">
        unvanlar = {!! $unvanlar !!}
            iller = @json($iller)

        window.addEventListener("load", function () {

            document.getElementById("persEkle").addEventListener("click", function () {
                // Create a div
                var div = document.createElement("div");
                div.setAttribute("class", "row");


                var th = document.createElement("th");
                th.append("Personel Bilgileri");

                var section = document.createElement("section");
                div.appendChild(section);

                var div1 = document.createElement("div");
                div1.setAttribute("class", "panel panel-footer");
                section.appendChild(div1);

                var table = document.createElement("table");
                table.setAttribute("class", "table table-bordered");
                div1.appendChild(table);
                //// tbody başlangıç

                var tbody = document.createElement("tbody");
                table.appendChild(tbody);

                var lblSel = document.createElement("label");
                lblSel.append("il");
                lblSel.setAttribute("for", "ad");
                tbody.appendChild(lblSel);

                var thSelect = document.createElement("select");
                thSelect.setAttribute("name", "il_id[]");
                thSelect.setAttribute("id", "il_id");
                thSelect.setAttribute("onchange", "$.verigonder(value,this)")
                thSelect.setAttribute("class", "form-control");
                tbody.appendChild(thSelect);
                var opt = document.createElement("option");
                opt.text = "- İl Seçiniz -";
                opt.value = 0;
                thSelect.appendChild(opt);

                for (var i = 0; i < iller.length; i++) {
                    var option = document.createElement("option");
                    option.text = iller[i].ad;
                    option.value = iller[i].id;
                    thSelect.appendChild(option);
                    // console.log(option);
                }

                var lblSube = document.createElement("label");
                lblSube.append("sube");
                lblSube.setAttribute("for", "ad");
                tbody.appendChild(lblSube);

                var thSelSube = document.createElement("select");

                thSelSube.setAttribute("name", "sube_id[]");
                thSelSube.setAttribute("id", "sube_id");
                thSelSube.setAttribute("class", "form-control");
                tbody.appendChild(thSelSube);

                var opt = document.createElement("option");
                opt.text = "- Şube Seçiniz -";
                opt.value = 0;
                thSelSube.appendChild(opt);
                //////////////buraya yapılacak


                var lblSel1 = document.createElement("label");
                lblSel1.append("Unvan");
                lblSel1.setAttribute("for", "ad");
                tbody.appendChild(lblSel1);

                var thSelect1 = document.createElement("select");
                thSelect1.setAttribute("name", "unvan_id[]");
                thSelect1.setAttribute("id", "unvan_id");
                thSelect1.setAttribute("class", "form-control");
                tbody.appendChild(thSelect1);
                var opt2 = document.createElement("option");
                opt2.text = "- Ünvan Seçiniz -";
                opt2.value = 0;
                thSelect1.appendChild(opt2);

                for (var i = 0; i < unvanlar.length; i++) {
                    var option2 = document.createElement("option");
                    option2.text = unvanlar[i].unvan;
                    option2.value = unvanlar[i].id;
                    thSelect1.appendChild(option2);
                    // console.log(option);
                }

                /////////////////
                var tr1 = document.createElement("tr");
                tbody.appendChild(tr1);
                var td1 = document.createElement("td");
                tr1.appendChild(td1);

                var input1 = document.createElement("input");
                input1.setAttribute("placeholder", "ad");
                input1.setAttribute("type", "text");
                input1.setAttribute("name", "ad[]");
                input1.setAttribute("required", "");
                input1.setAttribute("class", "form-control");
                td1.appendChild(input1);

                var tr2 = document.createElement("tr");
                tbody.appendChild(tr2);
                var td2 = document.createElement("td");
                tr2.appendChild(td2);
                var input2 = document.createElement("input");
                input2.setAttribute("placeholder", "soyad");
                input2.setAttribute("type", "text");
                input2.setAttribute("name", "soyad[]");
                input2.setAttribute("required", "");
                input2.setAttribute("class", "form-control");
                td2.appendChild(input2);

                var tr3 = document.createElement("tr");
                tbody.appendChild(tr3);
                var td3 = document.createElement("td");
                tr3.appendChild(td3);
                var input3 = document.createElement("input");
                input3.setAttribute("placeholder", "email");
                input3.setAttribute("type", "text");
                input3.setAttribute("name", "email[]");
                input3.setAttribute("required", "");
                input3.setAttribute("class", "form-control");
                td3.appendChild(input3);

                var tr4 = document.createElement("tr");
                tbody.appendChild(tr4);
                var td4 = document.createElement("td");
                tr4.appendChild(td4);
                var input4 = document.createElement("input");
                input4.setAttribute("placeholder", "Telno");
                input4.setAttribute("type", "text");
                input4.setAttribute("name", "telno[]");
                input4.setAttribute("required", "");
                input4.setAttribute("class", "form-control");
                td4.appendChild(input4);

                var tr5 = document.createElement("tr");
                tbody.appendChild(tr5);
                var td5 = document.createElement("td");
                tr5.appendChild(td5);
                var input5 = document.createElement("input");
                input5.setAttribute("placeholder", "password");
                input5.setAttribute("type", "text");
                input5.setAttribute("name", "password[]");
                input5.setAttribute("required", "");
                input5.setAttribute("class", "form-control");
                td5.appendChild(input5);

                var tr6 = document.createElement("tr");
                tbody.appendChild(tr6);
                var td6 = document.createElement("td");
                tr6.appendChild(td6);


                var tr8 = document.createElement("tr");
                tbody.appendChild(tr8);
                var td8 = document.createElement("td");
                tr8.appendChild(td8);
                var label1 = document.createElement("label");
                label1.append("Resim Seç");
                td8.appendChild(label1);

                var resim = document.createElement("input");
                resim.setAttribute("type", "file");
                resim.setAttribute("name", "foto_ad[]");
                td8.appendChild(resim);

                var tfoot = document.createElement("tfoot");
                table.appendChild(tfoot);

                var tr9 = document.createElement("tr");
                tfoot.appendChild(tr9);
                var td9 = document.createElement("td");
                tr9.appendChild(td9);
                var a9 = document.createElement("a");
                a9.setAttribute("href", "#");
                a9.setAttribute("class", "btn btn-danger remove");
                a9.append("sil");

                td9.appendChild(a9);


                //Append the div to the container div
                document.getElementById("perContainer").append(div);
                $(a9).on("click",function(){
                    $(div).remove();
                });
            });
        });


    </script>

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

    <script language="JavaScript" type="text/javascript">
        $(document).ready(function () {
            $.verigonder = function (kategoriId, this_item) {
                //önemli burası  .
                console.log(kategoriId);
                var it = $(this_item).parent().find('#sube_id');
                it.html("");
                //$(this_item).hide();
                let url = '/yonetim/sube/subeList/' + kategoriId;
                $.get(url, function (data) {
                    console.log(data);
                    $.each(data, function (k, v) {
                        it.prepend('<option value="' + v.id + '">' + v.ad + '</option>');

                    });
                });
            }
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
