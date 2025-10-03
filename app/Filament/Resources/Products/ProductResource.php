<?php

namespace App\Filament\Resources\Products;

use App\Enums\RoleEnum;
use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Pages\ProductImages;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-c-list-bullet';

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::End;

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
            'images' => Pages\ProductImages::route('/{record}/images')
        ];
    }

    public static function canViewAny(): bool
    {
        $user = filament()->auth()->user();
        return $user && $user->hasRole(RoleEnum::VENDOR);
    }

    public static function getRecordSubNavigation( Page $page ): array {
        return collect($page->generateNavigationItems([
            EditProduct::class,
            ProductImages::class,
        ]))
            ->map(function ($item) {
                $url = $item->getUrl();

                if (str_contains($url, 'edit')) {
                    $item
                        ->label('Edit Product');
                }

                if (str_contains($url, 'images')) {
                    $item
                        ->label('Edit Images');
                }

                return $item;
            })
            ->all();
    }
}
