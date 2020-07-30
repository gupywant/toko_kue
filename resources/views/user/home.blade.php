@extends('/user/app/app')
@section('content')
<style type="text/css">
a:visited {
  color: grey;
}
  a:hover {
  color: hotpink;
}
a:active {
  color: grey;
}
</style>
  <!--Carousel Wrapper-->
  <div id="carousel-example-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">

    <!--Indicators-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-1z" data-slide-to="1"></li>
      <li data-target="#carousel-example-1z" data-slide-to="2"></li>
      <li data-target="#carousel-example-1z" data-slide-to="3"></li>
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

      <!--First slide-->
      <div class="carousel-item active">
        <div class="view" style="background-image: url('{{URL::asset('/img/banner/1.jpg')}}'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Fathya's Cake</strong>
              </h1>

              <a href="#order" class="btn btn-outline-white btn-lg">Pesan Sekarang
                <i class="fas fa-graduation-cap ml-2"></i>
              </a>
            </div>
            <!-- Content -->

          </div>

          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/First slide-->

      <!--Second slide-->
      <div class="carousel-item">
        <div class="view" style="background-image: url('{{URL::asset('/img/banner/2.jpg')}}'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Fathya's Cake</strong>
              </h1>

              <a href="#order" class="btn btn-outline-white btn-lg">Pesan Sekarang
                <i class="fas fa-graduation-cap ml-2"></i>
              </a>
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/Second slide-->

      <!--Second slide-->
      <div class="carousel-item">
        <div class="view" style="background-image: url('{{URL::asset('/img/banner/3.jpg')}}'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Fathya's Cake</strong>
              </h1>

              <a href="#order" class="btn btn-outline-white btn-lg">Pesan Sekarang
                <i class="fas fa-graduation-cap ml-2"></i>
              </a>
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/Second slide-->

      <!--Second slide-->
      <div class="carousel-item">
        <div class="view" style="background-image: url('{{URL::asset('/img/banner/4.jpg')}}'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Fathya's Cake</strong>
              </h1>

              <a href="#order" class="btn btn-outline-white btn-lg">Pesan Sekarang
                <i class="fas fa-graduation-cap ml-2"></i>
              </a>
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/Second slide-->

    </div>
    <!--/.Slides-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->

  </div>
  <!--/.Carousel Wrapper-->

  <!--Main layout-->
  <main>
    <div class="container" id="order">

      <!--Navbar-->
      <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">

        <!-- Navbar brand -->
        <span class="navbar-brand">Jenis Kue:</span>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
          aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

          <!-- Links -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item {{$kat == 'x' ? 'active' : null}}">
                <a class="nav-link" href="{{route('user.home')}}">Semua Kue
                </a>
            </li>
            @foreach($jenis as $data)
            <li class="nav-item {{$kat == $data->id_jenis ? 'active' : null}}">
                <a class="nav-link" href="{{route('user.home')}}?kat={{$data->id_jenis}}">{{$data->nama}}
                </a>
            </li>
            @endforeach
          </ul>
          <!-- Links -->

          <form class="form-inline" method="get" action="{{route('user.home')}}">
            <div class="md-form my-0">
              <input class="form-control mr-sm-2" value="{{$cari}}" name="cari" type="text" placeholder="Search" aria-label="Search">
            </div>
          </form>
        </div>
        <!-- Collapsible content -->

      </nav>
      <!--/.Navbar-->

      <!--Section: Products v.3-->
      <section class="text-center mb-4">

        <!--Grid row-->
        <div class="row wow fadeIn">
          @foreach($kue as $data)
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

      <!--Pagination-->
      <nav class="d-flex justify-content-center wow fadeIn">
        <ul class="pagination pg-blue">

         {{ $kue->links() }}
        </ul>
      </nav>
      <!--Pagination-->

    </div>
  </main>
  <!--Main layout-->

@endsection