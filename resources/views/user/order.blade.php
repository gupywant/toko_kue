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
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-order" aria-selected="true">Dalam Pesanan</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-proses" role="tab" aria-controls="nav-proses" aria-selected="false">Dalam Proses</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-finish" role="tab" aria-controls="nav-finish" aria-selected="false">Selesai</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" style="margin: 20px;">
                    <table class="table table-hover" id="myTable">
                      <thead>
                        <tr>
                          <th>Nama Kue</th>
                          <th>No VA</th>
                          <th>Harga</th>
                          <th>Jumlah</th>
                          <th>Detail</th>
                          <th>Waktu PO</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($inorder as $data)
                        <tr>
                          <td><a href="{{route('user.home')}}?kat={{$data->id_jenis}}" style="a:link {text-decoration: none;}">{{$data->nama}}</a></td>
                          <td>{{$data->kode}}</td>
                          <td>{{number_format($data->total),0,',','.'}}</td>
                          <td align="center">{{number_format($data->jumlah),0,'.',','}}</td>
                          <td><a href="{{route('user.orderDetail',$data->id_order)}}">Klick untuk Detail</a></td>
                          <td align="center">{{$data->waktu}} Hari</td>
                          <td>
                            @if($data->status==0)
                              <span class="badge badge-warning">Belum bayar</span>
                            @else
                              <span class="badge badge-success">Sudah Bayar</span>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="nav-proses" role="tabpanel" aria-labelledby="nav-profile-tab" style="margin: 20px;">
                    <table class="table table-hover" id="myTable1">
                      <thead>
                        <tr>
                          <th>Nama Kue</th>
                          <th>No VA</th>
                          <th>Harga</th>
                          <th>Jumlah</th>
                          <th>Detail</th>
                          <th>Waktu PO</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($onproses as $data)
                        <tr>
                          <td><a href="{{route('user.home')}}?kat={{$data->id_jenis}}" style="a:link {text-decoration: none;}">{{$data->nama}}</a></td>
                          <td>{{$data->kode}}</td>
                          <td>{{number_format($data->total),0,',','.'}}</td>
                          <td align="center">{{number_format($data->jumlah),0,'.',','}}</td>
                          <td><a href="{{route('user.orderDetail',$data->id_order)}}">Klick untuk Detail</a></td>
                          <td align="center">{{$data->waktu}} Hari</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="nav-finish" role="tabpanel" aria-labelledby="nav-profile-tab" style="margin: 20px;">
                    <table class="table table-hover" id="myTable2">
                      <thead>
                        <tr>
                          <th>Nama Kue</th>
                          <th>No VA</th>
                          <th>Harga</th>
                          <th>Jumlah</th>
                          <th>Detail</th>
                          <th>Waktu PO</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($finish as $data)
                        <tr>
                          <td><a href="{{route('user.home')}}?kat={{$data->id_jenis}}" style="a:link {text-decoration: none;}">{{$data->nama}}</a></td>
                          <td>{{$data->kode}}</td>
                          <td>{{number_format($data->total),0,',','.'}}</td>
                          <td align="center">{{number_format($data->jumlah),0,'.',','}}</td>
                          <td><a href="{{route('user.orderDetail',$data->id_order)}}">Klick untuk Detail</a></td>
                          <td align="center">{{$data->waktu}} Hari</td>
                        </tr>
                        @endforeach
                      </tbody>
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