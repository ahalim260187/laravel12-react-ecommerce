<?php

namespace App\Filament\Resources\Departments\RelationManagers;

use App\Filament\Resources\Departments\DepartmentResource;
use App\Models\Category;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'categories';

    // protected static ?string $relatedResource = DepartmentResource::class;

    public function form(Schema $schema): Schema
{
    $department = $this->getOwnerRecord();
    return $schema
        ->components([
            TextInput::make('name')->required()->maxLength(255),
            Select::make('parent_id')
                ->options(function() use($department){
                    return Category::query()
                        ->where('department_id', $department->id) // Filter categories by the current department
                        ->pluck('name', 'id')->toArray();
                })
                ->label('Parent Category')
                ->preload()
                ->searchable(),
                Checkbox::make('active')
            // ...
        ]);
}

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('parent.name')->searchable()->sortable(),
                IconColumn::make('active')->label('Active')->boolean(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
