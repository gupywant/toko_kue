@extends('/user/app/app')
@section('content')
<!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 mb-4">

        @if(!empty($kue->gambar))
          <img class="img-fluid" width="70%" src="{{URL::asset('/filesdat')}}/{{$kue->id_kue}}{{'/'.$kue->gambar}}">
        @else
          <img class="img-fluid" src="{{URL::asset('/filesdat/default/default_photo.png')}}">
        @endif

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">

            <div class="mb-3">
              <a href="{{route('user.home')}}?kat={{$jenis->id_jenis}}">
                <span class="badge purple mr-1">{{$jenis->nama}}</span>
              </a>
            </div>

            <p class="lead">
              <span>Rp. {{number_format($kue->harga,0,',','.')}}/ PCS</span>
            </p>

            <p class="lead font-weight-bold">Deskripsi</p>

            <p>{!!$kue->deskripsi!!}</p>

            <form method="post" class="d-flex justify-content-left" action="{{route('user.keranjang',$kue->id_kue)}}">
              <!-- Default input -->
              <input type="number" name="jumlah" value="1" aria-label="Search" class="form-control" style="width: 100px">
              @if(Session::get('user'))
              {{csrf_field()}}
              <button class="btn btn-primary btn-md my-0 p" type="submit" >Add to cart
                <i class="fas fa-shopping-cart ml-1"></i>
              </button>
              @else
              <a class="btn btn-primary btn-md my-0 p" target="_blank" href="{{route('user.login')}}" data-toggle="tooltip" title="Login Untuk Memesan!">Login Terlebih Dahulu <i class="fa fa-sign-in ml-1"></i></a>
              @endif

            </form>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr>
      <h1>Galeri</h1>
      <!--Grid row-->
      <div class="row wow fadeIn">
        @foreach($gambar as $data)
        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-4">

          <img src="{{URL::asset('/filesdat')}}/{{$kue->id_kue}}{{'/'.$data->gambar}}" width="70%" class="img-fluid" alt="">

        </div>
        @endforeach
      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->
  
@endsection