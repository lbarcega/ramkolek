<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectSubmissionResource\Pages;
use App\Filament\Resources\ProjectSubmissionResource\RelationManagers;
use App\Models\User;
use App\Models\ProjectSubmission;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Carbon\Carbon;


class ProjectSubmissionResource extends Resource
{
    protected static ?string $model = ProjectSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $options = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->where('roles.name', 'Professor')
        ->pluck('users.name', 'users.id')
        ->toArray();
        $teams = Team::pluck('name', 'id')
        ->toArray();

        // Generate a range of school years, e.g., from the current year up to the next 10 years
        $startYear = Carbon::now()->year;
        $endYear = $startYear+5;
        $academicYears = [];

        for ($year = $startYear; $year <= $endYear; $year++) {
            $academicYears["{$year}-" . ($year + 1)] = "{$year}-" . ($year + 1);
        }

        return $form
            ->schema([
                Forms\Components\TextInput::make('title'),
                Forms\Components\Select::make('team')
                ->label('Team')
                ->options($teams)
                ->searchable()
                ->required(),
                Forms\Components\Select::make('professor')
                ->label('Professor')
                ->options($options)
                ->searchable()
                ->required(),
                Forms\Components\TextInput::make('subject'),
                Forms\Components\Select::make('academic_year')
                ->label('Academic Year:')
                ->options($academicYears)
                ->required(),
                Forms\Components\Select::make('term')
                ->label('Term')
                ->options([
                    '1' => '1st Term',
                    '2' => '2nd Term',
                    '3' => '3rd Term',
                ])
                ->required(),
                Forms\Components\MarkdownEditor::make('abstract')
                ->columnSpan(2),
                Forms\Components\TextInput::make('categories'),
                FileUpload::make('attachments')
                ->multiple()
                ->storeFileNamesIn('attachments_names')
                ->openable()
                ->downloadable()
                ->previewable(true)
                ->directory('project_files')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                ->searchable(),
                Tables\Columns\TextColumn::make('categories'),
                Tables\Columns\TextColumn::make('subject'),
                Tables\Columns\TextColumn::make('created_at')
                ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListProjectSubmissions::route('/'),
            'create' => Pages\CreateProjectSubmission::route('/create'),
            'view' => Pages\ViewProjectSubmission::route('/{record}'),
            'edit' => Pages\EditProjectSubmission::route('/{record}/edit'),
        ];
    }
}
