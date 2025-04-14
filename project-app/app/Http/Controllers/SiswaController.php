<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;

class SiswaController extends Controller
{
    public function index()
    {
        $query = Siswa::query();;

        $list_siswa = $query->with(['user', 'kelas'])->get();
        return view('siswa.index', compact('list_siswa'));
    }

    public function profile()
    {
        $data_siswa = Siswa::where('user_id', Auth::id())->get();
        return view('siswa.profile', compact('data_siswa'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email',
            'nim' => 'required|string|max:12|unique:siswa,nim',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'status' => 'boolean',
            'alamat' => 'required|string|max:100',
            'agama' => 'required|in:1,2,3,4,5,6,7',
            'no_watshapp' => 'required|string',
            'tentang_saya' => 'nullable|string',
        ]);

        try {
            // Tambahkan user_id dari user yang sedang login
            $validated['user_id'] = Auth::id();

            // Ambil kelas_id dari tabel kelas (misalnya kelas pertama)
            $kelas = Kelas::first(); // Atau logika lain untuk menentukan kelas_id
            $validated['kelas_id'] = $kelas ? $kelas->id : null; // Menyimpan kelas_id jika ada

            // Buat record siswa baru
            Siswa::create($validated);

            return redirect()->route('kelas')->with('success', 'Berhasil Menambahkan Data siswa');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }
}
