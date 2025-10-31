# 🎉 BallStack Phase 1 - Nouvelles Fonctionnalités

Bienvenue dans la **Phase 1** de BallStack! Cette version apporte 8 nouvelles fonctionnalités majeures pour améliorer votre expérience de développement.

## 📋 Résumé des Fonctionnalités

| # | Fonctionnalité | Description | Statut |
|---|----------------|-------------|--------|
| 1 | **MultiSelect Component** | Sélection multiple avec recherche, groupes et tags | ✅ Complété |
| 2 | **Tags Input Component** | Ajout dynamique de tags avec autocomplétion | ✅ Complété |
| 3 | **Rating Component** | Système de notation avec étoiles et demi-étoiles | ✅ Complété |
| 4 | **Slider/Range Component** | Slider avec range, steps et formatage | ✅ Complété |
| 5 | **Advanced Datatable Filters** | Filtres avancés (text, select, date range) | ✅ Complété |
| 6 | **Excel/CSV Export** | Export de données configurables | ✅ Complété |
| 7 | **Bulk Actions** | Actions groupées avec confirmation | ✅ Complété |
| 8 | **Toast Notifications** | Notifications non-intrusives | ✅ Complété |

## 🚀 Démarrage Rapide

### Installation

Aucune installation supplémentaire n'est requise! Toutes les fonctionnalités sont déjà intégrées dans BallStack.

### Utilisation Basique

#### 1. MultiSelect Component

```php
use Tresorkasenda\Forms\Components\MultiSelectInput;

MultiSelectInput::make('skills')
    ->options(['php' => 'PHP', 'laravel' => 'Laravel'])
    ->searchable()
    ->maxItems(5)
    ->taggable();
```

#### 2. Tags Input Component

```php
use Tresorkasenda\Forms\Components\TagsInput;

TagsInput::make('tags')
    ->suggestions(['laravel', 'php', 'vue'])
    ->maxTags(10)
    ->separator(',');
```

#### 3. Rating Component

```php
use Tresorkasenda\Forms\Components\RatingInput;

RatingInput::make('rating')
    ->stars(5)
    ->allowHalf()
    ->color('warning');
```

#### 4. Slider Component

```php
use Tresorkasenda\Forms\Components\SliderInput;

SliderInput::make('price')
    ->min(0)
    ->max(1000)
    ->step(10)
    ->prefix('$')
    ->showValue();
```

#### 5. Datatable avec Filtres

```php
use Tresorkasenda\Tables\Concerns\HasFilters;
use Tresorkasenda\Tables\Filters\TextFilter;

class UsersDatatable extends Datatable
{
    use HasFilters;

    public function mount(): void
    {
        $this->filters([
            TextFilter::make('search')->placeholder('Search...'),
        ]);
    }
}
```

#### 6. Export Excel/CSV

```php
use Tresorkasenda\Tables\Concerns\HasExport;

class UsersDatatable extends Datatable
{
    use HasExport;

    public function mount(): void
    {
        $this->exportable(['excel', 'csv']);
    }
}
```

#### 7. Bulk Actions

```php
use Tresorkasenda\Tables\Concerns\HasBulkActions;

class UsersDatatable extends Datatable
{
    use HasBulkActions;

    public function mount(): void
    {
        $this->bulkActions([
            'delete' => 'Delete Users',
        ])->confirmBulkAction('delete');
    }
}
```

#### 8. Toast Notifications

```php
use Tresorkasenda\Notifications\Toast;

Toast::success('User created successfully!');
Toast::error('An error occurred');
Toast::warning('Warning message');
Toast::info('Info message');
```

## 🛠️ Commandes Artisan

### Générer un Datatable

```bash
# Datatable avec toutes les fonctionnalités
php artisan ballstack:datatable users \
    --model=App\\Models\\User \
    --filters \
    --export \
    --bulk
```

## 📚 Documentation Complète

Pour une documentation détaillée avec tous les exemples et options disponibles, consultez:

👉 **[PHASE_1_FEATURES.md](PHASE_1_FEATURES.md)**

## 🎯 Exemples Complets

### Formulaire Complet

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
    ->schema([
        TextInput::make('name')->required(),

        MultiSelectInput::make('categories')
            ->options(['electronics' => 'Electronics'])
            ->searchable(),

        TagsInput::make('tags')
            ->suggestions(['new', 'featured']),

        RatingInput::make('rating')
            ->stars(5)
            ->allowHalf(),

        SliderInput::make('price')
            ->min(0)
            ->max(1000)
            ->prefix('$'),
    ]);
```

### Datatable Complet

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
        $this->model(Product::class, 20)
            ->fields(['name', 'price', 'stock'])
            ->filters([
                TextFilter::make('search'),
                SelectFilter::make('category')
                    ->options(['tech' => 'Technology']),
                DateRangeFilter::make('created_at'),
            ])
            ->exportable(['excel', 'csv'])
            ->bulkActions([
                'delete' => 'Delete Products',
            ]);
    }
}
```

## 🎨 Personnalisation

### Couleurs et Styles

Tous les composants utilisent Bootstrap 5 par défaut. Les composants supportent les couleurs:

- `primary`
- `success`
- `warning`
- `danger`
- `info`

### Vues Personnalisées

Vous pouvez publier et personnaliser les vues:

```bash
php artisan vendor:publish --tag=ballstack-views
```

## 📦 Dépendances Externes

Les composants utilisent les bibliothèques JavaScript suivantes (chargées via CDN):

- **Choices.js** - MultiSelect Component
- **Tagify** - Tags Input Component
- **noUiSlider** - Slider Component
- **Alpine.js** - Rating Component (déjà inclus)

### Export Excel (Optionnel)

Pour l'export Excel, installez:

```bash
composer require maatwebsite/excel
```

Sans ce package, les exports se feront en CSV.

## 🔥 Fonctionnalités Clés

### 🎯 MultiSelect
- ✅ Recherche en temps réel
- ✅ Options groupées
- ✅ Limite de sélection
- ✅ Tags personnalisés
- ✅ Boutons de suppression

### 🏷️ Tags Input
- ✅ Autocomplétion
- ✅ Suggestions
- ✅ Limite de tags
- ✅ Séparateurs personnalisés
- ✅ Whitelist enforcing

### ⭐ Rating
- ✅ Demi-étoiles
- ✅ Icônes personnalisées (étoiles, cœurs)
- ✅ Couleurs configurables
- ✅ Mode lecture seule
- ✅ Affichage de la valeur

### 📊 Slider
- ✅ Simple ou Range (double)
- ✅ Steps personnalisables
- ✅ Préfixe/Suffixe
- ✅ Tooltips
- ✅ Horizontal/Vertical

### 🔍 Datatable Filters
- ✅ Text Filter (LIKE search)
- ✅ Select Filter (single/multiple)
- ✅ Date Range Filter
- ✅ Custom query callbacks
- ✅ Reset filters

### 📤 Export
- ✅ Excel (.xlsx)
- ✅ CSV
- ✅ Colonnes configurables
- ✅ Export avec filtres appliqués

### ☑️ Bulk Actions
- ✅ Sélection multiple
- ✅ Select all
- ✅ Confirmation optionnelle
- ✅ Actions personnalisées
- ✅ Closures ou méthodes

### 🔔 Toast Notifications
- ✅ 4 types (success, error, warning, info)
- ✅ 6 positions
- ✅ Auto-dismiss
- ✅ Durée configurable
- ✅ Animations fluides

## 🧪 Tests

Des tests sont disponibles pour tous les composants:

```bash
vendor/bin/pest
```

## 🐛 Problèmes Connus

Aucun problème connu pour le moment. Si vous rencontrez un bug, veuillez créer une issue sur GitHub.

## 🗺️ Roadmap

### Phase 2 (Planifiée)
- Rich Text Editor (WYSIWYG)
- Repeater Component
- Conditional Fields
- Stats Card Widget
- Timeline Widget
- Breadcrumbs
- Slide-over Panel

### Phase 3 (Planifiée)
- Location Picker (Maps)
- Signature Pad
- Media Library Integration
- GraphQL Support
- WebSocket/Real-time
- Advanced Caching

## 🤝 Contribution

Les contributions sont les bienvenues! Veuillez consulter notre guide de contribution.

## 📝 Changelog

### Version 1.0.0 - Phase 1 (2024-10-31)

**Nouveaux Composants:**
- ✨ MultiSelect Component
- ✨ Tags Input Component
- ✨ Rating Component
- ✨ Slider/Range Component

**Nouvelles Fonctionnalités Datatable:**
- ✨ Advanced Filters (Text, Select, Date Range)
- ✨ Excel/CSV Export
- ✨ Bulk Actions

**Système de Notifications:**
- ✨ Toast Notifications

**Outils de Développement:**
- ✨ Commande Artisan pour générer des datatables
- ✨ Documentation complète
- ✨ Helpers pour les toasts

## 📄 License

BallStack is open-sourced software licensed under the MIT license.

## 👨‍💻 Auteurs

- **Tresor Kasenda** - Créateur et mainteneur principal
- **Claude AI** - Assistance au développement Phase 1

## 🙏 Remerciements

Merci à tous les contributeurs et à la communauté Laravel!

---

**Questions?** Ouvrez une issue sur [GitHub](https://github.com/Tresor-Kasenda/ballstack/issues)

**Documentation complète:** [PHASE_1_FEATURES.md](PHASE_1_FEATURES.md)
