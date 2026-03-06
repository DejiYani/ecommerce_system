<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Product Information')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->placeholder('Enter product name'),
                                MarkdownEditor::make('description')
                                    ->placeholder('Enter product description')
                                    ->columnSpanFull(),

                            ]),
                        Section::make('Product Images')
                            ->schema([
                                FileUpload::make('images')
                                    ->multiple()
                                    ->directory('products')
                                    ->image()
                                    ->placeholder('Upload product images'),
                            ]),

                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Price')
                            ->schema([
                                TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->placeholder('Enter product price')
                                    ->prefix('PHP'),
                            ]),

                        Section::make('Associations')
                            ->schema([
                                Select::make('category_id')
                                    ->required()
                                    ->placeholder('Select category')
                                    ->relationship('category', 'name'),

                                Select::make('brand_id')
                                    ->required()
                                    ->placeholder('Select brand')
                                    ->relationship('brand', 'name'),

                            ]),

                        Section::make('Status')
                            ->schema([
                                Toggle::make('in_stock')
                                    ->label('In Stock')
                                    ->default(true),
                                Toggle::make('on_sale')
                                    ->label('On Sale')
                                    ->default(false),
                                Toggle::make('is_featured')
                                    ->label('Featured')
                                    ->default(false),
                                Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true),
                            ]),

                    ])->columnSpan(1),

            ])->columns(3);
    }
}
