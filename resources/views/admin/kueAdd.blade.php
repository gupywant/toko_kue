@extends('/admin/app/app')
@section('content')
<script type="text/javascript">
  window.addEventListener("load", function() {
  var limit = 1;
  document.getElementById("add").addEventListener("click", function() {
    // Create a div
    if(limit>0){
      var div = document.createElement("div");
      div.setAttribute("class","form-group");
      // Create a file input
      var file = document.createElement("input");
      file.setAttribute("type", "file");
      file.setAttribute("class", "form-control-file")
      file.setAttribute("name", "foto[]"); // You may want to change this
      file.setAttribute("multiple","");

      // add the file and text to the div
      div.appendChild(file);
      limit = limit+1;
      //Append the div to the container div
      document.getElementById("container").appendChild(div);
    }else{
      alert('Maximal 3 gambar');
    }
  });
});
</script>
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Tambah Kue</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Kue</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tambah Kue</li>
                </ol>
              </nav>
            </div>
            <div class="col-xl-12 order-xl-1">
	          <div class="card">
	            <div class="card-header">
	              <div class="row align-items-center">
	                <div class="col-8">
	                  <h3 class="mb-0">Tambah Kue</h3>
	                </div>
	              </div>
	            </div>
	            <div class="card-body">
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
	            	<form action="{{route('admin.kueTambah')}}" method="post" enctype="multipart/form-data">
	            	{{csrf_field()}}
	                <div class="pl-lg-4">
	                  <div class="row">
	                    <div class="col-lg-6">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-username">Nama</label>
	                        <input type="text" name="nama" id="input-username" class="form-control" placeholder="Nama Kue" required="">
	                      </div>
	                    </div> 
	                    <div class="col-lg-6">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-username">harga</label>
	                        <input type="number" name="harga" id="input-username" class="form-control" placeholder="Harga Kue" required="">
	                      </div>
	                    </div>
	                    <div class="col-lg-6">
	                      <div class="form-group">
	                       	<div class="form-group">
							  <label class="form-control-label" for="input-last-name">Jenis</label>
							  <select name="jenis" class="form-control" id="sel1">
							  	@foreach($jenis as $data)
							    	<option value="{{$data->id_jenis}}">{{$data->nama}}</option>
							    @endforeach
							  </select>
							</div>
	                      </div>
	                    </div>
	                    <div class="col-lg-6">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-username">Waktu PO</label>
	                        <input type="number" name="po" id="input-username" class="form-control" placeholder="Waktu PO" required="">
	                      </div>
	                    </div>
	                  </div>
	                  <div class="row">
	                    <div class="col-lg-12">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-first-name">Description</label>
	                        <textarea name="descriptions" required></textarea>
			                <script>
			                        CKEDITOR.replace( 'descriptions' );
			                </script>
	                      </div>
	                    </div>
	                  </div>
	                </div>
	                <hr class="my-4" />
	                <!-- Address -->
	                <h6 class="heading-small text-muted mb-4">Gambar</h6>
	                <div class="pl-lg-4">
	                	<label for="name">Tambah Gambar</label>
		                  <div id="container">
		                    <div class="form-group">
		                      <input type="file" class="form-control-file" name="foto[]" multiple>
		                    </div>
		                  </div>
		                <input type="button" class="btn btn-info" value="Add Another" id="add" />
	                </div>
	            </div>
	            <div class="card-footer">
	              <div class="row align-items-center">
	                <div class="col-8">
	                  <h3 class="mb-0">Tambah Kue</h3>
	                </div>
	                <div class="col-4 text-right">
	                  <input type="submit" class="btn btn-md btn-primary" value="Tambah Kue">
	                </div>
	              </div>
	            </div>
	              </form>
	          </div>
	        </div>
          </div>
        </div>
      </div>
    </div>
@endsection