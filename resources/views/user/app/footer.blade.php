<!--Footer-->
  <footer class="page-footer text-center font-small mt-4 wow fadeIn">

    <!--Call to action-->
    <div class="pt-4">
      <h1>Fathiya's Cake</h1>
    </div>
    <!--/.Call to action-->

    <hr class="my-4">
    <p>Kontak Kami : Pondok Cilegon Indah - 081211654729</p>
    <hr>

    Fathiya Cake and Cookies merupakan toko kue yang berdiri sejak tahun 2018.
    <p> Menyediakan berbagai produk olahan kue rumahan dengan rasa cita rasa yang lezat.</p>
    <!-- Social icons -->


    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2020 Copyright:
      <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> Fathyia's Cake </a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="{{ URL::asset('js/jquery-3.4.1.min.js')}}"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ URL::asset('js/popper.min.js')}}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js')}}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ URL::asset('js/mdb.min.js')}}"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>
  @if(!empty($tabel))
  <script type="text/javascript">
    $(document).ready( function () {
      $('#myTable').DataTable();
    } );
    $(document).ready( function () {
      $('#myTable1').DataTable();
    } );
    $(document).ready( function () {
      $('#myTable2').DataTable();
    } );
  </script>
  @endif
@if(session('order'))
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Segera Lakukan Pembayaran</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>Segera lakukan pembayaran dengan no VA <strong>({{session('order')}})</strong> bank tujuan X,  untuk memproses pemesanan</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endif
@if(session('status'))
<script type="text/javascript">
    $(window).on('load',function(){
        $('#status').modal('show');
    });
</script>
<div class="modal" id="status">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Status</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p><strong>{{session('status')}}</strong></p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endif
</body>

</html>