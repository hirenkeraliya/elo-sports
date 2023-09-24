<?php

namespace App\Filament\Resources\InprogressLivestramResource\Pages;

use App\Filament\Resources\InprogressLivestramResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInprogressLivestram extends EditRecord
{
    protected static string $resource = InprogressLivestramResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
