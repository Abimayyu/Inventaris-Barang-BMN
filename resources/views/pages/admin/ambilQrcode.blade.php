@extends('layout.app')
@section('title', 'Qrcode')
@section('ambilQrcode-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Qr Code</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h4>Scan Qr Code</h4>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div id="reader" class="mx-auto"></div>
                    </div>
                </div>
              </div>
            </div>
            
          </div>
        
    </div>
</section>
</div>
@endsection

@section('cjs')
<script type="text/javascript">
    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:

        
        html5QrcodeScanner.clear();

        // DENGAN NOTIF
        // Swal.fire({
        //     title: 'Berhasil Scan QR Code!',
        //     icon: 'success',
        //     confirmButtonText: 'Oke',
        //     }).then((result) => {
        //     if (result.isConfirmed) {
        //         window.location.href = `{{ url('detail-unit-barang') }}/`+decodedResult['decodedText']
        //     }
        // })

        window.location.href = `{{ url('detail-unit-barang') }}/`+decodedResult['decodedText']
        
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
@endsection