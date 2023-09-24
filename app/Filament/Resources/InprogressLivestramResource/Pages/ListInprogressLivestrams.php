<?php

namespace App\Filament\Resources\InprogressLivestramResource\Pages;

use App\Filament\Resources\InprogressLivestramResource;
use App\Models\Livestream;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListInprogressLivestrams extends ListRecords
{
    protected static string $resource = InprogressLivestramResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Livestream::query()->where('status', 'started');
    }
}
