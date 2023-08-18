<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Category;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->afterStateUpdated(function ($set, $state) {
                                $set('slug', Str::slug($state));
                            })
                            ->live(onBlur: true)
                            ->maxLength(2048),
                        Forms\Components\TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->maxLength(2048)
                            ->unique(Post::class, 'slug', ignoreRecord: true)
                            ->placeholder(__('Slug')),
                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('published')
                            ->required(),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->native(false)
                            ->format('Y-m-d H:i')
                            ->seconds(false)
                            ->columnSpanFull(),
                        // Forms\Components\TextInput::make('meta_title')
                        //     ->maxLength(255),
                        // Forms\Components\TextInput::make('meta_keywords')
                        //     ->maxLength(255),
                        // Forms\Components\TextInput::make('meta_description')
                        //     ->maxLength(255)->columnSpanFull(),
                    ])->columnSpan(8),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\FileUpload::make('thumbnail')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ]),
                        Forms\Components\TextInput::make('thumbnail_caption')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('thumbnail_alt')
                            ->maxLength(255),
                        Forms\Components\Select::make('categories')
                            ->relationship('categories', 'name')
                            ->required()
                            ->preload()
                            ->multiple()
                            ->placeholder(__('Select categories')),
                    ])->columnSpan(4),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // multiple rows in cell
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('categories.name')
                    ->color(
                        fn (Post $record, string $state) => Color::Hex(array_search($state, $record->categories->pluck('name', 'color')->toArray(), true))
                    )
                    ->badge(),
                Tables\Columns\IconColumn::make('published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Modified')
                    ->since()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\ACtions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                    Tables\ACtions\ForceDeleteAction::make(),
                ])
                    ->iconButton()
                    ->icon('heroicon-m-ellipsis-horizontal')
                    ->tooltip('View, edit, or delete this record.')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
