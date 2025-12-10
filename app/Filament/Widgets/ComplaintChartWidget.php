<?php

namespace App\Filament\Widgets;

use App\Models\Complaint;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class ComplaintChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Complaints per Month';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = $this->getComplaintsPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Complaints',
                    'data' => $data['data'],
                    'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
                    'borderColor' => 'rgb(59, 130, 246)',
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function getComplaintsPerMonth(): array
    {
        $now = Carbon::now();
        $months = [];
        $data = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $count = Complaint::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            $data[] = $count;
        }

        return [
            'labels' => $months,
            'data' => $data,
        ];
    }
}
