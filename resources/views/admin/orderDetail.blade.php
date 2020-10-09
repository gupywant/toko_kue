@extends('/admin/app/app')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Order Detail</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
                </ol>
              </nav>
            </div>
            <div class="col-xl-12 order-xl-1">
	          <div class="card">
	            <!-- Light table -->
	            <div class="table-responsive">
	              <table class="table align-items-center table-flush" id="myTable">
	                <thead class="thead-light">
	                  <tr>
	                    <th scope="col" class="sort" data-sort="name">No</th>
	                    <th scope="col" class="sort" data-sort="budget">Nama Kue</th>
	                    <th scope="col">Jumlah</th>
	                    <th scope="col">Total Bayar</th>
	                  </tr>
	                </thead>
						<tbody class="list">
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
	            <!-- Card footer -->
	            <div class="card-footer py-4">
	            </div>
	          </div>
	        </div>
          </div>
        </div>
      </div>
    </div>
@endsection