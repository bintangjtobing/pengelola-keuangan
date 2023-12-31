<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategori_transaksiRequest;
use App\Http\Requests\UpdateKategori_transaksiRequest;
use App\Models\Jenis_transaksi;
use App\Models\Kategori_transaksi;
use App\Models\Kategori_anggaran;
use App\Helper\DatabaseHelper;
use App\Models\Transaksi;
use Clockwork\Request\Request;
use Illuminate\Support\Facades\DB;


// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;

class KategoriTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.kategori.index', [
            'jenis_transaksi' => Jenis_transaksi::all(),
            'kategori_transaksi' => Kategori_transaksi::where('default', true)->orWhere('user_id', auth()->user()->id)->with('jenis_transaksi')->paginate(20),
            'user' => DatabaseHelper::getUser()[0]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategori_transaksiRequest $request)
    {
        $validate = $request->validate([
            'nama' => 'required|max:255',
            'jenis_transaksi_id' => 'required',
        ]);

        $validate['user_id'] = auth()->user()->id;

        Kategori_transaksi::create($validate);

        return redirect('/kategori_transaksi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori_transaksi $kategori_transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori_transaksi $kategori_transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategori_transaksiRequest $request, Kategori_transaksi $kategori_transaksi)
    {
        $validate = $request->validate([
            'nama' => 'required|max:255',
            'jenis_transaksi_id' => 'required',
        ]);

        Kategori_transaksi::where('id', request()->id)
                            ->update($validate);

        return redirect('/kategori_transaksi');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori_transaksi $kategori_transaksi)
    {
        Kategori_transaksi::destroy(request()->id);

    }


    public function api() {
        $results = Kategori_transaksi::where(function ($query) {
            $query->where('jenis_transaksi_id', request()->id)
                  ->where('user_id', auth()->user()->id);
        })->orWhere(function ($query) {
            $query->where('jenis_transaksi_id', request()->id)
                  ->where('default', true);
        })->get();

        return $results;

    }

    public function api2()
    {
        return Kategori_transaksi::where('id', request()->id)->get();
    }

    public function api3()
    {
        return Kategori_transaksi::where('jenis_transaksi_id', request()->id)->get();
    }

    public function api4() {
        return Kategori_transaksi::where('default', true)
                                ->whereIn('jenis_transaksi_id', [request()->id1, request()->id2])
                                ->orWhere('user_id', auth()->user()->id)
                                ->get();

    }

    public function api5() {
        return Kategori_transaksi::where('nama', 'like', '%' . request('search') . '%')->get();
    }

    public function api6() {
        if(request()->id == 'all') {
            return Kategori_transaksi::all();
        }else{
            return Kategori_transaksi::where('jenis_transaksi_id', request()->id)->get();
        }
    }

    public function getAllTransaksi()
    {
        return Kategori_transaksi::where('default', true)
                                  ->orWhere('user_id', auth()->user()->id)
                                  ->get();
    }


    public function manageKategori()
    {
        return view('dashboard.admin.manageKategori.index', [
            'jenis_transaksi' => Jenis_transaksi::all(),
            'kategori_transaksi' => Kategori_transaksi::where('default', true)->with('jenis_transaksi')->paginate(20),
            'user' => DatabaseHelper::getUser()[0]
        ]);
    }

    public function storeByAdmin(Request $request)
    {
        $validate = request()->validate([
            'nama' => 'required|max:255',
            'jenis_transaksi_id' => 'required',
        ]);
        $validate['user_id'] = 0;
        $validate['default'] = 1;

        Kategori_transaksi::create($validate);

        return redirect('/manage-kategori');
    }
}
