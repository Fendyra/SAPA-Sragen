<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan baris ini ada!

class ReportController extends Controller
{
    /**
     * Menampilkan daftar aduan milik user yang sedang login.
     */
    public function index()
    {
        // GANTI INI: Pakai Auth::id() biar gak error di VS Code
        $userId = Auth::id(); 

        $reports = Complaint::where('user_id', $userId)
            ->with('category')
            ->when(request('status'), function ($query) {
                return $query->where('status', request('status'));
            })
            ->when(request('search'), function ($query) {
                return $query->where(function ($q) {
                    $q->where('title', 'like', '%' . request('search') . '%')
                        ->orWhere('ticket_code', 'like', '%' . request('search') . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('reports.index', compact('reports'));
    }

    /**
     * Menampilkan aduan publik.
     */
    public function public()
    {
        $reports = Complaint::with(['user', 'category'])
            ->where('status', '!=', 'ditolak')
            ->when(request('search'), function ($query) {
                return $query->where(function ($q) {
                    $q->where('title', 'like', '%' . request('search') . '%')
                        ->orWhere('description', 'like', '%' . request('search') . '%')
                        ->orWhere('location', 'like', '%' . request('search') . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('reports.public', compact('reports'));
    }

    /**
     * Form buat aduan baru.
     */
    public function create()
    {
        $categories = Category::all();
        return view('reports.create', compact('categories'));
    }

    /**
     * PROSES SIMPAN ADUAN
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'description' => 'required|string',
            'district' => 'required|string',
            'village' => 'required|string',
            'address' => 'required|string',
            'files.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('files')) {
            $file = $request->file('files')[0]; 
            $imagePath = $file->store('aduan-images', 'public'); 
        }

        $categoryId = $request->category_id;
        if (!is_numeric($request->category_id)) {
            $cat = Category::where('name', 'like', '%' . $request->category_id . '%')->first();
            $categoryId = $cat ? $cat->id : 1; 
        }

        $fullLocation = $validated['address'] . ', Desa ' . $validated['village'] . ', Kec. ' . $validated['district'];

        $complaint = Complaint::create([
            'user_id' => Auth::id(), // GANTI JADI Auth::id()
            'category_id' => $categoryId,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $fullLocation,
            'image' => $imagePath, 
            'status' => 'pending', 
        ]);

        return redirect()->route('reports.show', $complaint->id)
            ->with('success', 'Laporan berhasil dikirim! Kode Tiket Anda: ' . $complaint->ticket_code);
    }

    /**
     * Detail Aduan
     */
    public function show($id)
    {
        $report = Complaint::with(['user', 'category', 'responses'])->findOrFail($id);

        // Ganti auth()->check() jadi Auth::check()
        if (Auth::check() && $report->user_id != Auth::id() && Auth::user()->role == 'warga') {
             // Opsional: abort(403);
        }

        return view('reports.show', compact('report'));
    }
}