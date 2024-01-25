<?php

namespace App\Filament\Resources\ProjectSubmissionResource\Pages;

use App\Filament\Resources\ProjectSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectSubmission extends EditRecord
{
    protected static string $resource = ProjectSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
