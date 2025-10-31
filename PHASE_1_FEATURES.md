# 🚀 BallStack Phase 1 Features Documentation

Cette documentation couvre toutes les fonctionnalités implémentées dans la **Phase 1** de BallStack.

---

## 📦 Table des Matières

1. [MultiSelect Component](#1-multiselect-component)
2. [Tags Input Component](#2-tags-input-component)
3. [Rating Component](#3-rating-component)
4. [Slider/Range Component](#4-sliderrange-component)
5. [Advanced Datatable Filters](#5-advanced-datatable-filters)
6. [Excel/CSV Export](#6-excelcsv-export)
7. [Bulk Actions](#7-bulk-actions)
8. [Toast Notifications](#8-toast-notifications)
9. [Artisan Commands](#9-artisan-commands)

---

## 1. MultiSelect Component

Composant de sélection multiple avec tags, recherche en temps réel, options groupées et limite de sélection.

### Utilisation de Base

```php
use Tresorkasenda\Forms\Components\MultiSelectInput;

MultiSelectInput::make('skills')
    ->label('Skills')
    ->options([
        'php' => 'PHP',
        'laravel' => 'Laravel',
        'vue' => 'Vue.js',
        'react' => 'React',
    ])
    ->required();
```

### Avec Recherche

```php
MultiSelectInput::make('countries')
    ->label('Countries')
    ->options([
        'us' => 'United States',
        'ca' => 'Canada',
        'uk' => 'United Kingdom',
        'fr' => 'France',
    ])
    ->searchable()
    ->placeholder('Search countries...');
```

### Options Groupées

```php
MultiSelectInput::make('technologies')
    ->label('Technologies')
    ->options([
        'Frontend' => [
            'vue' => 'Vue.js',
            'react' => 'React',
            'angular' => 'Angular',
        ],
        'Backend' => [
            'laravel' => 'Laravel',
            'symfony' => 'Symfony',
            'django' => 'Django',
        ],
    ])
    ->grouped()
    ->searchable();
```

### Avec Limite et Tags Personnalisés

```php
MultiSelectInput::make('tags')
    ->label('Tags')
    ->options(['laravel', 'php', 'vue', 'tailwind'])
    ->maxItems(5)
    ->taggable()
    ->helpText('You can add custom tags');
```

### API Complète

| Méthode | Description | Exemple |
|---------|-------------|---------|
| `options(array)` | Définir les options | `->options(['key' => 'value'])` |
| `searchable(bool)` | Activer la recherche | `->searchable()` |
| `maxItems(int)` | Limiter le nombre de sélections | `->maxItems(5)` |
| `taggable(bool)` | Permettre les valeurs personnalisées | `->taggable()` |
| `grouped(bool)` | Marquer les options comme groupées | `->grouped()` |
| `closeOnSelect(bool)` | Fermer après sélection | `->closeOnSelect()` |
| `removeButton(bool)` | Afficher le bouton de suppression | `->removeButton()` |
| `helpText(string)` | Texte d'aide | `->helpText('Help text')` |

---

## 2. Tags Input Component

Composant pour l'ajout dynamique de tags avec autocomplétion et validation.

### Utilisation de Base

```php
use Tresorkasenda\Forms\Components\TagsInput;

TagsInput::make('tags')
    ->label('Tags')
    ->placeholder('Add tags...')
    ->required();
```

### Avec Suggestions

```php
TagsInput::make('tags')
    ->label('Tags')
    ->suggestions(['laravel', 'php', 'vue', 'tailwind', 'livewire'])
    ->placeholder('Type to add tags...');
```

### Avec Limite et Séparateur

```php
TagsInput::make('keywords')
    ->label('Keywords')
    ->maxTags(10)
    ->separator(',')
    ->helpText('Press comma or enter to add a tag');
```

### Whitelist Strict

```php
TagsInput::make('categories')
    ->label('Categories')
    ->suggestions(['tech', 'business', 'health', 'education'])
    ->enforceWhitelist()
    ->helpText('Only predefined categories are allowed');
```

### API Complète

| Méthode | Description | Exemple |
|---------|-------------|---------|
| `suggestions(array)` | Suggestions d'autocomplétion | `->suggestions(['tag1', 'tag2'])` |
| `maxTags(int)` | Nombre maximum de tags | `->maxTags(10)` |
| `separator(string)` | Caractère séparateur | `->separator(',')` |
| `allowDuplicates(bool)` | Autoriser les doublons | `->allowDuplicates()` |
| `trimTags(bool)` | Nettoyer les espaces | `->trimTags()` |
| `dropdown(bool)` | Activer le dropdown | `->dropdown()` |
| `enforceWhitelist(bool)` | Forcer la whitelist | `->enforceWhitelist()` |
| `minChars(int)` | Caractères min pour dropdown | `->minChars(2)` |

---

## 3. Rating Component

Système de notation avec étoiles, demi-étoiles et différents styles.

### Utilisation de Base

```php
use Tresorkasenda\Forms\Components\RatingInput;

RatingInput::make('rating')
    ->label('Rate this product')
    ->stars(5)
    ->required();
```

### Avec Demi-Étoiles

```php
RatingInput::make('rating')
    ->label('Rating')
    ->stars(5)
    ->allowHalf()
    ->showValue()
    ->color('warning');
```

### Différents Styles

```php
// Étoiles (par défaut)
RatingInput::make('rating')->icon('star');

// Cœurs
RatingInput::make('rating')->icon('heart')->color('danger');

// Thumbs
RatingInput::make('rating')->icon('thumb')->color('primary');
```

### Read-Only Mode

```php
RatingInput::make('average_rating')
    ->label('Average Rating')
    ->readOnly()
    ->stars(5)
    ->allowHalf()
    ->showValue();
```

### API Complète

| Méthode | Description | Exemple |
|---------|-------------|---------|
| `stars(int)` | Nombre d'étoiles | `->stars(5)` |
| `allowHalf(bool)` | Autoriser les demi-étoiles | `->allowHalf()` |
| `readOnly(bool)` | Mode lecture seule | `->readOnly()` |
| `icon(string)` | Type d'icône (star/heart/thumb) | `->icon('heart')` |
| `color(string)` | Couleur | `->color('warning')` |
| `size(string)` | Taille (sm/md/lg) | `->size('lg')` |
| `showValue(bool)` | Afficher la valeur | `->showValue()` |

---

## 4. Slider/Range Component

Composant de slider avec support de range, steps et formatage.

### Utilisation de Base

```php
use Tresorkasenda\Forms\Components\SliderInput;

SliderInput::make('price')
    ->label('Price')
    ->min(0)
    ->max(1000)
    ->step(10)
    ->prefix('$')
    ->showValue();
```

### Range Mode (Double Handle)

```php
SliderInput::make('price_range')
    ->label('Price Range')
    ->min(0)
    ->max(1000)
    ->step(50)
    ->range()
    ->prefix('$')
    ->showValue();
```

### Avec Suffix

```php
SliderInput::make('weight')
    ->label('Weight')
    ->min(0)
    ->max(100)
    ->step(0.5)
    ->suffix('kg')
    ->showValue()
    ->tooltips();
```

### Orientation Verticale

```php
SliderInput::make('volume')
    ->label('Volume')
    ->min(0)
    ->max(100)
    ->orientation('vertical')
    ->showValue()
    ->color('primary');
```

### API Complète

| Méthode | Description | Exemple |
|---------|-------------|---------|
| `min(float)` | Valeur minimum | `->min(0)` |
| `max(float)` | Valeur maximum | `->max(100)` |
| `step(float)` | Incrément | `->step(10)` |
| `prefix(string)` | Préfixe | `->prefix('$')` |
| `suffix(string)` | Suffixe | `->suffix('kg')` |
| `showValue(bool)` | Afficher la valeur | `->showValue()` |
| `range(bool)` | Mode range | `->range()` |
| `tooltips(bool)` | Afficher les tooltips | `->tooltips()` |
| `orientation(string)` | Orientation (horizontal/vertical) | `->orientation('vertical')` |
| `color(string)` | Couleur | `->color('primary')` |

---

## 5. Advanced Datatable Filters

Système de filtres avancés pour les datatables avec différents types de filtres.

### Utilisation avec Trait

```php
use Tresorkasenda\Tables\Datatable;
use Tresorkasenda\Tables\Concerns\HasFilters;
use Tresorkasenda\Tables\Filters\{TextFilter, SelectFilter, DateRangeFilter};

class UsersDatatable extends Datatable
{
    use HasFilters;

    public function mount(): void
    {
        $this->model(User::class, perPage: 15)
            ->fields(['name', 'email', 'status', 'created_at'])
            ->filters([
                TextFilter::make('search')
                    ->label('Search')
                    ->placeholder('Search by name or email...'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'pending' => 'Pending',
                    ]),

                DateRangeFilter::make('created_at')
                    ->label('Registration Date'),
            ]);
    }

    protected function getBaseQuery()
    {
        $query = User::query();
        return $this->applyFilters($query);
    }
}
```

### TextFilter

```php
TextFilter::make('search')
    ->label('Search')
    ->placeholder('Search...')
    ->operator('like') // like, =, !=, >, <
    ->column('name');
```

### SelectFilter

```php
SelectFilter::make('category')
    ->label('Category')
    ->options([
        'tech' => 'Technology',
        'business' => 'Business',
    ])
    ->placeholder('Select category')
    ->multiple(); // Multi-select
```

### DateRangeFilter

```php
DateRangeFilter::make('created_at')
    ->label('Date Range')
    ->format('Y-m-d')
    ->placeholders('Start Date', 'End Date');
```

### Custom Filter Query

```php
TextFilter::make('name')
    ->query(function ($query, $value) {
        return $query->where('first_name', 'like', "%{$value}%")
                     ->orWhere('last_name', 'like', "%{$value}%");
    });
```

---

## 6. Excel/CSV Export

Export de données en Excel ou CSV avec colonnes configurables.

### Utilisation avec Trait

```php
use Tresorkasenda\Tables\Concerns\HasExport;

class UsersDatatable extends Datatable
{
    use HasExport;

    public function mount(): void
    {
        $this->model(User::class, perPage: 15)
            ->fields(['name', 'email', 'created_at'])
            ->exportable(['excel', 'csv'])
            ->exportColumns(['name', 'email', 'created_at']);
    }
}
```

### Dans la Vue

```blade
@if($isExportable())
    <div class="export-buttons">
        @foreach($getExportFormats() as $format)
            @if($format === 'csv')
                <button wire:click="exportToCsv" class="btn btn-sm btn-secondary">
                    Export CSV
                </button>
            @elseif($format === 'excel')
                <button wire:click="exportToExcel" class="btn btn-sm btn-success">
                    Export Excel
                </button>
            @endif
        @endforeach
    </div>
@endif
```

### Configuration

```php
$this->exportable(['excel', 'csv', 'pdf'])
     ->exportColumns(['id', 'name', 'email', 'created_at']);
```

### Requis pour Excel

Pour utiliser l'export Excel, installez le package:

```bash
composer require maatwebsite/excel
```

---

## 7. Bulk Actions

Actions groupées pour effectuer des opérations sur plusieurs enregistrements.

### Utilisation avec Trait

```php
use Tresorkasenda\Tables\Concerns\HasBulkActions;

class UsersDatatable extends Datatable
{
    use HasBulkActions;

    public function mount(): void
    {
        $this->model(User::class, perPage: 15)
            ->fields(['name', 'email', 'status'])
            ->bulkActions([
                'activate' => 'Activate Users',
                'deactivate' => 'Deactivate Users',
                'delete' => 'Delete Users',
            ])
            ->confirmBulkAction(['delete']); // Require confirmation
    }

    // Action handlers
    public function bulkActionActivate($ids)
    {
        User::whereIn('id', $ids)->update(['status' => 'active']);
    }

    public function bulkActionDeactivate($ids)
    {
        User::whereIn('id', $ids)->update(['status' => 'inactive']);
    }

    public function bulkActionDelete($ids)
    {
        User::whereIn('id', $ids)->delete();
    }
}
```

### Avec Closures

```php
$this->bulkActions([
    'export' => function ($ids) {
        return $this->exportToCsv();
    },
    'delete' => function ($ids) {
        User::whereIn('id', $ids)->delete();
        return true;
    },
]);
```

### Dans la Vue

```blade
@if(count($getBulkActions()) > 0)
    <div class="bulk-actions">
        <input
            type="checkbox"
            wire:model="selectAll"
            wire:click="toggleSelectAll"
        >

        @if($hasSelectedItems())
            <span>{{ $getSelectedCount() }} selected</span>

            <select wire:change="executeBulkAction($event.target.value)">
                <option value="">Bulk Actions...</option>
                @foreach($getBulkActions() as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>

            <button wire:click="clearSelection">Clear</button>
        @endif
    </div>
@endif
```

---

## 8. Toast Notifications

Système de notifications toast non-intrusif avec positionnement et auto-dismiss.

### Utilisation de Base

```php
use Tresorkasenda\Notifications\Toast;

// Success
Toast::success('User created successfully!');

// Error
Toast::error('Failed to delete user');

// Warning
Toast::warning('Your session will expire soon');

// Info
Toast::info('New update available');
```

### Avec Options

```php
Toast::success(
    message: 'Data saved!',
    duration: 5000,  // 5 seconds
    position: 'top-right'
);
```

### Positions Disponibles

- `top-right` (défaut)
- `top-left`
- `top-center`
- `bottom-right`
- `bottom-left`
- `bottom-center`

### Helpers

```php
// Helpers disponibles
toast_success('Success message');
toast_error('Error message');
toast_warning('Warning message');
toast_info('Info message');

// Helper générique
toast('Message', 'info', 3000, 'top-right');
```

### Dans les Composants Livewire

```php
public function save()
{
    // Save logic...

    $this->dispatch('toast', [
        'type' => 'success',
        'message' => 'Saved successfully!',
        'duration' => 3000,
        'position' => 'top-right',
    ]);
}
```

### Inclure dans Layout

Ajoutez le ToastManager dans votre layout principal:

```blade
<!DOCTYPE html>
<html>
<head>
    <!-- ... -->
</head>
<body>
    <!-- Your content -->

    @livewire('ballstack::toast-manager')
</body>
</html>
```

---

## 9. Artisan Commands

Commandes pour générer rapidement des composants BallStack.

### Générer un Datatable

```bash
# Basic datatable
php artisan ballstack:datatable users --model=App\\Models\\User

# With filters
php artisan ballstack:datatable users --model=App\\Models\\User --filters

# With export
php artisan ballstack:datatable users --model=App\\Models\\User --export

# With bulk actions
php artisan ballstack:datatable users --model=App\\Models\\User --bulk

# All features
php artisan ballstack:datatable users \
    --model=App\\Models\\User \
    --filters \
    --export \
    --bulk
```

Cette commande génère un fichier dans `app/Livewire/Datatables/UsersDatatable.php` avec toutes les fonctionnalités demandées pré-configurées.

---

## 📝 Exemples Complets

### Formulaire avec Tous les Nouveaux Composants

```php
use Tresorkasenda\Forms\Forms;
use Tresorkasenda\Forms\Components\{
    TextInput,
    MultiSelectInput,
    TagsInput,
    RatingInput,
    SliderInput
};

Forms::make('product-form')
    ->action('/products')
    ->hasCard()
    ->column(2)
    ->schema([
        TextInput::make('name')
            ->label('Product Name')
            ->required(),

        MultiSelectInput::make('categories')
            ->label('Categories')
            ->options([
                'electronics' => 'Electronics',
                'clothing' => 'Clothing',
                'books' => 'Books',
            ])
            ->searchable()
            ->maxItems(3),

        TagsInput::make('tags')
            ->label('Tags')
            ->suggestions(['new', 'featured', 'sale'])
            ->maxTags(5),

        RatingInput::make('rating')
            ->label('Rating')
            ->stars(5)
            ->allowHalf()
            ->showValue(),

        SliderInput::make('price')
            ->label('Price')
            ->min(0)
            ->max(1000)
            ->step(10)
            ->prefix('$')
            ->showValue(),
    ]);
```

### Datatable Complet avec Toutes les Fonctionnalités

```php
use Tresorkasenda\Tables\Datatable;
use Tresorkasenda\Tables\Concerns\{HasFilters, HasExport, HasBulkActions};
use Tresorkasenda\Tables\Filters\{TextFilter, SelectFilter, DateRangeFilter};

class ProductsDatatable extends Datatable
{
    use HasFilters;
    use HasExport;
    use HasBulkActions;

    public function mount(): void
    {
        $this->model(Product::class, perPage: 20)
            ->fields(['name', 'category', 'price', 'stock', 'created_at'])
            ->actions([
                'edit' => 'Edit',
                'delete' => 'Delete',
            ])
            ->filters([
                TextFilter::make('search')
                    ->label('Search')
                    ->placeholder('Search products...'),

                SelectFilter::make('category')
                    ->label('Category')
                    ->options([
                        'electronics' => 'Electronics',
                        'clothing' => 'Clothing',
                        'books' => 'Books',
                    ]),

                DateRangeFilter::make('created_at')
                    ->label('Date Added'),
            ])
            ->exportable(['excel', 'csv'])
            ->exportColumns(['name', 'category', 'price', 'stock'])
            ->bulkActions([
                'activate' => 'Activate',
                'deactivate' => 'Deactivate',
                'delete' => 'Delete',
            ])
            ->confirmBulkAction('delete');
    }

    protected function getBaseQuery()
    {
        $query = Product::query();
        return $this->applyFilters($query)
            ->orderBy($this->sortColumn, $this->sortDirection);
    }

    public function bulkActionDelete($ids)
    {
        Product::whereIn('id', $ids)->delete();
        toast_success('Products deleted successfully!');
    }
}
```

---

## 🎨 Styling et Personnalisation

Tous les composants utilisent les classes Bootstrap 5 par défaut. Vous pouvez personnaliser les styles en:

1. **Surchargeant les vues Blade** dans votre application
2. **Ajoutant du CSS personnalisé** dans vos fichiers
3. **Utilisant les classes CSS existantes** de BallStack

---

## 📚 Ressources Supplémentaires

- [Documentation BallStack](https://github.com/Tresor-Kasenda/ballstack)
- [Exemples de Code](https://github.com/Tresor-Kasenda/ballstack/examples)
- [Support](https://github.com/Tresor-Kasenda/ballstack/issues)

---

**Version**: 1.0.0
**Date**: 2024-10-31
**Auteur**: BallStack Team
