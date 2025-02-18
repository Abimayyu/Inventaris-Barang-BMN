<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\DistribusiBarang;
use App\Models\DetailDataBarang;
use App\Models\DetailDistribusiBarang;
use App\Models\DetailPeminjaman;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Kondisi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class AdminController extends Controller
{
    public function Dashboard()
    {
       
        $chart = [];
        $distribusibarang  = DistribusiBarang::where('status', 0)->count();
        $barangterverifikasi  = DetailDataBarang::where('status', 0)->count();
        $pengembalian = Peminjaman::where('tgl_pengembalian', '!=', NULL)->count();
        $peminjaman = Peminjaman::where('tgl_pengembalian', NULL)->count();
        $barang = DistribusiBarang::where('status', 0)->limit(3)->get();

        for ($i=0; $i < 12; $i++) {
            $data_per_bulan = DistribusiBarang::where('status', 1)->whereMonth('tanggal_distribusi', '=', $i+1)->whereYear('tanggal_distribusi', '=', date('Y'))->count();
            array_push($chart, $data_per_bulan);

        }
        
        return view('pages/admin/dashboard')->with(compact('chart', 'distribusibarang','barangterverifikasi','peminjaman','pengembalian','barang'));
    }
    public function Pengguna()
    {
        $pengguna = User::all();
        // nak banyak
        // $data = [
        //     'pengguna' => User::all(),
        //     'cek' => count(User::all()),
        // ];
        return view('pages/admin/dataPengguna')->with('data_pengguna', $pengguna);
    }
    public function tambahDataPengguna()
    {
        return view('pages/admin/tambahDataPengguna');
        
    }
    public function editDataPengguna($id)
    {
        $pengguna = User::find($id);
        return view('pages/admin/editDataPengguna')->with('data_pengguna',$pengguna);
        
    }
    public function hapusDataPengguna($id)
    {
        User::find($id)->delete();
        Alert::success('Berhasil', 'Kamu berhasil menghapus data pengguna!');
        return redirect()->back();
        
    }
    public function tambahDataPenggunaAksi(Request $req)
    {
        $validate = $req->validate([
            'nama' => ['required'],
            'username' => ['required','unique:data_pengguna'],
            'password' => ['required'],
            'hak_akses' => ['required'],
            'foto' => ['mimes:jpeg,png,bmp,tiff']
        ],
        [
            'username.required' => 'Kolom Username harus diisi!',
            'username.unique' => 'Username yang anda pilih sudah terdaftar!',
            'password.required' => 'Kolom Password harus diisi!',
            'hak_akses.required' => 'Kolom Hak Akses harus diisi!',
            'nama.required' => 'Kolom Nama harus diisi!',
            'foto.mimes' => 'File foto harus berformat jpeg,png,bmp atau tiff!',
        ]);

        if (count($req->files) > 0) {
            $foto = time().'_'.$req->file('foto')->getClientOriginalName();
            $req->file('foto')->storeAs('assets\img\avatar', $foto);
        }else {
            $foto = 'avatar-1.png';
        }

        User::create([
            'nama' => $req->nama,
            'username' => $req->username,
            'password' => bcrypt($req->password),
            'foto' => $foto,
            'hak_akses' => $req->hak_akses,
        ]);

        Alert::success('Berhasil', 'Kamu berhasil tambah data pengguna!');
        return redirect('dataPengguna');
    }
    public function ResetPassword($id)
    {
        $data = User::find($id);

        User::find($id)->update([
            'password' => bcrypt($data['username']),
        ]);
        Alert::success('Berhasil', 'Password Direset menjadi sesuai dengan username !');
        return redirect()->back();
        

        
    }
    public function editDataPenggunaAksi(Request $req)
    {

        if ($req->username === $req->old_username) {
            $validate = $req->validate([
                'nama' => ['required'],
                'username' => ['required'],
                'foto' => ['mimes:jpeg,png,bmp,tiff']
            ],
            [
                'username.required' => 'Kolom Username harus diisi!',
                'nama.required' => 'Kolom Nama harus diisi!',
                'foto.mimes' => 'File foto harus berformat jpeg,png,bmp atau tiff!',
            ]);
        }else {
            $validate = $req->validate([
                'nama' => ['required'],
                'username' => ['required','unique:data_pengguna'],
                'foto' => ['mimes:jpeg,png,bmp,tiff']
            ],
            [
                'username.required' => 'Kolom Username harus diisi!',
                'username.unique' => 'Username yang anda pilih sudah terdaftar!',
                'nama.required' => 'Kolom Nama harus diisi!',
                'foto.mimes' => 'File foto harus berformat jpeg,png,bmp atau tiff!',
            ]);
        }

        if (count($req->files) > 0) {
            $foto = time().'_'.$req->file('foto')->getClientOriginalName();
            $req->file('foto')->storeAs('assets\img\avatar', $foto);
        }else {
            $foto = $req->old_name_file;
        }

        User::find($req->id)->update([
            'nama' => $req->nama,
            'username' => $req->username,
            'foto' => $foto,
        ]);

        Alert::success('Berhasil', 'Kamu berhasil edit data pengguna!');
        return redirect('dataPengguna');
    }
  
    public function Barang()
    {
        $barang = DataBarang::all();
        // nak banyak
        // $data = [
        //     'pengguna' => User::all(),
        //     'cek' => count(User::all()),
        // ];
        return view('pages/admin/dataBarang')->with('data_barang', $barang);
    }
    public function LihatBarang($id)
    {
        
        $barang = DetailDataBarang::where('id_data_barang',$id)->where('status', 1)->get();
        $data_nama = DataBarang::find($id);
        return view('pages/admin/detailDataBarang')->with(compact('barang','data_nama',));
    }
    public function DaftarDataBarang()
    {
        return view('pages/admin/daftarDataBarang');
        
    }
    public function DaftarDataBarangAksi(Request $req)
    {
        $validate = $req->validate([
            'nama_barang' => ['required'],
            'merk_barang' => ['required'],
            'tahun_pembelian' => ['required'],
        ],
        [
            'nama_barang.required' => 'Kolom Nama Barang harus diisi!',
            'merk_barang.required' => 'Kolom Merk Barang harus diisi!',
            'tahun_pembelian.required' => 'Kolom Tahun Pembelian harus diisi!',
            
        ]);

        

        DataBarang::create([
            'nama_barang' => $req->nama_barang,
            'merk_barang' => $req->merk_barang,
            'tahun_pembelian' => $req->tahun_pembelian,
        ]);

        Alert::success('Berhasil', 'Berhasil Mendaftar Barang!');
        return redirect('dataBarang');
    }
    public function EditDataBarang($id)
    {
        $barang = DataBarang::find($id);
        return view('pages/admin/editDataBarang')->with('data_barang',$barang);
        
    }
    public function EditDataBarangAksi(Request $req)
    {

            $validate = $req->validate([
                'nama_barang' => ['required'],
                'merk_barang' => ['required'],
                'tahun_pembelian' => ['required']
            ],
            [
                'nama_barang.required' => 'Kolom Nama Barang harus diisi!',
                'merk_barang.required' => 'Kolom Merk Barang harus diisi!',
                'tahun_pembelian.required' => 'Kolom Tahun Pembelian harus diisi!',
            ]);
        DataBarang::find($req->id)->update([
            'nama_barang' => $req->nama_barang,
            'merk_barang' => $req->merk_barang,
            'tahun_pembelian' => $req->tahun_pembelian,
        ]);

        Alert::success('Berhasil', 'Kamu berhasil edit Data Barang!');
        return redirect('dataBarang');
    }
    public function HapusDataBarang($id)
    {
        DataBarang::find($id)->delete();
        Alert::success('Berhasil', 'Berhasil menghapus Data Barang!');
        return redirect()->back();
        
    }
    public function TambahUnitBarang($id)
    {
        $data_barang = DataBarang::find($id);
        $lokasi = Lokasi::all();
        $kondisi = Kondisi::all();
        return view('pages/admin/tambahUnitBarang')->with(compact('data_barang', 'lokasi', 'kondisi'));
        
    }
    public function TambahUnitBarangAksi(Request $req)
    {
        
        $validate = $req->validate([
            // 'kode_barang' => ['required','unique:detail_data_barang'],
            'asal_perolehan' => ['required'],
            'penerima' => ['required'],
            'kondisi' => ['required'],
            'foto' => ['required','mimes:jpeg,png,bmp,tiff'],

        ],
        [
            // 'kode_barang.required' => 'Kolom Kode Barang harus diisi!',
            // 'kode_barang.unique' => 'Kode barang yang anda pilih sudah terdaftar!',
            'asal_perolehan.required' => 'Kolom Asal Perolehan Barang harus diisi!',
            'penerima.required' => 'Kolom Penerima Barang harus diisi!',
            'kondisi.required' => 'Kolom kondisi Barang harus diisi!',
            'foto.required' => 'Kolom Foto Barang harus diisi!',
            'foto.mimes' => 'File foto harus berformat jpeg,png,bmp atau tiff!',

            
        ]);

        $foto = time().'_'.$req->file('foto')->getClientOriginalName();
            $req->file('foto')->storeAs('uploads/', $foto);

        DetailDataBarang::create([
            'id_data_barang' => $req->id_data_barang,
            // 'kode_barang' => $req->kode_barang,
            'asal_perolehan' => $req->asal_perolehan,
            'penerima' => $req->penerima,
            'kondisi_barang' => $req->kondisi,
            'status' => 0,
            'foto' => $foto,

        ]);

        Alert::info('Berhasil', 'Menunggu Konfirmasi dari Verifikator!');
        return redirect('lihat-data-barang/'.$req->id_data_barang);
    }
    public function EditUnitBarang($id)
    {
        $data_barang = DetailDataBarang::find($id);
        $lokasi = Lokasi::all();
        return view('pages/admin/editUnitBarang')->with(compact('data_barang', 'lokasi'));
        
    }
    public function EditUnitBarangAksi(Request $req)
    {
        if ($req->kode_barang === $req->old_kode_barang) {
            $validate = $req->validate([
                'kode_barang' => ['required'],
                'asal_perolehan' => ['required'],
                'penerima' => ['required'],
                'foto' => ['mimes:jpeg,png,bmp,tiff'],
    
            ],
            [
                'kode_barang.required' => 'Kolom Kode Barang harus diisi!',
                'asal_perolehan.required' => 'Kolom Asal Perolehan Barang harus diisi!',
                'penerima.required' => 'Kolom Penerima Barang harus diisi!',
                'foto.mimes' => 'File foto harus berformat jpeg,png,bmp atau tiff!',
    
                
            ]);
        }else{
            $validate = $req->validate([
                'kode_barang' => ['required','unique:detail_data_barang'],
                'asal_perolehan' => ['required'],
                'penerima' => ['required'],
                'foto' => ['mimes:jpeg,png,bmp,tiff'],

            ],
            [
                'kode_barang.required' => 'Kolom Kode Barang harus diisi!',
                'kode_barang.unique' => 'Kode barang yang anda pilih sudah terdaftar!',
                'asal_perolehan.required' => 'Kolom Asal Perolehan Barang harus diisi!',
                'penerima.required' => 'Kolom Penerima Barang harus diisi!',
                'foto.mimes' => 'File foto harus berformat jpeg,png,bmp atau tiff!',

                
            ]);
        }
        
        if (count($req->files) > 0) {
            $foto = time().'_'.$req->file('foto')->getClientOriginalName();
            $req->file('foto')->storeAs('uploads/', $foto);
        }else {
            $foto = $req->old_name_file;
        }

        DetailDataBarang::find($req->id)->update([
            'kode_barang' => $req->kode_barang,
            'asal_perolehan' => $req->asal_perolehan,
            'penerima' => $req->penerima,
            'foto' => $foto,
        ]);

        Alert::success('Berhasil', 'Berhasil edit unit Barang!');
        return redirect('lihat-data-barang/'.$req->id_data_barang);

    }
    public function HapusUnitBarang($id)
    {
        Alert::success('Berhasil', 'Berhasil menghapus Data Barang!');
        DetailDataBarang::find($id)->delete();
        return redirect()->back();
        
    }
    public function Qrcode()
    {
        return view('pages/admin/ambilQrcode');
    }
    public function CetakQrcode($id)
    {
        
        return view('pages/admin/qrCode')->with('id', $id);

    }
    public function DetailUnitBarang($id)
    {
        
        
        $data_barang = DetailDataBarang::where('kode_barang',$id)->first();
        $data_distribusi = DetailDistribusiBarang::where('id_barang',$data_barang->id)->first();

        return view('pages/admin/detailUnitBarang')->with([
            'data_barang' => $data_barang,
            'data_distribusi' => $data_distribusi
        ]);
    }
    public function Peminjaman()
    {
        $peminjaman = Peminjaman::all();
        return view('pages/admin/dataPeminjaman')->with('peminjaman', $peminjaman);
    }
    public function TambahPeminjamanBarang()
    {
        $barang = DetailDataBarang::where('status',  1)->where('kondisi_barang', 1)->get();

        return view('pages/admin/tambahPeminjamanBarang')->with(compact('barang'));
        
    }
    public function EditPeminjamanBarang($id)
    {
        $peminjaman = Peminjaman::find($id);
        $barang = DetailDataBarang::where('status',  1)->where('kondisi_barang', 1)->get();

        return view('pages/admin/editPeminjamanBarang')->with(compact('barang','peminjaman'));
        
    }
    public function TambahPeminjamanBarangAksi(Request $req)
    {
        $validate = $req->validate([
            'nama_peminjam' => ['required'],
            'barang' => ['required'],

        ],
        [
            'nama_peminjam.required' => 'Kolom Nama Peminjam harus diisi!',
            'barang.required' => 'Kolom Barang harus diisi!',
            

            
        ]);

       $id_peminjaman = Peminjaman::create([
           'nama_peminjam' => $req->nama_peminjam,
           'tgl_peminjaman' => date('Y-m-d'),
       ])->id;

       foreach($req->barang as $item){
           DetailPeminjaman::create([
               'id_peminjaman' => $id_peminjaman,
               'id_barang' => $item,
           ]);
           DetailDataBarang::find($item)->update([
            'kondisi_barang' => 3
        ]);
       }
       Alert::success('Berhasil', 'Berhasil Meminjam Barang!');
       return redirect('dataPeminjaman');

    }
    public function EditPeminjamanBarangAksi(Request $req)
    {
        $validate = $req->validate([
            'nama_peminjam' => ['required'],

        ],
        [
            'nama_peminjam.required' => 'Kolom Nama Peminjam harus diisi!',
            

            
        ]);

        Peminjaman::find($req->id)->update([
           'nama_peminjam' => $req->nama_peminjam,
       ]);
       if ($req->barang !== NULL ) {
            foreach($req->barang as $item){
                DetailPeminjaman::create([
                    'id_peminjaman' => $req->id,
                    'id_barang' => $item,
                ]);
                DetailDataBarang::find($item)->update([
                    'kondisi_barang' => 3
                ]);
            }
        }
       Alert::success('Berhasil', 'Berhasil Edit Peminjaman Barang!');
       return redirect('dataPeminjaman');

    }

    public function LihatPeminjamanBarang($id)
    {
        $peminjaman = DetailPeminjaman::where('id_peminjaman',$id)->get();
        $data_nama = Peminjaman::find($id);
        return view('pages/admin/lihatPeminjamanBarang')->with(compact('peminjaman','data_nama',));
    }

    public function DistribusiBarang()
    {
        $barang = DistribusiBarang::where('status', 1)->get();
        return view('pages/admin/distribusiBarang')->with('data_barang', $barang);
    }
    public function TambahDistribusi()
    {
        $lokasi = Lokasi::all();
        $barang = DetailDataBarang::where('status',  1)->where('kondisi_barang', 1)->get();

        return view('pages/admin/tambahDistribusi')->with(compact('barang','lokasi'));
        
    }
    public function HapusBarangDistribusi($id)
    {

        $data_barang = DetailDistribusiBarang::find($id);

        DetailDataBarang::find($data_barang->id_barang)->update([
            'kondisi_barang' => 1
        ]);

        Alert::success('Berhasil', 'Berhasil menghapus Data Barang!');
        DetailDistribusiBarang::find($id)->delete();
        return redirect()->back();
        
    }
    public function HapusDistribusi($id)
    {

        $data_barang = DetailDistribusiBarang::where('id_distribusi', $id)->get();

        foreach($data_barang as $item){
            $detailDataBarang = DetailDataBarang::find($item->id_barang);
        
            if ($detailDataBarang) {
                $detailDataBarang->update([
                    'kondisi_barang' => 1
                ]);
            }
        }

        Alert::success('Berhasil', 'Berhasil menghapus Data Barang!');
        DetailDistribusiBarang::where('id_distribusi', $id)->delete();
        DistribusiBarang::find($id)->delete();
        return redirect()->back();
        
    }
    public function EditDistribusi($id)
    {
        $lokasi = Lokasi::all();

        $distribusi = DistribusiBarang::find($id);
        $barang = DetailDataBarang::where('status',  1)->where('kondisi_barang', 1)->get();

        return view('pages/admin/editDistribusi')->with(compact('barang','distribusi','lokasi'));
        
    }
    public function EditDistribusiAksi(Request $req)
    {
        $validate = $req->validate([
            'penanggung_jawab' => ['required'],
            'ruangan' => ['required'],

        ],
        [
            'penanggung_jawab.required' => 'Kolom Penanggung Jawab harus diisi!',
            'ruangan.required' => 'Kolom Ruangan harus diisi!',
            

            
        ]);

        DistribusiBarang::find($req->id)-> update([
           'penanggung_jawab' => $req->penanggung_jawab,
           'ruangan' => $req->ruangan,
           'keterangan' => $req->keterangan,
       ]);
       if ($req->barang !== NULL ) {
            foreach($req->barang as $item){
                DetailDistribusiBarang::create([
                    'id_distribusi' => $req->id,
                    'id_barang' => $item,
                ]);
                DetailDataBarang::find($item)->update([
                    'kondisi_barang' => 4
                ]);
            }
        }
       Alert::success('Berhasil', 'Berhasil Edit Distribusi Barang!');
       return redirect('distribusiDataBarang');

    }
    public function TambahDistribusiAksi(Request $req)
    {
        $validate = $req->validate([
            'penanggung_jawab' => ['required'],
            'barang' => ['required'],
            'ruangan' => ['required'],

        ],
        [
            'penanggung_jawab.required' => 'Kolom Penanggung Jawab harus diisi!',
            'barang.required' => 'Kolom Barang harus diisi!',
            'ruangan.required' => 'Kolom Ruangan harus diisi!',
            

            
        ]);

       $id_distribusi = DistribusiBarang::create([
           'tanggal_distribusi' => date('Y-m-d'),
           'penanggung_jawab' => $req->penanggung_jawab,
           'ruangan' => $req->ruangan,
           'keterangan' => $req->keterangan,
           'status' => 0,

       ])->id;

       foreach($req->barang as $item){
           DetailDistribusiBarang::create([
               'id_distribusi' => $id_distribusi,
               'id_barang' => $item,
           ]);
           DetailDataBarang::find($item)->update([
            'kondisi_barang' => 4
        ]);
       }
       Alert::info('Berhasil', 'Menunggu Konfirmasi dari Verifikator!');
       return redirect('distribusiDataBarang');

    }
    
    public function HapusPeminjamanBarang($id)
    {

        $data_barang = DetailPeminjaman::where('id_peminjaman', $id)->get();

        foreach($data_barang as $item){
            DetailDataBarang::find($item->id_barang)->update([
             'kondisi_barang' => 1
         ]);
        }

        Alert::success('Berhasil', 'Berhasil menghapus Data Barang!');
        DetailPeminjaman::where('id_peminjaman', $id)->delete();
        Peminjaman::find($id)->delete();
        return redirect()->back();
        
    }
    public function HapusBarangPeminjaman($id)
    {

        $data_barang = DetailPeminjaman::find($id);

        DetailDataBarang::find($data_barang->id_barang)->update([
            'kondisi_barang' => 1
        ]);

        Alert::success('Berhasil', 'Berhasil menghapus Data Barang!');
        DetailPeminjaman::find($id)->delete();
        return redirect()->back();
        
    }
    public function Pengembalian($id)
    {
        $data_barang = DetailPeminjaman::where('id_peminjaman', $id)->get();
        
        foreach($data_barang as $item){
            DetailDataBarang::find($item->id_barang)->update([
             'kondisi_barang' => 1
         ]);
        }

        Alert::success('Berhasil', 'Pengembalian Data Barang Berhasil!');
        DetailPeminjaman::where('id_peminjaman', $id)->update(['status' => 1]);
        Peminjaman::find($id)->update(['tgl_pengembalian' => date('Y-m-d')]);
        return redirect()->back();
    }
    public function VerifBarang()
    {
        
        $barang = DetailDataBarang::where('status', 0)->get();  

        return view('pages/admin/verifBarang')->with(compact('barang'));
    }
    public function VerifDistribusi()
    {
        
        $barang = DistribusiBarang::where('status', 0)->get();

        return view('pages/admin/verifDistribusi')->with(compact('barang'));
    }
    public function EditVerifBarang(Request $req, $id)
    {
        $data_barang = DetailDataBarang::find($id);
        
        // Validate the incoming request
        $validatedData = $req->validate([
            'kode_barang' => ['required', 'unique:detail_data_barang'], 
        ], [
            'kode_barang.required' => 'Kolom Kode Barang harus diisi!',
            'kode_barang.unique' => 'Kode barang yang anda pilih sudah terdaftar!',
        ]);
    
        // If validation passes, update the record
        $data_barang->update([
            'kode_barang' => $req->input('kode_barang'),
            'status' => 1,
        ]);
        
        Alert::success('Berhasil', 'Verifikasi Barang Berhasil!');
        
        // Return success response if everything went well
        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil diverifikasi!',
            'redirect_url' => url('lihat-data-barang/' . $data_barang->id_data_barang),
        ]);
    }
    
    public function EditVerifDistribusi($id)
    {

       
        DistribusiBarang::find($id)->update([
            'status' => 1,
        ]);
        Alert::success('Berhasil', 'Verifikasi Distribusi Berhasil!');
        return redirect('distribusiDataBarang');
        
    }
    public function Laporan()
    {
        return view('pages/admin/laporan');
        
    }
    public function LaporanPeminjaman(Request $req)
    {
        $tglawal = $req->tglawal;
        
        $tglakhir = $req->tglakhir;

        $peminjaman = Peminjaman::whereBetween('tgl_peminjaman', [$tglawal, $tglakhir])->where('tgl_pengembalian','!=', NULL)->get();
       
        return view('pages/admin/laporanPeminjaman')->with(compact('peminjaman','tglawal','tglakhir'));
        
    }
    public function LaporanDistribusi(Request $req)
    {
        $tglawal = $req->tglaw;
        $tglakhir = $req->tglak;

        $distribusi = DistribusiBarang::whereBetween('tanggal_distribusi', [$tglawal, $tglakhir])->where('status', 1)->get();
       
        return view('pages/admin/laporanDistribusi')->with(compact('distribusi','tglawal','tglakhir'));
        
    }
    


}
