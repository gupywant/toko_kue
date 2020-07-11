@extends('/admin/app/app')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">List Kue</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Kue</a></li>
                  <li class="breadcrumb-item active" aria-current="page">List Kue</li>
                </ol>
              </nav>
            </div>
            <div class="col-xl-12 order-xl-1">
	          <div class="card">
	            <!-- Card header -->
	            <div class="card-header border-0">
	              <h3 class="mb-0">List Kue</h3>
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
	                    <th scope="col" class="sort" width="20%" data-sort="status">Gambar</th>
	                    <th scope="col" class="sort" data-sort="budget">Nama Kue</th>
	                    <th scope="col">Jenis Kue</th>
	                    <th scope="col" class="sort" data-sort="completion">Lama PO</th>
	                    <th scope="col" class="sort" data-sort="completion">Harga</th>
	                    <th scope="col">Aksi</th>
	                  </tr>
	                </thead>
	                <tbody class="list">
	                @php
	                	$no = 1;
	                @endphp
	               	@foreach($kue as $key => $data)
	               	<!-- Modal -->
					<div class="modal fade" id="Modal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Booking No {{substr(md5($data->id_booking),0,10)}}/ID{{$data->id_booking}}</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        	{{csrf_field()}}
					        	<div class="row">
				                    <div class="col-lg-12">
				                    	<form action="{{--route('user.statusUpdate',$data->id_booking)--}}" method="post">
				                       	<div class="form-group">
				                       		{{csrf_field()}}
				                       		<label class="form-control-label" for="input-last-name">Status</label>
											<div class="input-group">
											    <select class="form-control" name="status">
											    	<option value="1" @if($data->status==1) selected @endif>Requesting</option>
											    	<option value="2" @if($data->status==2) selected @endif>Reserved</option>
											    	<option value="3" @if($data->status==3) selected @endif>Rejected</option>
											    </select>
											</div>
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
					</div>
					<!-- end of modal -->
	                  <tr>
	                    <th scope="row">
	                      {{$no++}}
	                    </th>
	                    <td class="budget">
	                      	@if(!empty($data->gambar))
	                    		<img width="60%" src="{{URL::asset('/filesdat')}}/{{$data->id_kue}}{{'/'.$data->gambar}}">
	                    	@else
	                    		<img width="60%" src="{{URL::asset('/filesdat/default/default_photo.png')}}">
	                    	@endif
	                    </td>
	                    <td>
	                      {{$data->nama}}
	                    </td>
	                    <td>
	                      {{$data->nama_jenis}}
	                    </td>
	                    <td>
	                      {{$data->waktu_po}}
	                    </td>
	                    <td>
	                    	{{number_format($data->harga,0,'.',',')}}
	                    </td>
	                    <td class="text-left">
	                      <div class="dropdown">
	                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                          	<i class="fas fa-ellipsis-v"></i>
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
	                        	<a class="dropdown-item" href="{{route('admin.kueEdit',$data->id_kue)}}">Edit/Detail</a>
	                          	<a class="dropdown-item" href="{{route('admin.kueHapus',$data->id_kue)}}">Delete</a>
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