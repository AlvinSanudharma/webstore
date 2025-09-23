<?php

namespace App\Filament\Resources\SalesOrderResource\Pages;

use App\Filament\Resources\SalesOrderResource;
use App\States\SalesOrder\Pending;
use App\States\SalesOrder\Progress;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesOrder extends ViewRecord
{
    protected static string $resource = SalesOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Process')
                ->icon('heroicon-o-arrow-path-rounded-square')
                ->modalWidth('sm')
                ->visible(fn() => in_array(get_class($this->record->status), [
                    Pending::class,
                    Progress::class
                ]))
                ->form(function() {
                    $transition = $this->record->status->transitionableStates();

                    $options = collect($transition)->mapWithKeys(fn($class) => [
                        $class => (new $class($this->record))->label()
                    ])->toArray();

                    return [
                        Radio::make('status')
                                ->label("Status")
                                ->options($options)
                                ->required()
                                ->inline()
                    ];
                })
                ->action(function(array $data) {
                    $this->record->status->transitionTo(data_get($data, 'status'));
                })
        ];
    }
}
