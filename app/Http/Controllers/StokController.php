<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\BarangModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok Barang',
            'list' => ['Home', 'Stok']
        ];
        $page = (object) [
            'title' => 'Daftar stok barang yang terdaftar dalam sistem'
        ];
        $activeMenu = 'stok';

        return view('stok.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
{
    $stok = StokModel::select('stok_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
                ->with(['barang', 'user']); // Pastikan relasi ini ada di Model

    return DataTables::of($stok)
        ->addIndexColumn()
        ->addColumn('aksi', function ($stok) {
            $btn  = '<a href="'.url('/stok/' . $stok->stok_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/stok/' . $stok->stok_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/stok/'.$stok->stok_id).'">'.
                        csrf_field().method_field('DELETE').
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
}
public function create()
{
    $breadcrumb = (object) [
        'title' => 'Tambah Stok',
        'list'  => ['Home', 'Stok', 'Tambah']
    ];
    $page = (object) [
        'title' => 'Tambah stok baru'
    ];

    $barang = BarangModel::all(); // Untuk dropdown pilihan barang
    $user = UserModel::all();     // Untuk dropdown pilihan user
    $activeMenu = 'stok';

    return view('stok.create', compact('breadcrumb', 'page', 'barang', 'user', 'activeMenu'));
    }
}