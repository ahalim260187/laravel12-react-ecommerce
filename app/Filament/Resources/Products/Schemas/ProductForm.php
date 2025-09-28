<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;


class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')
                ->live(true)
                ->required()
                ->afterStateUpdated(function ($state, callable $set) {
                    $set('slug', Str::slug($state));
                }),

            TextInput::make('slug')
                ->readOnly()
                ->required(),

            Select::make('department_id')
                  ->label(__('Departement'))
                  ->relationship('department', 'name')
                  ->preload()
                  ->searchable()
                  ->reactive()
                  ->afterStateUpdated(function (callable $set) {
                        $set('category_id', null);
                    })
                  ->required(),

            Select::make('category_id')
                  ->label(__('Category'))
                  ->relationship('category', 'name', modifyQueryUsing: function (
                        Builder $query,callable $get
                        ) {
                          $departmentId = $get( 'department_id' );
                          if ( $departmentId ) {
                              $query->where( 'department_id', $departmentId );
                          }
                      }
                  )
                  ->preload()
                  ->searchable()
                  ->required(),

            RichEditor::make('description')
                ->label(__('Description'))
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'strike',
                    'underline',
                    'h1',
                    'h2',
                    'h3',
                    'bulletList',
                    'orderedList',
                    'blockquote',
                    'codeBlock',
                    'link',
                    'table',
                    'undo',
                    'redo',
                    'attachFiles',
                ])
                ->extraAttributes(['style' => 'min-height: 400px'])
                ->columnSpan(2),

            TextInput::make('price')
                ->label(__('Price'))
                ->numeric()
                ->required(),

            TextInput::make('Quantity')
                     ->label(__('Quantity'))
                     ->numeric()
                     ->required(),

            Select::make('status')
                ->label(__('Status'))
                ->options(ProductStatusEnum::label())
                ->default(ProductStatusEnum::DRAFT->value)
                ->required(),

        ]);
    }
}
