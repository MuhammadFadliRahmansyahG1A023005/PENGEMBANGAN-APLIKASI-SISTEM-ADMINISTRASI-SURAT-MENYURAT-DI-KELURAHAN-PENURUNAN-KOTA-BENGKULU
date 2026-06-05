<?php

namespace App\Http\Controllers;

use App\Models\ArsipModel;
use App\Models\SettingModel;
use App\Models\SuratModel;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PanelController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $data['user'] = DB::table('users')
            ->where('id', $user->id)
            ->first();

        if ($user->role != 'Warga') {

            $data['total_user'] = DB::table('users')
                ->where('role', 'Warga')
                ->count();

            $data['total_surat'] = DB::table('surat')->count();

            $data['total_sktm'] = DB::table('surat')->where('jenis', 'SKTM')->count();
            $data['total_sku'] = DB::table('surat')->where('jenis', 'SKU')->count();
            $data['total_rekomendasi'] = DB::table('surat')->where('jenis', 'Rekomendasi')->count();
            $data['total_nikah'] = DB::table('surat')->where('jenis', 'Nikah')->count();

            $data['pending'] = DB::table('surat')->where('status', 'Pending')->count();
            $data['diterima'] = DB::table('surat')->where('status', 'Diterima')->count();
            $data['ditolak'] = DB::table('surat')->where('status', 'Ditolak')->count();
        } else {


            $data['total_surat'] = DB::table('surat')
                ->where('user_id', $user->id)
                ->count();

            $data['total_sktm'] = DB::table('surat')
                ->where('user_id', $user->id)
                ->where('jenis', 'SKTM')
                ->count();

            $data['total_sku'] = DB::table('surat')
                ->where('user_id', $user->id)
                ->where('jenis', 'SKU')
                ->count();

            $data['total_rekomendasi'] = DB::table('surat')
                ->where('user_id', $user->id)
                ->where('jenis', 'Rekomendasi')
                ->count();

            $data['total_nikah'] = DB::table('surat')
                ->where('user_id', $user->id)
                ->where('jenis', 'Nikah')
                ->count();

            $data['pending'] = DB::table('surat')
                ->where('user_id', $user->id)
                ->where('status', 'Pending')
                ->count();

            $data['diterima'] = DB::table('surat')
                ->where('user_id', $user->id)
                ->where('status', 'Diterima')
                ->count();

            $data['ditolak'] = DB::table('surat')
                ->where('user_id', $user->id)
                ->where('status', 'Ditolak')
                ->count();
        }

        return view('panel.dashboard', $data);
    }

    public function warga()
    {
        $data['warga'] = User::where('role', 'Warga')->get();

        return view('panel.warga', $data);
    }

    public function wargasimpan(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:3',
            'alamat' => 'required',
            'jeniskelamin' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'nik' => '-',
            'nokk' => '-',
            'jeniskelamin' => $request->jeniskelamin,
            'role' => 'Warga',
        ]);

        return redirect('panel/warga')->with('success', 'Data Warga berhasil disimpan!');
    }

    public function wargaedit($id)
    {
        $data['warga'] = User::where('id', $id)->first();

        return view('panel.wargaedit', $data);
    }

    public function wargaupdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'alamat' => 'required',
            'jeniskelamin' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'jeniskelamin' => $request->jeniskelamin,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($data);

        return redirect('panel/warga')->with('success', 'Data Warga berhasil diupdate!');
    }

    public function wargahapus($id)
    {
        SuratModel::where('user_id', $id)->delete();

        User::where('id', $id)->delete();

        return redirect('panel/warga')->with('success', 'Data Warga berhasil dihapus!');
    }

    // staff
    public function staff()
    {
        $data['staff'] = User::where('role', 'Staff')->get();
        return view('panel.staff', $data);
    }

    public function staffsimpan(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'alamat' => 'required',
            'nik' => 'required|numeric',
            'nokk' => 'required|numeric',
            'jeniskelamin' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'nik' => $request->nik,
            'nokk' => $request->nokk,
            'jeniskelamin' => $request->jeniskelamin,
            'role' => 'Staff',
        ]);

        return redirect('panel/staff')->with('success', 'Data Staff berhasil disimpan!');
    }

    public function staffedit($id)
    {
        $data['staff'] = User::where('id', $id)->first();
        return view('panel.staffedit', $data);
    }

    public function staffupdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'alamat' => 'required',
            'nik' => 'required|numeric',
            'nokk' => 'required|numeric',
            'jeniskelamin' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'nik' => $request->nik,
            'nokk' => $request->nokk,
            'jeniskelamin' => $request->jeniskelamin,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($data);

        return redirect('panel/staff')->with('success', 'Data Staff berhasil diupdate!');
    }

    public function staffhapus($id)
    {
        SuratModel::where('user_id', $id)->delete();
        User::where('id', $id)->delete();

        return redirect('panel/staff')->with('success', 'Data Staff berhasil dihapus!');
    }

    // riwayatpengajuan
    public function riwayatpengajuan()
    {
        $data['riwayatpengajuan'] = SuratModel::where('user_id', Auth::id())->orderBy('id', 'desc')->get();


        return view('panel.riwayatpengajuan', $data);
    }

    // suratmasuk
    public function suratmasuk()
    {
        if (Auth::user()->role == 'Warga') {
            $data['suratmasuk'] = SuratModel::where('user_id', Auth::id())->where('status', '!=', 'Diterima')->orderBy('id', 'desc')->get();
        } else {
            $data['suratmasuk'] = SuratModel::where('status', '!=', 'Diterima')->orderBy('id', 'desc')->get();
        }

        return view('panel.suratmasuk', $data);
    }

    public function suratmasuktambah()
    {
        $data['warga'] = User::where('role', 'Warga')->get();
        return view('panel.suratmasuktambah', $data);
    }

    public function suratmasuksimpan(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'nama' => 'required',
            'user_id' => 'required'
        ]);

        $data = [
            'user_id' => $request->user_id,
            'jenis' => $request->jenis,
            'nama' => $request->nama,
            'kebutuhan' => $request->kebutuhan,
            'dibawa_ke_kantor' => $request->has('dibawa_ke_kantor') ? 'Ya' : 'Tidak',
            'status' => 'Pending'
        ];

        switch ($request->jenis) {

            case 'SKTM':
                $request->validate([
                    'suratpengantar' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'ktp' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'kk' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'suratpernyataan' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'foto' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                ]);

                $suratpengantar = $request->file('suratpengantar');
                $suratpengantarHash = $suratpengantar->hashName();
                $suratpengantar->storeAs('suratpengantar', $suratpengantarHash, 'public');

                $ktp = $request->file('ktp');
                $ktpHash = $ktp->hashName();
                $ktp->storeAs('ktp', $ktpHash, 'public');

                $kk = $request->file('kk');
                $kkHash = $kk->hashName();
                $kk->storeAs('kk', $kkHash, 'public');

                $suratpernyataan = $request->file('suratpernyataan');
                $suratpernyataanHash = $suratpernyataan->hashName();
                $suratpernyataan->storeAs('suratpernyataan', $suratpernyataanHash, 'public');

                $foto = $request->file('foto');
                $fotoHash = $foto->hashName();
                $foto->storeAs('foto', $fotoHash, 'public');

                $data += [
                    'jeniskelamin' => $request->jeniskelamin,
                    'tempatlahir' => $request->tempatlahir,
                    'tanggallahir' => $request->tanggallahir,
                    'agama' => $request->agama,
                    'pekerjaan' => $request->pekerjaan,
                    'nik' => $request->nik,
                    'alamat' => $request->alamat,
                    'statusperkawinan' => $request->statusperkawinan,
                    'suratpengantar' => $suratpengantarHash,
                    'ktp' => $ktpHash,
                    'kk' => $kkHash,
                    'suratpernyataan' => $suratpernyataanHash,
                    'foto' => $fotoHash,
                ];
                break;

            case 'SKU':
                $request->validate([
                    'suratpengantar' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'ktp' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'kk' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'suratpermohonan' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'foto' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                ]);

                $suratpengantar = $request->file('suratpengantar');
                $suratpengantarHash = $suratpengantar->hashName();
                $suratpengantar->storeAs('suratpengantar', $suratpengantarHash, 'public');

                $ktp = $request->file('ktp');
                $ktpHash = $ktp->hashName();
                $ktp->storeAs('ktp', $ktpHash, 'public');

                $kk = $request->file('kk');
                $kkHash = $kk->hashName();
                $kk->storeAs('kk', $kkHash, 'public');

                $suratpermohonan = $request->file('suratpermohonan');
                $suratpermohonanHash = $suratpermohonan->hashName();
                $suratpermohonan->storeAs('suratpermohonan', $suratpermohonanHash, 'public');

                $foto = $request->file('foto');
                $fotoHash = $foto->hashName();
                $foto->storeAs('foto', $fotoHash, 'public');

                // Auto create column for pbb_lunas if not exists
                if (!\Illuminate\Support\Facades\Schema::hasColumn('surat', 'pbb_lunas')) {
                    \Illuminate\Support\Facades\Schema::table('surat', function (\Illuminate\Database\Schema\Blueprint $table) {
                        $table->string('pbb_lunas')->nullable()->after('dibawa_ke_kantor');
                    });
                }

                $data += [
                    'jeniskelamin' => $request->jeniskelamin,
                    'tempatlahir' => $request->tempatlahir,
                    'tanggallahir' => $request->tanggallahir,
                    'agama' => $request->agama,
                    'pekerjaan' => $request->pekerjaan,
                    'nik' => $request->nik,
                    'alamat' => $request->alamat,
                    'masaberlakuawal' => $request->masaberlakuawal,
                    'masaberlakusampai' => $request->masaberlakusampai,
                    'namausaha' => $request->namausaha,
                    'lokasiusaha' => $request->lokasiusaha,
                    'suratpengantar' => $suratpengantarHash,
                    'ktp' => $ktpHash,
                    'kk' => $kkHash,
                    'suratpermohonan' => $suratpermohonanHash,
                    'foto' => $fotoHash,
                    'pbb_lunas' => $request->has('pbb_lunas') ? 'Ya' : 'Tidak',
                ];
                break;

            case 'Rekomendasi':
                $request->validate([
                    'suratpengantar' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'ktp' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'kk' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'suratpermohonan' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'suratpernyataan' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'proposalkegiatan' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                ]);

                $suratpengantar = $request->file('suratpengantar');
                $suratpengantarHash = $suratpengantar->hashName();
                $suratpengantar->storeAs('suratpengantar', $suratpengantarHash, 'public');

                $ktp = $request->file('ktp');
                $ktpHash = $ktp->hashName();
                $ktp->storeAs('ktp', $ktpHash, 'public');

                $kk = $request->file('kk');
                $kkHash = $kk->hashName();
                $kk->storeAs('kk', $kkHash, 'public');

                $suratpermohonan = $request->file('suratpermohonan');
                $suratpermohonanHash = $suratpermohonan->hashName();
                $suratpermohonan->storeAs('suratpermohonan', $suratpermohonanHash, 'public');

                $suratpernyataan = $request->file('suratpernyataan');
                $suratpernyataanHash = $suratpernyataan->hashName();
                $suratpernyataan->storeAs('suratpernyataan', $suratpernyataanHash, 'public');

                $proposalkegiatan = $request->file('proposalkegiatan');
                $proposalkegiatanHash = $proposalkegiatan->hashName();
                $proposalkegiatan->storeAs('proposalkegiatan', $proposalkegiatanHash, 'public');

                $data += [
                    'jabatan' => $request->jabatan,
                    'namausaha' => $request->namausaha,
                    'nib' => $request->nib,
                    'npwp' => $request->npwp,
                    'alamatperusahaan' => $request->alamatperusahaan,
                    'notelpon' => $request->notelpon,
                    'email' => $request->email,
                    'kodekbli' => $request->kodekbli,
                    'lokasiusaha' => $request->lokasiusaha,
                    'suratpengantar' => $suratpengantarHash,
                    'ktp' => $ktpHash,
                    'kk' => $kkHash,
                    'suratpermohonan' => $suratpermohonanHash,
                    'suratpernyataan' => $suratpernyataanHash,
                    'proposalkegiatan' => $proposalkegiatanHash,
                ];
                break;


            case 'Rekomendasi Nikah':
                $request->validate([
                    'suratpengantar' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'formulir_n1_n2_n4' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'ktp' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'kk' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'ktp_pasangan' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'akta_ijazah' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'pas_foto' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'surat_izin_ortu' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'akta_cerai_kematian' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                ]);

                // Auto create columns for Nikah fields
                if (!\Illuminate\Support\Facades\Schema::hasColumn('surat', 'formulir_n1_n2_n4')) {
                    \Illuminate\Support\Facades\Schema::table('surat', function (\Illuminate\Database\Schema\Blueprint $table) {
                        $table->string('formulir_n1_n2_n4')->nullable();
                        $table->string('ktp_pasangan')->nullable();
                        $table->string('akta_ijazah')->nullable();
                        $table->string('pas_foto')->nullable();
                        $table->string('surat_izin_ortu')->nullable();
                        $table->string('akta_cerai_kematian')->nullable();
                    });
                }

                $filesToUpload = ['suratpengantar', 'formulir_n1_n2_n4', 'ktp', 'kk', 'ktp_pasangan', 'akta_ijazah', 'pas_foto', 'surat_izin_ortu', 'akta_cerai_kematian'];

                foreach ($filesToUpload as $fileField) {
                    if ($request->hasFile($fileField)) {
                        $file = $request->file($fileField);
                        $fileHash = $file->hashName();
                        $file->storeAs($fileField, $fileHash, 'public');
                        $data[$fileField] = $fileHash;
                    }
                }

                $data += [
                    'jeniskelamin' => $request->jeniskelamin,
                    'tempatlahir' => $request->tempatlahir,
                    'tanggallahir' => $request->tanggallahir,
                    'agama' => $request->agama,
                    'pekerjaan' => $request->pekerjaan,
                    'nik' => $request->nik,
                    'alamat' => $request->alamat,
                    'statusperkawinan' => $request->statusperkawinan,
                ];
                break;
        }

        SuratModel::create($data);

        return redirect('panel/suratmasuk')->with('success', 'Surat berhasil diajukan!');
    }

    public function suratmasukedit($id)
    {
        $data['surat'] = SuratModel::findOrFail($id);
        $data['warga'] = User::where('role', 'Warga')->get();

        return view('panel.suratmasukedit', $data);
    }

    public function suratmasukupdate(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required',
            'nama' => 'required',
            'user_id' => 'required'
        ]);

        $surat = SuratModel::findOrFail($id);

        $data = [
            'user_id' => $request->user_id,
            'jenis' => $request->jenis,
            'nama' => $request->nama,
            'kebutuhan' => $request->kebutuhan,
            'dibawa_ke_kantor' => $request->has('dibawa_ke_kantor') ? 'Ya' : 'Tidak',
        ];

        switch ($request->jenis) {

            case 'SKTM':

                $request->validate([
                    'suratpengantar' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'ktp' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'kk' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'suratpernyataan' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                ]);

                if ($request->hasFile('suratpengantar')) {
                    if ($surat->suratpengantar) {
                        $existingFilePath = 'public/suratpengantar/' . $surat->suratpengantar;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                    $suratpengantar = $request->file('suratpengantar');
                    $suratpengantarHash = $suratpengantar->hashName();
                    $suratpengantar->storeAs('suratpengantar', $suratpengantarHash, 'public');
                    $data['suratpengantar'] = $suratpengantarHash;
                }

                if ($request->hasFile('ktp')) {
                    if ($surat->ktp) {
                        $existingFilePath = 'public/ktp/' . $surat->ktp;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                    $ktp = $request->file('ktp');
                    $ktpHash = $ktp->hashName();
                    $ktp->storeAs('ktp', $ktpHash, 'public');
                    $data['ktp'] = $ktpHash;
                }

                if ($request->hasFile('kk')) {
                    if ($surat->kk) {
                        $existingFilePath = 'public/kk/' . $surat->kk;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                    $kk = $request->file('kk');
                    $kkHash = $kk->hashName();
                    $kk->storeAs('kk', $kkHash, 'public');
                    $data['kk'] = $kkHash;
                }

                if ($request->hasFile('suratpernyataan')) {
                    if ($surat->suratpernyataan) {
                        $existingFilePath = 'public/suratpernyataan/' . $surat->suratpernyataan;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                    $suratpernyataan = $request->file('suratpernyataan');
                    $suratpernyataanHash = $suratpernyataan->hashName();
                    $suratpernyataan->storeAs('suratpernyataan', $suratpernyataanHash, 'public');
                    $data['suratpernyataan'] = $suratpernyataanHash;
                }

                if ($request->hasFile('foto')) {
                    if ($surat->foto) {
                        $existingFilePath = 'public/foto/' . $surat->foto;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                    $foto = $request->file('foto');
                    $fotoHash = $foto->hashName();
                    $foto->storeAs('foto', $fotoHash, 'public');
                    $data['foto'] = $fotoHash;
                }

                $data += [
                    'jeniskelamin' => $request->jeniskelamin,
                    'tempatlahir' => $request->tempatlahir,
                    'tanggallahir' => $request->tanggallahir,
                    'agama' => $request->agama,
                    'pekerjaan' => $request->pekerjaan,
                    'nik' => $request->nik,
                    'alamat' => $request->alamat,
                    'statusperkawinan' => $request->statusperkawinan,
                ];
                break;

            case 'SKU':

                $request->validate([
                    'suratpengantar' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'ktp' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'kk' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'suratpermohonan' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                ]);

                if ($request->hasFile('suratpengantar')) {
                    if ($surat->suratpengantar) {
                        $existingFilePath = 'public/suratpengantar/' . $surat->suratpengantar;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                    $suratpengantar = $request->file('suratpengantar');
                    $suratpengantarHash = $suratpengantar->hashName();
                    $suratpengantar->storeAs('suratpengantar', $suratpengantarHash, 'public');
                    $data['suratpengantar'] = $suratpengantarHash;
                }

                if ($request->hasFile('ktp')) {
                    if ($surat->ktp) {
                        $existingFilePath = 'public/ktp/' . $surat->ktp;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                    $ktp = $request->file('ktp');
                    $ktpHash = $ktp->hashName();
                    $ktp->storeAs('ktp', $ktpHash, 'public');
                    $data['ktp'] = $ktpHash;
                }

                if ($request->hasFile('kk')) {
                    if ($surat->kk) {
                        $existingFilePath = 'public/kk/' . $surat->kk;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                    $kk = $request->file('kk');
                    $kkHash = $kk->hashName();
                    $kk->storeAs('kk', $kkHash, 'public');
                    $data['kk'] = $kkHash;
                }

                if ($request->hasFile('suratpermohonan')) {
                    if ($surat->suratpermohonan) {
                        $existingFilePath = 'public/suratpermohonan/' . $surat->suratpermohonan;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                    $suratpermohonan = $request->file('suratpermohonan');
                    $suratpermohonanHash = $suratpermohonan->hashName();
                    $suratpermohonan->storeAs('suratpermohonan', $suratpermohonanHash, 'public');
                    $data['suratpermohonan'] = $suratpermohonanHash;
                }

                if ($request->hasFile('foto')) {
                    if ($surat->foto) {
                        $existingFilePath = 'public/foto/' . $surat->foto;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                    $foto = $request->file('foto');
                    $fotoHash = $foto->hashName();
                    $foto->storeAs('foto', $fotoHash, 'public');
                    $data['foto'] = $fotoHash;
                }

                $data += [
                    'jeniskelamin' => $request->jeniskelamin,
                    'tempatlahir' => $request->tempatlahir,
                    'tanggallahir' => $request->tanggallahir,
                    'agama' => $request->agama,
                    'pekerjaan' => $request->pekerjaan,
                    'nik' => $request->nik,
                    'alamat' => $request->alamat,
                    'masaberlakuawal' => $request->masaberlakuawal,
                    'masaberlakusampai' => $request->masaberlakusampai,
                    'namausaha' => $request->namausaha,
                    'lokasiusaha' => $request->lokasiusaha,
                    'pbb_lunas' => $request->has('pbb_lunas') ? 'Ya' : 'Tidak',
                ];
                break;

            case 'Rekomendasi':
                $request->validate([
                    'suratpengantar' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'ktp' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'kk' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'suratpermohonan' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'suratpernyataan' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'proposalkegiatan' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                ]);

                if ($request->hasFile('suratpengantar')) {
                    if ($surat->suratpengantar) {
                        $existingFilePath = 'public/suratpengantar/' . $surat->suratpengantar;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                    $suratpengantar = $request->file('suratpengantar');
                    $suratpengantarHash = $suratpengantar->hashName();
                    $suratpengantar->storeAs('suratpengantar', $suratpengantarHash, 'public');
                    $data['suratpengantar'] = $suratpengantarHash;
                }

                if ($request->hasFile('ktp')) {
                    if ($surat->ktp) {
                        $existingFilePath = 'public/ktp/' . $surat->ktp;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                }

                if ($request->hasFile('kk')) {
                    if ($surat->kk) {
                        $existingFilePath = 'public/kk/' . $surat->kk;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                }

                if ($request->hasFile('suratpermohonan')) {
                    if ($surat->suratpermohonan) {
                        $existingFilePath = 'public/suratpermohonan/' . $surat->suratpermohonan;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                }

                if ($request->hasFile('suratpernyataan')) {
                    if ($surat->suratpernyataan) {
                        $existingFilePath = 'public/suratpernyataan/' . $surat->suratpernyataan;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                }

                if ($request->hasFile('proposalkegiatan')) {
                    if ($surat->proposalkegiatan) {
                        $existingFilePath = 'public/proposalkegiatan/' . $surat->proposalkegiatan;
                        if (file_exists(storage_path('app/' . $existingFilePath))) {
                            unlink(storage_path('app/' . $existingFilePath));
                        }
                    }
                }

                $data += [
                    'jabatan' => $request->jabatan,
                    'namausaha' => $request->namausaha,
                    'nib' => $request->nib,
                    'npwp' => $request->npwp,
                    'alamatperusahaan' => $request->alamatperusahaan,
                    'notelpon' => $request->notelpon,
                    'email' => $request->email,
                    'kodekbli' => $request->kodekbli,
                    'lokasiusaha' => $request->lokasiusaha,
                ];
                break;


                
            case 'Rekomendasi Nikah':
                $request->validate([
                    'suratpengantar' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'formulir_n1_n2_n4' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'ktp' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'kk' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'ktp_pasangan' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'akta_ijazah' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'pas_foto' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'surat_izin_ortu' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'akta_cerai_kematian' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                ]);

                $filesToUpload = ['suratpengantar', 'formulir_n1_n2_n4', 'ktp', 'kk', 'ktp_pasangan', 'akta_ijazah', 'pas_foto', 'surat_izin_ortu', 'akta_cerai_kematian'];

                foreach ($filesToUpload as $fileField) {
                    if ($request->hasFile($fileField)) {
                        if ($surat->$fileField) {
                            $existingFilePath = 'public/' . $fileField . '/' . $surat->$fileField;
                            if (file_exists(storage_path('app/' . $existingFilePath))) {
                                unlink(storage_path('app/' . $existingFilePath));
                            }
                        }
                        $file = $request->file($fileField);
                        $fileHash = $file->hashName();
                        $file->storeAs($fileField, $fileHash, 'public');
                        $data[$fileField] = $fileHash;
                    }
                }

                $data += [
                    'jeniskelamin' => $request->jeniskelamin,
                    'tempatlahir' => $request->tempatlahir,
                    'tanggallahir' => $request->tanggallahir,
                    'agama' => $request->agama,
                    'pekerjaan' => $request->pekerjaan,
                    'nik' => $request->nik,
                    'alamat' => $request->alamat,
                    'statusperkawinan' => $request->statusperkawinan,
                ];
                break;
        }

        $surat->update($data);

        return back()->with('success', 'Surat berhasil diupdate!');
    }

    public function suratmasukdetail($id)
    {
        $data['surat'] = SuratModel::with('user')->findOrFail($id);

        return view('panel.suratmasukdetail', $data);
    }

    public function suratupdatestatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $surat = SuratModel::with('user')->findOrFail($id);
        $oldStatus = $surat->status;
        $newStatus = $request->status;

        $surat->status = $newStatus;
        $surat->ttd_oleh = $request->ttd_oleh ?? 'Lurah';
        
        // Auto create column is_notified and ttd_oleh if not exists
        if (!\Illuminate\Support\Facades\Schema::hasColumn('surat', 'is_notified')) {
            \Illuminate\Support\Facades\Schema::table('surat', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->boolean('is_notified')->default(1)->after('status');
            });
        }
        if (!\Illuminate\Support\Facades\Schema::hasColumn('surat', 'ttd_oleh')) {
            \Illuminate\Support\Facades\Schema::table('surat', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->string('ttd_oleh')->default('Lurah')->after('status');
            });
        }

        // If status changed, we trigger notification
        if ($oldStatus != $newStatus) {
            $surat->is_notified = 0; // mark as unread notification

            // SEND EMAIL
            try {
                $userEmail = $surat->user->email;
                $userName = $surat->user->name;
                $jenisSurat = $surat->jenissurat;

                $mailData = [
                    'name' => $userName,
                    'jenis' => $jenisSurat,
                    'status' => $newStatus
                ];

                \Illuminate\Support\Facades\Mail::send([], [], function ($message) use ($userEmail, $userName, $mailData) {
                    $message->to($userEmail, $userName)
                        ->subject('Pembaruan Status Pengajuan Surat - SAPURAN')
                        ->html("
                            <h3>Halo {$mailData['name']},</h3>
                            <p>Status pengajuan <b>{$mailData['jenis']}</b> Anda telah diperbarui menjadi: <strong style='font-size:18px; color:#50a7c2'>{$mailData['status']}</strong>.</p>
                            <p>Silakan login ke sistem SAPURAN untuk melihat detail rinciannya.</p>
                            <br>
                            <p>Terima kasih,<br>Sistem Administrasi Kelurahan Penurunan</p>
                        ");
                });
            } catch (\Exception $e) {
                // Ignore email failure if SMTP not configured yet
                \Illuminate\Support\Facades\Log::error('Mail Error: ' . $e->getMessage());
            }
        }

        $surat->save();

        return back()->with('success', 'Status berhasil diupdate. Jika email terkonfigurasi, notifikasi telah dikirimkan!');
    }

    // WEB NOTIFICATION CHECKER (Real Time Ajax Polling)
    public function cekNotifikasi()
    {
        if (Auth::user()->role != 'Warga') {
            return response()->json(['count' => 0, 'data' => []]);
        }

        // Auto create if missing
        if (!\Illuminate\Support\Facades\Schema::hasColumn('surat', 'is_notified')) {
            \Illuminate\Support\Facades\Schema::table('surat', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->boolean('is_notified')->default(1)->after('status');
            });
        }

        $unread = SuratModel::where('user_id', Auth::id())
            ->where('is_notified', 0)
            ->get();

        if ($unread->count() > 0) {
            // mark as notified
            SuratModel::whereIn('id', $unread->pluck('id'))->update(['is_notified' => 1]);
        }

        return response()->json([
            'count' => $unread->count(),
            'data' => $unread
        ]);
    }

    public function suratmasukhapus($id)
    {
        $surat = SuratModel::findOrFail($id);

        if ($surat->suratpengantar) {
            $existingFilePath = 'public/suratpengantar/' . $surat->suratpengantar;
            if (file_exists(storage_path('app/' . $existingFilePath))) {
                unlink(storage_path('app/' . $existingFilePath));
            }
        }

        if ($surat->ktp) {
            $existingFilePath = 'public/ktp/' . $surat->ktp;
            if (file_exists(storage_path('app/' . $existingFilePath))) {
                unlink(storage_path('app/' . $existingFilePath));
            }
        }

        if ($surat->kk) {
            $existingFilePath = 'public/kk/' . $surat->kk;
            if (file_exists(storage_path('app/' . $existingFilePath))) {
                unlink(storage_path('app/' . $existingFilePath));
            }
        }

        if ($surat->suratpernyataan) {
            $existingFilePath = 'public/suratpernyataan/' . $surat->suratpernyataan;
            if (file_exists(storage_path('app/' . $existingFilePath))) {
                unlink(storage_path('app/' . $existingFilePath));
            }
        }

        if ($surat->suratpermohonan) {
            $existingFilePath = 'public/suratpermohonan/' . $surat->suratpermohonan;
            if (file_exists(storage_path('app/' . $existingFilePath))) {
                unlink(storage_path('app/' . $existingFilePath));
            }
        }

        if ($surat->foto) {
            $existingFilePath = 'public/foto/' . $surat->foto;
            if (file_exists(storage_path('app/' . $existingFilePath))) {
                unlink(storage_path('app/' . $existingFilePath));
            }
        }

        if ($surat->proposalkegiatan) {
            $existingFilePath = 'public/proposalkegiatan/' . $surat->proposalkegiatan;
            if (file_exists(storage_path('app/' . $existingFilePath))) {
                unlink(storage_path('app/' . $existingFilePath));
            }
        }

        if ($surat->proposalkegiatan) {
            $existingFilePath = 'public/proposalkegiatan/' . $surat->proposalkegiatan;
            if (file_exists(storage_path('app/' . $existingFilePath))) {
                unlink(storage_path('app/' . $existingFilePath));
            }
        }

        SuratModel::where('id', $id)->delete();

        return back()->with('success', 'Surat berhasil dihapus!');
    }

    // suratkeluar
    public function suratkeluar()
    {
        if (Auth::user()->role == 'Warga') {
            $data['suratkeluar'] = SuratModel::where('user_id', Auth::id())->where('status', 'Diterima')->orderBy('id', 'desc')->get();
        } else {
            $data['suratkeluar'] = SuratModel::where('status', 'Diterima')->orderBy('id', 'desc')->get();
        }

        return view('panel.suratkeluar', $data);
    }

    public function suratkeluardetail($id)
    {
        $data['surat'] = SuratModel::with('user')->findOrFail($id);

        return view('panel.suratmasukdetail', $data);
    }

    public function suratkeluarhapus($id)
    {
        SuratModel::where('id', $id)->delete();

        return back()->with('success', 'Surat berhasil dihapus!');
    }

    public function sktmcetak($id)
    {
        $surat = SuratModel::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('panel.sktmcetak', compact('surat'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('SKTM-' . $surat->nama . '.pdf');
    }

    public function skucetak($id)
    {
        $surat = SuratModel::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('panel.skucetak', compact('surat'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('SKU-' . $surat->nama . '.pdf');
    }

    public function rekomendasicetak($id)
    {
        $surat = SuratModel::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('panel.rekomendasicetak', compact('surat'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('REKOMENDASI-' . $surat->nama . '.pdf');
    }



    public function nikahcetak($id)
    {
        $surat = SuratModel::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('panel.nikahcetak', compact('surat'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('NIKAH-' . $surat->nama . '.pdf');
    }

    // setting
    public function setting()
    {
        $data['setting'] = SettingModel::where('id', 1)->first();

        return view('panel.setting', $data);
    }

    public function settingupdate(Request $request)
    {
        // Auto migration for setting table columns
        $newColumns = [
            'nama_kasi_pemerintahan', 'nip_kasi_pemerintahan',
            'nama_kasi_pembangunan', 'nip_kasi_pembangunan',
            'nama_kasi_pelayanan', 'nip_kasi_pelayanan',
            'nama_sekretaris', 'nip_sekretaris',
            'babinsa', 'bhabinkamtibmas', 'blpkb',
            'staf_pemerintahan', 'nip_staf_pemerintahan'
        ];
        
        foreach($newColumns as $col) {
            if (!\Illuminate\Support\Facades\Schema::hasColumn('setting', $col)) {
                \Illuminate\Support\Facades\Schema::table('setting', function (\Illuminate\Database\Schema\Blueprint $table) use ($col) {
                    $table->string($col)->nullable();
                });
            }
        }

        SettingModel::where('id', 1)->update([
            'namalurah' => $request->name,
            'nip' => $request->nip,
            'nama_sekretaris' => $request->nama_sekretaris,
            'nip_sekretaris' => $request->nip_sekretaris,
            'nama_kasi_pemerintahan' => $request->nama_kasi_pemerintahan,
            'nip_kasi_pemerintahan' => $request->nip_kasi_pemerintahan,
            'nama_kasi_pembangunan' => $request->nama_kasi_pembangunan,
            'nip_kasi_pembangunan' => $request->nip_kasi_pembangunan,
            'nama_kasi_pelayanan' => $request->nama_kasi_pelayanan,
            'nip_kasi_pelayanan' => $request->nip_kasi_pelayanan,
            'babinsa' => $request->babinsa,
            'bhabinkamtibmas' => $request->bhabinkamtibmas,
            'blpkb' => $request->blpkb,
            'staf_pemerintahan' => $request->staf_pemerintahan,
            'nip_staf_pemerintahan' => $request->nip_staf_pemerintahan,
        ]);

        return redirect('panel/setting')->with('success', 'Setting berhasil diupdate!');
    }

    // profile
    public function profile()
    {
        $data['profile'] = User::where('id', Auth::id())->first();

        return view('panel.profile', $data);
    }

    public function profileupdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . Auth::id(),
            'alamat' => 'required',
            'jeniskelamin' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'jeniskelamin' => $request->jeniskelamin,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoHash = $foto->hashName();
            $foto->storeAs('profil', $fotoHash, 'public');

            // Hapus foto lama
            if (Auth::user()->foto && file_exists(storage_path('app/public/profil/' . Auth::user()->foto))) {
                unlink(storage_path('app/public/profil/' . Auth::user()->foto));
            }
            $data['foto'] = $fotoHash;
        }

        User::where('id', Auth::id())->update($data);

        return redirect('panel/profile')->with('success', 'Profile berhasil diupdate!');
    }

    // arsip

    public function arsip()
    {
        $arsipRaw = ArsipModel::orderBy('tanggal', 'desc')->get();
        $data['arsip'] = $arsipRaw;
        
        $data['groupedArsip'] = $arsipRaw->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('F Y');
        });

        // Data for Chart
        $labels = [];
        $data_grafik = [];
        // To make chart chronological, we sort groups by actual date ascending
        $chartData = $arsipRaw->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->tanggal)->format('Y-m');
        })->sortKeys();

        foreach($chartData as $key => $items) {
            $monthLabel = \Carbon\Carbon::parse($key . '-01')->locale('id')->translatedFormat('F Y');
            $labels[] = $monthLabel;
            $data_grafik[] = $items->count();
        }

        $data['chart_labels'] = $labels;
        $data['chart_data'] = $data_grafik;

        return view('panel.arsip', $data);
    }

    public function arsipsimpan(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('file');
        $fileHash = $file->hashName();
        $file->storeAs('arsip', $fileHash, 'public');

        ArsipModel::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'file' => $fileHash,
        ]);

        return redirect('panel/arsip')->with('success', 'Arsip berhasil disimpan!');
    }

    public function arsipedit($id)
    {
        $data['arsip'] = ArsipModel::findOrFail($id);

        return view('panel.arsipedit', $data);
    }

    public function arsipupdate(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'required',
            'file' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $arsip = ArsipModel::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($arsip->file) {
                $existingFilePath = 'public/arsip/' . $arsip->file;
                if (file_exists(storage_path('app/' . $existingFilePath))) {
                    unlink(storage_path('app/' . $existingFilePath));
                }
            }

            $file = $request->file('file');
            $fileHash = $file->hashName();
            $file->storeAs('arsip', $fileHash, 'public');

            $arsip->update([
                'judul' => $request->judul,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'file' => $fileHash,
            ]);
        } else {
            $arsip->update([
                'judul' => $request->judul,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
            ]);
        }

        return redirect('panel/arsip')->with('success', 'Arsip berhasil diupdate!');
    }

    public function arsiphapus($id)
    {
        $arsip = ArsipModel::findOrFail($id);

        if ($arsip->file) {
            $existingFilePath = 'public/arsip/' . $arsip->file;
            if (file_exists(storage_path('app/' . $existingFilePath))) {
                unlink(storage_path('app/' . $existingFilePath));
            }
        }

        ArsipModel::where('id', $id)->delete();

        return back()->with('success', 'Arsip berhasil dihapus!');
    }
}
