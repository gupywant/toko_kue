<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Fathiya's Cake</title>
  <link rel="icon" href="{{URL::asset('img/logo.jpeg')}}" type="image/png">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="{{ URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="{{ URL::asset('css/mdb.min.css')}}" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="{{ URL::asset('css/style.min.css')}}" rel="stylesheet">
  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="{{route('user.home')}}">
        <strong class="blue-text">Fathiya's Cake</strong>
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link waves-effect" href="{{route('user.home')}}">Home
            </a>
          </li>
          @if(Session::get('user'))
          <li class="nav-item">
            <a class="nav-link waves-effect" href="{{route('user.orderUser')}}">Pesanan Anda</a>
          </li>
          @endif
        </ul>
        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          @if(Session::get('user'))
          <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="margin-left: 5px; margin-top: 5px">Akun
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{route('user.profile')}}">Profile Edit</a></li>
                  <li><a data-toggle="modal" data-target="#paswordCh">Ubah Password</a></li>
                  <li><a href="{{route('user.logout')}}">logout</a></li>
                </ul>
          </li>
          @else
          <li class="nav-item">
            <a data-toggle="modal" data-target="#loginModal" class="nav-link waves-effect">
              Login
            </a>
          </li>
          <li class="nav-item">
            <a data-toggle="modal" data-target="#registerModal" class="nav-link waves-effect" target="_blank">
              Daftar
            </a>
          </li>
          @endif
        </ul>

      </div>

    </div>
  </nav>
  <!-- Navbar -->
  @if(Session::get('user'))
    <!-- The Modal -->
    <div class="modal" id="paswordCh">
      <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{route('user.passwordChange')}}" method="post">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Ganti Password</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          {{csrf_field()}}
          <!-- Modal body -->
          <div class="modal-body">
            <div class="md-form mb-1">
              <input type="password" id="old" name="old" class="form-control" placeholder="Password Lama">
              <label for="old" class="">Password Lama</label>
            </div>
          </div>
          <div class="modal-body">
            <div class="md-form mb-1">
              <input type="password" id="new" name="new" class="form-control" placeholder="Password Baru">
              <label for="new" class="">Password Baru</label>
            </div>
          </div>
          <div class="modal-body">
            <div class="md-form mb-1">
              <input type="password" id="new2" name="new2" class="form-control" placeholder="Tulis ulang password baru">
              <label for="new2" class="">Konfirmasi Password Baru</label>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Save</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  @else

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('user.loged')}}" method="post">
      {{csrf_field()}}
      <div class="modal-body">
        <div class="form-group">
        <label for="email">Email:</label>
          <input type="email" required="" class="form-control" name="username" placeholder="Masukkan Email" id="email">
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" required="" class="form-control" name="password" placeholder="Masukkan Password" id="pwd">
        </div>
        <div class="form-group">
          <a class="nav-link waves-effect" href="{{route('user.forgot')}}">Lupa Password?</a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Daftar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('user.userRegister')}}" method="post">
      {{csrf_field()}}
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="pwd">Email:</label>
              <input required="" type="text" id="email" class="form-control" name="username" placeholder="Email">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="pwd">Password:</label>
              <input required="" type="password" id="password" class="form-control" name="password" placeholder="Password">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="pwd">Nama:</label>
              <input required="" type="text" id="nama" class="form-control" name="nama" placeholder="Nama">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="pwd">Alamat:</label>
              <input required="" type="text" id="alamat" class="form-control" name="alamat" placeholder="Alamat">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
             <label for="pwd">Kota:</label>
              <input required="" type="text" id="kota" class="form-control" name="kota" placeholder="Kota">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="pwd">Provinsi:</label>
              <input required="" type="text" id="provinsi" class="form-control" name="provinsi" placeholder="Provinsi">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="pwd">Kode Pos:</label>
              <input required="" type="text" id="kode_pos" class="form-control" name="kode_pos" placeholder="kode pos">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="pwd">No Tlp:</label>
              <input required="" type="text" id="no_tlp" class="form-control" name="no_tlp" placeholder="No Tlp">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Daftar</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endif