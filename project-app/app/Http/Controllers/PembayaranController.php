<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Siswa;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {

        // Start with a base query
        $query = Pembayaran::query();

        // Get filter date, default to today if not set
        $filterDate = $request->filter_date ?? date('Y-m-d');

        // Apply date filter
        $query->whereDate('tanggal_pembayaran', $filterDate);

        // Get filtered results with siswa relationship
        $list_pembayaran = $query->with('siswa')->get();

        return view('pembayaran.index', compact('list_pembayaran', 'filterDate'));
    }

    public function create()
    {
        $list_siswa = Siswa::all();
        return view('pembayaran.create', compact('list_siswa'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'siswa_id' => 'required|unique:pembayaran,siswa_id',
                'tanggal_pembayaran' => 'required',
                'jumlah' => 'required',
                'status_pembayaran' => 'required',
                'deskripsi' => 'max:100'
            ]);

            Pembayaran::create([
                'siswa_id' => $request->siswa_id,
                'tanggal_pembayaran' => $request->tanggal_pembayaran,
                'jumlah' => $request->jumlah,
                'status_pembayaran' => $request->status_pembayaran,
                'deskripsi' => $request->deskripsi
            ]);

            return redirect()->route('pembayaran')->with('success', 'Pembayaran Berhasil Ditambahkan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function destroy(Pembayaran  $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('pembayaran')->with('success', 'Pembayaran berhasil Dihapus');
    }
}
