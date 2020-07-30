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
              <button class="btn btn-primary btn-md my-0 p" type="submit" >Pesan
                <i class="fas fa-shopping-cart ml-1"></i>
              </button>
              @else
              <a class="btn btn-primary btn-md my-0 p" data-toggle="modal" data-target="#loginModal">Pesan <i class="fas fa-shopping-cart ml-1"></i></a>
              @endif

            </form>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr>
      <h1>Produk Sejenis</h1>
      <!--Grid row-->
      <div class="row wow fadeIn">
        <!--Section: Products v.3-->
      <section class="text-center mb-4">

        <!--Grid row-->
        <div class="row wow fadeIn">
          @foreach($kueSejenis as $data)
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4">

            <!--Card-->
            <div class="card" style="height: 100%">

              <!--Card image-->
              <div class="view overlay">
                @if(!empty($data->gambar))
                  <img class="card-img-top" width="30%" src="{{URL::asset('/filesdat')}}/{{$data->id_kue}}{{'/'.$data->gambar}}">
                @else
                  <img class="card-img-top" width="30%" src="{{URL::asset('/filesdat/default/default_photo.png')}}">
                @endif
                <a href="{{route('user.kue',$data->id_kue)}}">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!--Card image-->

              <!--Card content-->
              <div class="card-body text-center">
                <h5>
                  <strong>
                    <a href="{{route('user.kue',$data->id_kue)}}">{{$data->nama}}
                      {!!$data->waktu_po==0 ? '<span class="badge badge-pill success-color">Ready</span>' : '<span class="badge badge-pill danger-color">PO</span>' !!}
                    </a>
                  </strong>
                </h5>
                <h4 class="font-weight-bold blue-text">
                  <strong>Rp {{number_format($data->harga,0,'.',',')}}</strong>
                </h4>

              </div>
              <!--Card content-->

            </div>
            <!--Card-->

          </div>
          <!--Grid column-->
          @endforeach
        </div>
        <!--Grid row-->

      </section>
      <!--Section: Products v.3-->
      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->
  
@endsection