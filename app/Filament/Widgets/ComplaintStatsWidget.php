<?php

namespace App\Filament\Widgets;

use App\Models\Complaint;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ComplaintStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Complaints', Complaint::count())
                ->description('All time complaints')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
            
            Stat::make('Pending Complaints', Complaint::where('status', 'pending')->count())
                ->description('Awaiting review')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
            
            Stat::make('Resolved Complaints', Complaint::where('status', 'selesai')->count())
                ->description('Successfully completed')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
