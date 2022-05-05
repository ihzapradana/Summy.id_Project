<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    public function index()
    {

        $title = "Riwayat Pendapatan";
        $pendapatans = Pendapatan::all()->sortByDesc('tanggal');
        return view('pendapatan.index', ['title' => $title, 'pendapatans' => $pendapatans]);
    }
}