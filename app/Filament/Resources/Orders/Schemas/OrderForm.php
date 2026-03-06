<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Product;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Number;


class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Order Information')
                            ->schema([
                                Select::make('customer_id')
                                    ->required()
                                    ->preload()
                                    ->placeholder('Select customer')
                                    ->relationship('customer', 'name'),

                                Select::make('payment_method')
                                    ->options([
                                        'Cash' => 'Cash',
                                        'Credit Card' => 'Credit Card',
                                        'Debit Card' => 'Debit Card',
                                        'Bank Transfer' => 'Bank Transfer',
                                    ])
                                    ->placeholder('Select payment method'),

                                Select::make('payment_status')
                                    ->options([
                                        'Paid' => 'Paid',
                                        'Unpaid' => 'Unpaid',
                                        'Failed' => 'Failed',
                                    ])
                                    ->placeholder('Select payment status'),

                                ToggleButtons::make('status')
                                    ->options([
                                        'Pending' => 'Pending',
                                        'Processing' => 'Processing',
                                        'Completed' => 'Completed',
                                        'Cancelled' => 'Cancelled',
                                    ])
                                    ->default('Pending')
                                    ->required()
                                    ->inline(),


                                TextInput::make('shipping_amount')
                                    ->numeric()
                                    ->placeholder('Enter shipping amount')
                                    ->prefix('PHP'),

                                Select::make('shipping_method')
                                    ->options([
                                        'LBC Express' => 'LBC Express',
                                        'JNT Express' => 'JNT Express',
                                        'GrabExpress' => 'GrabExpress',
                                    ])
                                    ->placeholder('Select shipping method'),

                                TextInput::make('shipping_address')
                                ->columnSpanFull()
                                ->required()
                                    ->placeholder('Enter shipping address'),

                                Textarea::make('notes')
                        ->columnSpanFull()
                                    ->placeholder('Enter additional notes about the order'),

                                // TextInput::make('grand_total')
                                //     ->required()
                                //     ->numeric()
                                //     ->placeholder('Enter grand total')
                                //     ->prefix('PHP'),


                            ])->columns(2),

                        Section::make('Order Items')
                            ->schema([
                                Repeater::make('items')
                                    ->relationship()
                                    ->schema([
                                        Select::make('product_id')
                                            ->required()
                                            ->searchable()
                                            ->preload()
                                            ->distinct()
                                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                            ->columnSpan(5)
                                            ->reactive()
                                            ->placeholder('Select product')
                                            ->relationship('product', 'name')
                                            ->afterStateUpdated(fn($state, Set $set) => $set('unit_amount', Product::find($state)?->price ?? 0))
                                            ->afterStateUpdated(fn($state, Set $set) => $set('total_amount', Product::find($state)?->price ?? 0)),

                                        TextInput::make('quantity')
                                            ->required()
                                            ->numeric()
                                            ->columnSpan(1)
                                            ->default(1)
                                            ->minValue(1)
                                            ->reactive()
                                            ->placeholder('Enter quantity')
                                            ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', $state * $get('unit_amount'))),

                                        TextInput::make('unit_amount')
                                            ->required()
                                            ->numeric()
                                            ->columnSpan(2)
                                            ->disabled()
                                            ->dehydrated()
                                            ->reactive()
                                        
                                            ->prefix('PHP')
                                            ->afterStateHydrated(function (Set $set, Get $get) {
                                                $productId = $get('product_id');
                                                if ($productId) {
                                                    $product = Product::find($productId);
                                                    if ($product) {
                                                        $set('unit_amount', $product->price);
                                                    }
                                                }
                                            }),

                                        TextInput::make('total_amount')
                                            ->required()
                                            ->numeric()
                                            ->dehydrated()
                                            ->columnSpan(2)

                                    ])->columns(10),

                                Placeholder::make('grand_total_placeholder')
                                    ->label('Grand Total')
                                    ->content(function (Get $get, Set $set) {
                                        $total = 0;
                                        if (!$repeaters = $get('items')) {
                                            return $total;
                                        }
                                        foreach ($repeaters as $key => $repeater) {
                                            $total += $get("items.{$key}.total_amount");
                                        }

                                        $set('grand_total', $total);
                                        return Number::currency($total, 'PHP');
                                    }),

                                Hidden::make('grand_total')

                                    ->default(0),
                            ]),

                    ])->columnSpanFull(),
            ]);
    }
}
