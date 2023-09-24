<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InprogressLivestramResource\Pages;
use App\Filament\Resources\InprogressLivestramResource\RelationManagers;
use App\Models\Livestream;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class InprogressLivestramResource extends Resource
{
    protected static ?string $model = Livestream::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = "Livestream CRM";

    protected static ?string $navigationLabel = "In-Progress Livestreams";

    protected static ?string $slug = 'inprogress-livestreams';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('stream_id')
                    ->searchable(),
                TextColumn::make('user.firstName')
                    ->label('First Name')
                    ->searchable(),
                TextColumn::make('user.lastName')
                    ->label('Last Name')
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('user.username')
                    ->label('Username')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Start Date & Time')
                    ->searchable(),
            ])
            ->filters([
                Filter::make('started')
                    ->form([
                        DatePicker::make('started_from'),
                        DatePicker::make('started_to'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['started_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['started_to'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Action::make('visit')
                    ->label('Visit')
                    ->url(fn(Livestream $record): string => route('stream.live', $record->stream_id))
                    ->openUrlInNewTab()
            ])
            ->bulkActions([
                ExportBulkAction::make()
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInprogressLivestrams::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

}
