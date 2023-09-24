<?php

namespace App\Filament\Resources\CompletedLivestramResource\Pages;

use App\Filament\Resources\CompletedLivestramResource;
use App\Models\Livestream;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCompletedLivestrams extends ListRecords
{
    protected static string $resource = CompletedLivestramResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Livestream::query()->where('status', 'stopped');
    }

}
