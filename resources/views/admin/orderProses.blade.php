@extends('/admin/app/app')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Order Proses</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Order Proses</li>
                </ol>
              </nav>
            </div>
            <div class="col-xl-12 order-xl-1">
	          <div class="card">
	            <!-- Card header -->
	            <div class="card-header border-0">
	              <h3 class="mb-0">Order Proses</h3>
	              	<div class="row">
	            		<div class="col-sm-12">
	            			@if(session('message'))
				            <div class="card-header bg-transparent pb-2">
				              <div class="alert alert-success">
				                <strong>Sukses!</strong> {!!session('message')!!}.
				              </div>
				            </div>
				            @endif
				            @if(session('alert'))
				            <div class="card-header bg-transparent pb-2">
				              <div class="alert alert-danger">
				                <strong>Gagal!</strong> {!!session('alert')!!}.
				              </div>
				            </div>
				            @endif
	            		</div>
	            	</div>
	            </div>
	            <!-- Light table -->
	            <div class="table-responsive">
	              <table class="table align-items-center table-flush" id="myTable">
	                <thead class="thead-light">
	                  <tr>
	                    <th scope="col" class="sort" data-sort="name">No</th>
	                    <th scope="col" class="sort" width="20%" data-sort="status">Email Pembeli</th>
	                    <th scope="col" class="sort" width="20%" data-sort="status">Nama Pembeli</th>
	                    <th scope="col" class="sort" data-sort="budget">Nama Kue</th>
	                    <th scope="col">Jumlah</th>
	                    <th scope="col" class="sort" data-sort="completion">Tanggal Pesan</th>
	                    <th scope="col" class="sort" data-sort="completion">Tanggal PO</th>
	                    <th scope="col" class="sort" width="20%" data-sort="status">Kode Bayar</th>
	                    <th scope="col">Total Bayar</th>
	                    <th scope="col">Aksi</th>
	                  </tr>
	                </thead>
	                <tbody class="list">
	                @php
	                	$no = 1;
	                @endphp
	               	@foreach($order as $key => $data)

	               	<!-- Modal -->
					<div class="modal fade" id="Modal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Order No {{substr(md5($data->id_order),0,10)}}/ID{{$data->id_order}}</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">			        	
					        <form action="{{route('admin.adminEdit',$data->id_order)}}" method="post">
					        	{{csrf_field()}}
					        	<div class="row">	        		
						            <div class="col-lg-12">
										<div class="form-group">	
										  <label class="form-control-label" for="input-last-name">Jenis</label>
										  <select name="update" class="form-control" id="sel1">
										    	<option value="1" {{$data->status == 1 ? "selected" : null}}>Baru</option>
										    	<option value="2" {{$data->status == 2 ? "selected" : null}}>Proses</option>
										    	<option value="3" {{$data->status == 3 ? "selected" : null}}>Selesai</option>
										  </select>
										</div>
						            </div>
						        </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary">Save</button>
					        </form>
					    </div>
					  </div>
					</div>
					<!-- end of modal -->
	                  <tr>
	                    <th scope="row">
	                      {{$no++}}
	                    </th>
	                    <td class="budget">
	                      	{{$data->username}}
	                    </td>
	                    <td>
	                      {{$data->nama}}
	                    </td>
	                    <td>
	                      {{$data->nama_kue}}
	                    </td>
	                    <td>
	                      {{$data->jumlah}}
	                    </td>
	                    <td>
	                      {{substr($data->created_at,0,10)}}
	                    </td>
	                    <td>
	                      {{$data->waktu_po}}
	                    </td>
	                    <td>
	                      {{$data->kode}}
	                    </td>
	                    <td>
	                    	{{number_format($data->jumlah*$data->harga,0,'.',',')}}
	                    </td>
	                    <td class="text-left">
	                      <div class="dropdown">
	                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                          	<i class="fas fa-ellipsis-v"></i>
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
	                        	<a class="dropdown-item" data-toggle="modal" data-target="#Modal{{$key}}">
							 	Update Status</a>
	                          	<a class="dropdown-item" href="{{route('admin.orderHapus',$data->id_order)}}">Delete</a>
	                        </div>
	                      </div>
	                    </td>
	                  </tr>
	                @endforeach
	                </tbody>
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