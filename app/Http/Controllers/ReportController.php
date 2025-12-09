<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the user's reports.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = auth()->id();

        $reports = Report::where('user_id', $userId)
            ->when(request('status'), function ($query) {
                return $query->where('status', request('status'));
            })
            ->when(request('category'), function ($query) {
                return $query->where('category', request('category'));
            })
            ->when(request('search'), function ($query) {
                return $query->where(function ($q) {
                    $q->where('title', 'like', '%' . request('search') . '%')
                        ->orWhere('ticket_number', 'like', '%' . request('search') . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('reports.index', compact('reports'));
    }

    /**
     * Display public reports accessible to all users.
     *
     * @return \Illuminate\View\View
     */
    public function public()
    {
        $reports = Report::with('user')
            ->where('is_public', true)
            ->when(request('search'), function ($query) {
                return $query->where(function ($q) {
                    $q->where('title', 'like', '%' . request('search') . '%')
                        ->orWhere('description', 'like', '%' . request('search') . '%')
                        ->orWhere('district', 'like', '%' . request('search') . '%')
                        ->orWhere('village', 'like', '%' . request('search') . '%');
                });
            })
            ->when(request('district'), function ($query) {
                return $query->where('district', request('district'));
            })
            ->when(request('category'), function ($query) {
                return $query->where('category', request('category'));
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('reports.public', compact('reports'));
    }

    /**
     * Show the form for creating a new report.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created report in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'district' => 'required|string',
            'village' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_anonymous' => 'nullable|boolean',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $attachments = [];

        // Handle file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('reports', 'public');
                $attachments[] = [
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'type' => $file->getClientMimeType(),
                ];
            }
        }

        $report = Report::create([
            'user_id' => auth()->id(),
            'ticket_number' => $this->generateTicketNumber(),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'district' => $validated['district'],
            'village' => $validated['village'],
            'address' => $validated['address'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'is_anonymous' => $request->has('is_anonymous'),
            'status' => 'pending',
            'attachments' => $attachments,
        ]);

        return redirect()->route('reports.show', $report->id)
            ->with('success', 'Laporan berhasil dikirim! Kami akan segera memverifikasi laporan Anda.');
    }

    /**
     * Display the specified report.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $query = Report::with('user')->where('id', $id);

        // Allow access if user owns the report or if it's public
        if (auth()->check()) {
            $userId = auth()->id();
            $query->where(function ($q) use ($userId) {
                $q->where('user_id', $userId)
                    ->orWhere('is_public', true);
            });
        } else {
            $query->where('is_public', true);
        }

        $report = $query->firstOrFail();

        return view('reports.show', compact('report'));
    }

    /**
     * Generate a unique ticket number.
     *
     * @return string
     */
    private function generateTicketNumber()
    {
        // Format: #SR-YYMM-XXX
        // SR = Sragen, YY = Year, MM = Month, XXX = Sequential number
        $prefix = 'SR-' . date('ym') . '-';

        $lastTicket = Report::where('ticket_number', 'like', $prefix . '%')
            ->orderBy('ticket_number', 'desc')
            ->first();

        if ($lastTicket) {
            $lastNumber = (int) substr($lastTicket->ticket_number, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return $prefix . $newNumber;
    }
}
