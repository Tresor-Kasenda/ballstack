<?php

declare(strict_types=1);

namespace Tresorkasenda\Tables\Concerns;

use Closure;

/**
 * Has Bulk Actions Trait
 *
 * Adds bulk action capabilities to Datatable.
 *
 * @package Tresorkasenda\Tables\Concerns
 */
trait HasBulkActions
{
    /**
     * Available bulk actions.
     *
     * @var array
     */
    protected array $bulkActions = [];

    /**
     * Selected items for bulk actions (Livewire property).
     *
     * @var array
     */
    public array $selectedItems = [];

    /**
     * Select all items flag (Livewire property).
     *
     * @var bool
     */
    public bool $selectAll = false;

    /**
     * Actions that require confirmation.
     *
     * @var array
     */
    protected array $bulkActionsRequiringConfirmation = [];

    /**
     * Set bulk actions for the datatable.
     *
     * @param array $actions Associative array of action key => label or Closure
     * @return static
     */
    public function bulkActions(array $actions): static
    {
        $this->bulkActions = $actions;
        return $this;
    }

    /**
     * Get bulk actions.
     *
     * @return array
     */
    public function getBulkActions(): array
    {
        return $this->bulkActions;
    }

    /**
     * Set bulk actions that require confirmation.
     *
     * @param array|string $actions Action key(s) that require confirmation
     * @return static
     */
    public function confirmBulkAction(array|string $actions): static
    {
        $this->bulkActionsRequiringConfirmation = is_array($actions) ? $actions : [$actions];
        return $this;
    }

    /**
     * Check if a bulk action requires confirmation.
     *
     * @param string $action
     * @return bool
     */
    public function bulkActionRequiresConfirmation(string $action): bool
    {
        return in_array($action, $this->bulkActionsRequiringConfirmation);
    }

    /**
     * Execute a bulk action.
     *
     * @param string $action
     * @return void
     */
    public function executeBulkAction(string $action): void
    {
        if (empty($this->selectedItems)) {
            session()->flash('error', __('No items selected'));
            return;
        }

        if (!isset($this->bulkActions[$action])) {
            session()->flash('error', __('Invalid bulk action'));
            return;
        }

        $actionHandler = $this->bulkActions[$action];

        // If action handler is a Closure, execute it
        if ($actionHandler instanceof Closure) {
            $result = $actionHandler($this->selectedItems);

            if ($result === false) {
                session()->flash('error', __('Bulk action failed'));
            } else {
                session()->flash('success', __('Bulk action completed successfully'));
                $this->clearSelection();
            }
        } else {
            // Call a method on the datatable class
            $methodName = 'bulkAction' . ucfirst($action);

            if (method_exists($this, $methodName)) {
                $this->$methodName($this->selectedItems);
                session()->flash('success', __('Bulk action completed successfully'));
                $this->clearSelection();
            } else {
                session()->flash('error', __('Bulk action handler not found'));
            }
        }

        // Reset the page to prevent empty results
        $this->resetPage();
    }

    /**
     * Toggle selection of an item.
     *
     * @param mixed $itemId
     * @return void
     */
    public function toggleSelection($itemId): void
    {
        if (in_array($itemId, $this->selectedItems)) {
            $this->selectedItems = array_values(array_diff($this->selectedItems, [$itemId]));
        } else {
            $this->selectedItems[] = $itemId;
        }
    }

    /**
     * Toggle select all items.
     *
     * @return void
     */
    public function toggleSelectAll(): void
    {
        if ($this->selectAll) {
            // Deselect all
            $this->selectedItems = [];
            $this->selectAll = false;
        } else {
            // Select all visible items
            $query = $this->getBaseQuery();
            $this->selectedItems = $query->pluck('id')->toArray();
            $this->selectAll = true;
        }
    }

    /**
     * Clear selection.
     *
     * @return void
     */
    public function clearSelection(): void
    {
        $this->selectedItems = [];
        $this->selectAll = false;
    }

    /**
     * Check if an item is selected.
     *
     * @param mixed $itemId
     * @return bool
     */
    public function isItemSelected($itemId): bool
    {
        return in_array($itemId, $this->selectedItems);
    }

    /**
     * Get the count of selected items.
     *
     * @return int
     */
    public function getSelectedCount(): int
    {
        return count($this->selectedItems);
    }

    /**
     * Check if any items are selected.
     *
     * @return bool
     */
    public function hasSelectedItems(): bool
    {
        return !empty($this->selectedItems);
    }
}
