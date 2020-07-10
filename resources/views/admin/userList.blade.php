@extends('/admin/app/app')
@section('content')
	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.userTambah')}}" method="post">
        	{{csrf_field()}}
        	<div class="row">
	            <div class="col-lg-6">
	            	<div class="form-group">
	            		<label class="form-control-label" for="input-last-name">Nama user</label>
						<input type="text" name="nama" id="input-username" class="form-control" placeholder="Nama user" required="">
					</div>
	            </div>
	            <div class="col-lg-6">
	            	<div class="form-group">
	            		<label class="form-control-label" for="input-last-name">Email</label>
						<input type="text" name="username" id="input-username" class="form-control" placeholder="Email user" required="">
					</div>
	            </div>
	            <div class="col-lg-12">
	            	<div class="form-group">
	            		<label class="form-control-label" for="input-last-name">Alamat</label>
						<input type="text" name="alamat" id="input-username" class="form-control" placeholder="Alamat user" required="">
					</div>
	            </div>
	            <div class="col-lg-6">
	            	<div class="form-group">
	            		<label class="form-control-label" for="input-last-name">Kota</label>
						<input type="text" name="kota" id="input-username" class="form-control" placeholder="Kota" required="">
					</div>
	            </div>
	            <div class="col-lg-6">
	            	<div class="form-group">
	            		<label class="form-control-label" for="input-last-name">Provinsi</label>
						<input type="text" name="provinsi" id="input-username" class="form-control" placeholder="Provinsi" required="">
					</div>
	            </div>
	            <div class="col-lg-6">
	            	<div class="form-group">
	            		<label class="form-control-label" for="input-last-name">Kode Pos</label>
						<input type="text" name="kode_pos" id="input-username" class="form-control" placeholder="Kode Pos" required="">
					</div>
	            </div>
	            <div class="col-lg-6">
	            	<div class="form-group">
	            		<label class="form-control-label" for="input-last-name">No Tlp</label>
						<input type="text" name="no_tlp" id="input-username" class="form-control" placeholder="No Tlp" required="">
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

    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">List user</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                  <li class="breadcrumb-item active" aria-current="page">List user</li>
                </ol>
              </nav>
            </div>
            <div class="col-xl-12 order-xl-1">
	          <div class="card">
	            <!-- Card header -->
	            <div class="card-header border-0">
	            	<div class="row">
		            	<div class="col-8">
		            		<h3 class="mb-0">List user</h3>
		                </div>
		                <div class="col-4 text-right">
		                  	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
							 	Tambah user
							</button>
		                </div>
		            </div>
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
	                    <th scope="col" class="sort" width="20%" data-sort="status">Nama</th>
	                    <th scope="col" class="sort" data-sort="budget">Email</th>
	                    <th scope="col">Aksi</th>
	                  </tr>
	                </thead>
	                <tbody class="list">
	                @php
	                	$no = 1;
	                @endphp
	               	@foreach($user as $key => $data)
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
					        <form action="{{route('admin.userEdit',$data->id_user)}}" method="post">
					        	{{csrf_field()}}
					        	<div class="row">		            
						            <div class="col-lg-6">
						            	<div class="form-group">
						            		<label class="form-control-label" for="input-last-name">Nama user</label>
											<input value="{{$data->nama}}" type="text" name="nama" id="input-username" class="form-control" placeholder="Nama user" required="">
										</div>
						            </div>
						            <div class="col-lg-6">
						            	<div class="form-group">
						            		<label  class="form-control-label" for="input-last-name">Email</label>
											<input value="{{$data->username}}" type="text" name="username" id="input-username" class="form-control" placeholder="Email user" required="">
										</div>
						            </div>
						            <div class="col-lg-12">
						            	<div class="form-group">
						            		<label class="form-control-label" for="input-last-name">Alamat</label>
											<input value="{{$data->alamat}}" type="text" name="alamat" id="input-username" class="form-control" placeholder="Alamat user" required="">
										</div>
						            </div>
						            <div class="col-lg-6">
						            	<div class="form-group">
						            		<label class="form-control-label" for="input-last-name">Kota</label>
											<input value="{{$data->kota}}" type="text" name="kota" id="input-username" class="form-control" placeholder="Kota" required="">
										</div>
						            </div>
						            <div class="col-lg-6">
						            	<div class="form-group">
						            		<label class="form-control-label" for="input-last-name">Provinsi</label>
											<input value="{{$data->provinsi}}" type="text" name="provinsi" id="input-username" class="form-control" placeholder="Provinsi" required="">
										</div>
						            </div>
						            <div class="col-lg-6">
						            	<div class="form-group">
						            		<label class="form-control-label" for="input-last-name">Kode Pos</label>
											<input value="{{$data->kode_pos}}" type="text" name="kode_pos" id="input-username" class="form-control" placeholder="Kode Pos" required="">
										</div>
						            </div>
						            <div class="col-lg-6">
						            	<div class="form-group">
						            		<label class="form-control-label" for="input-last-name">No Tlp</label>
											<input value="{{$data->no_tlp}}" type="text" name="no_tlp" id="input-username" class="form-control" placeholder="No Tlp" required="">
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
	                    <td>
	                      {{$data->nama}}
	                    </td>
	                    <td>
	                      {{$data->username}}
	                    </td>
	                    <td class="text-left">
	                      <div class="dropdown">
	                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                          	<i class="fas fa-ellipsis-v"></i>
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
	                        	<a class="dropdown-item" data-toggle="modal" data-target="#Modal{{$key}}">
							 	Detail/Edit</a>
	                          	<a class="dropdown-item" href="{{route('admin.userReset',$data->id_user)}}">Reset Password</a>
	                          	<a class="dropdown-item" href="{{route('admin.userDelete',$data->id_user)}}">Delete</a>
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