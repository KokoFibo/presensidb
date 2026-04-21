<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Userwr extends Component
{
    use WithPagination;

    public $search = '';
    public $company = '';
    public $perPage = 10;
    public $incompleteOnly = false; // 🔥 filter data tidak lengkap

    protected $queryString = ['search', 'company', 'page', 'incompleteOnly'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCompany()
    {
        $this->resetPage();
    }

    public function updatingIncompleteOnly()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query()
            ->when(
                $this->search,
                fn($q) =>
                $q->where(function ($q2) {
                    $q2->where('name', 'like', "%{$this->search}%")
                        ->orWhere('id_karyawan', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                })
            )
            ->when(
                $this->company,
                fn($q) =>
                $q->where('company_name', $this->company)
            )
            ->when(
                $this->incompleteOnly,
                fn($q) =>
                $q->where(function ($q2) {
                    $q2->whereNull('email')
                        ->orWhere('email', '')
                        ->orWhereNull('company_name')
                        ->orWhere('company_name', '');
                })
            );

        $users = $query->orderBy('updated_at')->paginate($this->perPage);
        $companies = User::select('company_name')->distinct()->pluck('company_name')->filter();

        return view('livewire.userwr', [
            'users' => $users,
            'companies' => $companies,
        ]);
    }
}
