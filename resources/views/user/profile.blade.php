@extends('/user/app/app')
@section('content')
  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Edit Profile</h2>

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <form class="card-body" action="{{route('user.updateProfile')}}" method="post">
              {{csrf_field()}}
              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-12 mb-2">

                  <!--firstName-->
                  <div class="md-form ">
                    <input type="text" name="nama" id="firstName" value="{{$user->nama}}" class="form-control">
                    <label for="firstName" class="">Nama</label>
                  </div>

                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--email-->
              <div class="md-form mb-5">
                <input type="text" id="email" name="username" value="{{$user->username}}" class="form-control" placeholder="youremail@example.com">
                <label for="email" class="">Email</label>
              </div>

              <div class="md-form mb-5">
                <input type="text" id="email" name="no_tlp" value="{{$user->no_tlp}}" class="form-control" placeholder="081xx">
                <label for="email" class="">No Tlp</label>
              </div>


              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-5 mb-2">
                  <div class="md-form">
                    <input type="text" name="alamat" value="{{$user->alamat}}" id="address" class="form-control" placeholder="1234 Main St">
                    <label for="address-2" class="">Alamat Lengkap</label>
                  </div>
                </div>
                <div class="col-md-4 mb-2">
                  <div class="md-form">
                    <input type="text" name="kota" value="{{$user->kota}}" id="address" class="form-control" placeholder="1234 Main St">
                    <label for="address-2" class="">Kota</label>
                  </div>
                </div>
                <div class="col-md-3 mb-2">
                  <div class="md-form">
                    <input type="text" name="kode_pos" value="{{$user->kode_pos}}" id="address" class="form-control" placeholder="1234 Main St">
                    <label for="address-2" class="">Kode Pos</label>
                  </div>
                </div>
              </div>

              <hr>
                *
                <label for="same-address">Alamat ini digunakan untuk alamat pengiriman</label>
                <br>
              <button class="btn btn-primary btn-lg btn-block" type="submit">Edit Profile</button>

            </form>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->
  @endsection