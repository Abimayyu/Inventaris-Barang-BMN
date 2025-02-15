@extends('layout.app')
@section('title', 'Data Barang')
@section('dataBarang-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Verifikasi Data Barang</h1>
    </div>
    
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th class="text-center">
                          No
                        </th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Merk</th>
                        <th>Asal Perolehan</th>
                        <th>Penerima</th>
                        <th>Kondisi</th>
                        <th>Tahun Pembelian</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =1;
                        @endphp
                    @foreach ($barang as $p)
                      <tr>
                        <td>
                          {{ $no++ }}
                        </td>
                        <td>{{ $p->kode_barang }}</td>
                        <td>{{ $p->dataBarang->nama_barang }}</td>
                        <td>{{ $p->dataBarang->merk_barang }}</td>
                        <td>{{ $p->asal_perolehan }}</td>
                        <td>{{ $p->penerima }}</td>
                        <td>
                        
                          <div  class="badge badge-sm badge-{{ $p->kondisi->warna }}">{{ $p->kondisi->kondisi_barang }}</div>
                        </td>
                        <td>{{ $p->dataBarang->tahun_pembelian }}</td>
                        <td align="center">
                          <img alt="image" src="{{ asset('uploads/'. $p->foto) }}" class="img-responsive" width="50%" data-toggle="tooltip">

                        </td>
                        <td>
                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#verifikasiModal" data-id="{{ $p->id }}">
                            Verifikasi
                        </button>
                            <form action="{{ url('hapus-unit-barang', $p->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('GET')
                              <button type="submit" class="btn btn-danger btn-hapus">Tolak</button>
                          </form>
                          </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
</div>

<!-- Modal for Verifikasi -->
<div class="modal fade" id="verifikasiModal" tabindex="-1" role="dialog" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="verifikasiModalLabel">Verifikasi Barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form id="verifikasiForm" action="" method="POST">
                  @csrf
                  <div class="form-group">
                      <label for="kode_barang">Kode Barang</label>
                      <input type="text" id="inputKodeBarang" placeholder="_.__.__.__.___.___" class="form-control" id="kode_barang" name="kode_barang" required>
                  </div>
                  <button type="submit" class="btn btn-success">Verifikasi</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              </form>
          </div>
      </div>
  </div>
</div>

@endsection

@section('cjs')
<script>
  $('#verifikasiModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var idBarang = button.data('id'); // Extract data-id attribute

        // Set the form action dynamically for the form
        var form = $(this).find('#verifikasiForm');
        form.attr('action', '/verifikasi-barang/' + idBarang); // Update form action

        $("#inputKodeBarang").inputmask({"mask": "9.99.99.99.999.999"});
    });

    // Handle form submission for Verifikasi
    $('#verifikasiForm').on('submit', function(e) {
          e.preventDefault();
          var form = $(this);

          // Perform the form submission via AJAX
          $.ajax({
              url: form.attr('action'), // URL from the form's action attribute
              method: 'POST',
              data: form.serialize(), // Serialize the form data (including kode_barang)
              success: function(response) {
                  // If the response is successful, hide the modal, show success message, and reload the page
                  $('#verifikasiModal').modal('hide');
                  Swal.fire('Berhasil!', 'Barang Berhasil di Verifikasi.', 'success');
                  location.reload(); // Optionally, reload the page
              },
              error: function(xhr) {
                  // Check if the response contains validation errors
                  if (xhr.responseJSON && xhr.responseJSON.errors) {
                      var errors = xhr.responseJSON.errors;
                      
                      // Display the validation error message from the 'kode_barang' field
                      if (errors.kode_barang) {
                          Swal.fire('Gagal!', errors.kode_barang[0], 'error');
                      }
                  } else {
                      // If there is no validation error, show a generic failure message
                      Swal.fire('Gagal!', 'Gagal Verifikasi Barang', 'error');
                  }
              }
          });
      });
  
  $('.btn-hapus').on('click', function (e) {
            e.preventDefault(); // prevent form submit
            var form = event.target.form;
            Swal.fire({
            title: 'Tolak Data?',
            text: "Unit Barang yang ditolak akan dihapus permanen",
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
</script>
@endsection