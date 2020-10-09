@extends('/user/app/app')
@section('content')
  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Order Kue</h2>

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-7 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <form class="card-body" action="{{route('user.keranjangOut')}}" method="post">
              {{csrf_field()}}
              <input type="hidden" id="firstName" name="jumlah" value="{{-- $jumlah --}}" class="form-control">
              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-12 mb-2">

                  <!--firstName-->
                  <div class="md-form ">
                    <input type="text" disabled="" id="firstName" value="{{$user->nama}}" class="form-control">
                    <label for="firstName" class="">Nama</label>
                  </div>

                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--email-->
              <div class="md-form mb-5">
                <input type="text" id="email" disabled="" value="{{$user->username}}" class="form-control" placeholder="youremail@example.com">
                <label for="email" class="">Email</label>
              </div>

              <div class="md-form mb-5">
                <input type="text" id="email" disabled="" value="{{$user->no_tlp}}" class="form-control" placeholder="081xx">
                <label for="email" class="">No Tlp</label>
              </div>


              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-5 mb-2">
                  <div class="md-form">
                    <input type="text" disabled="" value="{{$user->alamat}}" id="address" class="form-control" placeholder="1234 Main St">
                    <label for="address-2" class="">Alamat Lengkap</label>
                  </div>
                </div>
                <div class="col-md-4 mb-2">
                  <div class="md-form">
                    <input type="text" disabled="" value="{{$user->kota}}" id="address" class="form-control" placeholder="1234 Main St">
                    <label for="address-2" class="">Kota</label>
                  </div>
                </div>
                <div class="col-md-3 mb-2">
                  <div class="md-form">
                    <input type="text" disabled="" value="{{$user->kode_pos}}" id="address" class="form-control" placeholder="1234 Main St">
                    <label for="address-2" class="">Kode Pos</label>
                  </div>
                </div>
              </div>

              <hr>
                *
                <label for="same-address">Pembayaran dilakukan dengan virtual account(VA) bank X</label>
                <br>
                *
                <label for="same-address">Jika Alamat tidak sesuai, ubah pada menu akun</label>
              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>

            </form>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-5 mb-4">

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Order Anda</span>
            <span class="badge badge-secondary badge-pill">{{--$jumlah--}}</span>
          </h4>
          @php 
            $total = 0;
          @endphp
          <!-- Cart -->
          <ul class="list-group mb-3 z-depth-1">
            @foreach($keranjang as $data)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">{{$data->nama}}</h6>
                <small class="text-muted">Jumlah {{$data->jumlah}}</small>
                <a href="{{route('user.keranjangDelete',$data->id_kue)}}" class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></a>
              </div>
              <span class="text-muted">Rp {{number_format($data->harga),0,',','.'}}</span>
            </li>
            @php $total += ($data->harga*$data->jumlah);  @endphp
            @endforeach
            <li class="list-group-item d-flex justify-content-between">
              <span>Total</span>
              <strong>Rp {{number_format($total),0,',','.'}}</strong>
            </li>
          </ul>
          <!-- Cart -->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->
  @endsection