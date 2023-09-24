<?php

namespace App\Filament\Resources\CompletedLivestramResource\Pages;

use App\Filament\Resources\CompletedLivestramResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompletedLivestram extends EditRecord
{
    protected static string $resource = CompletedLivestramResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
