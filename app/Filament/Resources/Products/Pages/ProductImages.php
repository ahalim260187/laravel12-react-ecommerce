<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;

class ProductImages extends EditRecord
{
    protected static string $resource = ProductResource::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-photo';

    public function form(Schema $schema) :Schema {
        return $schema->schema([
            SpatieMediaLibraryFileUpload::make('images')
                ->image()
                ->multiple()
                ->openable()
                ->panelLayout('grid')
                ->collection('images')
                ->reorderable()
                ->appendFiles()
                ->preserveFilenames()
                ->disk('public')
                ->columnSpan(2),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): ?string {
        return static::$resource::getUrl('index');
    }
}
