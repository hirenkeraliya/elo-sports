<?php

namespace App\Filament\Resources;

use App\Exports\AnswerSheetExport;
use App\Filament\Resources\CompletedLivestramResource\Pages;
use App\Filament\Resources\CompletedLivestramResource\RelationManagers;
use App\Models\AnswerSheet;
use App\Models\Examination;
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

class CompletedLivestramResource extends Resource
{
    protected static ?string $model = Livestream::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = "Livestream CRM";

    protected static ?string $navigationLabel = "Completed Livestreams";

    protected static ?string $slug = 'completed-livestreams';


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
                TextColumn::make('updated_at')
                    ->label('End Date & Time')
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
                Filter::make('ended')
                    ->form([
                        DatePicker::make('ended_from'),
                        DatePicker::make('ended_to'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['ended_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('updated_at', '>=', $date),
                            )
                            ->when(
                                $data['ended_to'],
                                fn(Builder $query, $date): Builder => $query->whereDate('updated_at', '<=', $date),
                            );
                    })
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
            'index' => Pages\ListCompletedLivestrams::route('/'),
//            'create' => Pages\CreateCompletedLivestram::route('/create'),
//            'edit' => Pages\EditCompletedLivestram::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

}
