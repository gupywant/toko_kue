@extends('/user/app/app')
@section('content')
  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Orderan Anda</h2>

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
            <div class="card">
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-order" aria-selected="true">Detail Pesanan</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" style="margin: 20px;">
                    <table class="table table-hover" id="myTable">
                      <thead>
                        <tr>
                          <th>Nama Kue</th>
                          <th>Harga</th>
                          <th>Jumlah</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $total = 0;
                        @endphp
                        @foreach($order as $data)
                        <tr>
                          <td><a href="{{route('user.home')}}?kat={{$data->id_jenis}}" style="a:link {text-decoration: none;}">{{$data->nama}}</a></td>
                          <td>{{number_format($data->harga),0,',','.'}}</td>
                          <td>{{number_format($data->jumlah),0,'.',','}}</td>
                          <td>{{number_format($data->jumlah*$data->harga),0,'.',','}}</td>
                          @php
                            $total += $data->jumlah*$data->harga;
                          @endphp
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="3" align="right">Total Semua :</td>
                          <td>{{number_format($total,0,'.',',')}}</td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
          </div>


        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->
  @endsection