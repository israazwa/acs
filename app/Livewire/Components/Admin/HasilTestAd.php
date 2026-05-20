<?php

namespace App\Livewire\Components\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pelajaran;
use App\Models\HasilTest;
use Livewire\Attributes\Layout;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HasilTestExport;

#[Layout('layouts.admin')]
class HasilTestAd extends Component
{
    use WithPagination;

    public $selectedPelajaran;

    public function showHasil($pelajaranId)
    {
        $this->selectedPelajaran = Pelajaran::findOrFail($pelajaranId);
    }

    public function resetUjian($userId)
    {
        if ($this->selectedPelajaran) {
            HasilTest::where('user_id', $userId)
                ->where('pelajaran_id', $this->selectedPelajaran->id)
                ->delete();

            $this->dispatch('notify', 'Ujian murid berhasil direset.');
        }
    }

    public function tendang($userId)
    {
        if ($this->selectedPelajaran) {
            HasilTest::where('user_id', $userId)
                ->where('pelajaran_id', $this->selectedPelajaran->id)
                ->delete();

            $this->dispatch('notify', 'Murid berhasil ditendang.');
        }
    }

    // Cetak PDF
    public function exportPdf()
    {
        if ($this->selectedPelajaran) {
            $hasilTests = HasilTest::with('user')
                ->where('pelajaran_id', $this->selectedPelajaran->id)
                ->get();

            $pdf = Pdf::loadView('pdf.nilaiHasilTest', [
                'pelajaran' => $this->selectedPelajaran,
                'hasilTests' => $hasilTests,
            ]);

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, 'hasil-test-' . $this->selectedPelajaran->id . '.pdf');
        }
    }


    public function render()
    {
        return view('livewire.components.admin.hasil-test', [
            'pelajaranList' => Pelajaran::withCount('soals')->paginate(6),
            'hasilTests' => $this->selectedPelajaran
                ? HasilTest::with('user')
                    ->where('pelajaran_id', $this->selectedPelajaran->id)
                    ->orderByDesc('created_at')
                    ->paginate(10)
                : null,
            'selectedPelajaran' => $this->selectedPelajaran,
        ]);
    }
}
