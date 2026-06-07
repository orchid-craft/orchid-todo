<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination; // Tambahkan trait untuk pagination

    // Variabel ini akan terhubung langsung (two-way binding) dengan input di browser
    public $task = '';
    public $showTrashed = false; // Untuk menampilkan tugas yang sudah dihapus (soft deleted)
    public $category = 'personal'; // Default kategori saat menambah tugas baru
    public $categoryList= ['personal', 'work', 'shopping', 'health']; // Untuk kategori tugas (personal, work, etc.)

    #[Url(history: true)]
    public $search = ''; // Untuk fitur pencarian
    
    #[Url(history: true)]
    public $filterStatus = 'all'; // Untuk filter berdasarkan status (all, pending, completed)
    
    #[Url(history: true)]
    public $filterCategory = 'all'; // Untuk filter berdasarkan kategori
    

    public function updatingSearch()
    {
        $this->resetPage(); // Reset ke halaman pertama saat melakukan pencarian
    }

    public function updatingFilterStatus()
    {
        $this->resetPage(); // Reset ke halaman pertama saat mengubah filter
    }

    public function updatingShowTrashed()
    {
        $this->resetPage(); // Reset ke halaman pertama saat toggle mode trash
    }

    // Fungsi untuk menambah tugas baru
    public function addTodo()
    {
        // Validasi input, pastikan tidak kosong
        $this->validate([
            'task' => 'required|string|min:3',
            'category' => 'required|in:' . implode(',', $this->categoryList)
        ]);

        // Simpan ke PostgreSQL menggunakan Eloquent ORM
        Todo::create([
            'task' => $this->task,
            'category' => $this->category
        ]);

        // Reset kolom input di browser menjadi kosong kembali
        $this->reset(['task']);
        $this->category = 'personal'; // Reset kategori ke default
        $this->resetPage(); // Kembali ke halaman pertama setelah menambah tugas baru
    }

    // Fitur Tambahan: Menandai tugas selesai/belum (Toggle Checklist)
    public function toggleTodo($id)
    {
        $todo = Todo::withTrashed()->findOrFail($id); // Cari termasuk yang sudah dihapus (soft deleted)
        $todo->is_completed = !$todo->is_completed; // Toggle status selesai/belum
        $todo->save();
    }

    // Fungsi untuk menghapus tugas
    public function deleteTodo($id)
    {
        // Ini akan memicu Soft Delete (mengisi deleted_at)
        Todo::findOrFail($id)->delete();
        $this->resetPage(); // Kembali ke halaman pertama setelah menghapus tugas
    }

    // ================= FITUR BARU TRASH MANAGEMENT =================
    public function toggleTrashMode()
    {
        $this->showTrashed = !$this->showTrashed;
        $this->reset(['search', 'filterStatus', 'filterCategory']); // Reset filter dan pencarian saat toggle mode trash
        $this->resetPage(); // Kembali ke halaman pertama saat toggle mode trash
    }


    public function restoreTodo($id)
    {
        // Ini akan mengembalikan tugas yang sudah dihapus (soft deleted)
        Todo::onlyTrashed()->findOrFail($id)->restore();
        $this->resetPage();
    }

    public function forceDeleteTodo($id)
    {
        // Ini akan menghapus tugas secara permanen dari database
        Todo::onlyTrashed()->findOrFail($id)->forceDelete();
        $this->resetPage();
    }

    // ========================= END MANAGEMENT ======================

    // Fungsi render otomatis dipicu setiap kali ada perubahan data (state)
    #[Layout('layouts.app')]
    #[Title('Dashboard - Todo List')]
    public function render()
    {
        // Menentukan base query: Data aktif murni atau data sampah murni
        $query = $this->showTrashed ? Todo::onlyTrashed() : Todo::query();

        // Terapkan filter pencarian jika ada
        if ($this->search) {
            $query->where('task', 'ilike', '%' . $this->search . '%');
        }

        // Terapkan filter status jika dipilih
        if (!$this->showTrashed) { // Hanya terapkan filter status jika tidak dalam mode trash
            if ($this->filterStatus === 'pending') {
                $query->where('is_completed', false);
            } elseif ($this->filterStatus === 'completed') {
                $query->where('is_completed', true);
            }

            // Terapkan filter kategori jika dipilih
            if ($this->filterCategory !== 'all') {
                $query->where('category', $this->filterCategory);
            }
        }

        // Ambil data todo terbaru dari Postgres
        $todos = $query->latest()->paginate(10); // Pagination: 10 items per page

        return view('livewire.todo-list', [
            'todos' => $todos,
            'totalCount' => Todo::count(),
            'pendingCount' => Todo::where('is_completed', false)->count(),
            'completedCount' => Todo::where('is_completed', true)->count(),
        ]);
    }
}
