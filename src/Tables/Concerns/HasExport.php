<?php

declare(strict_types=1);

namespace Tresorkasenda\Tables\Concerns;

use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Has Export Trait
 *
 * Adds export capabilities (Excel, CSV, PDF) to Datatable.
 *
 * @package Tresorkasenda\Tables\Concerns
 */
trait HasExport
{
    /**
     * Enable export functionality.
     *
     * @var bool
     */
    protected bool $exportable = false;

    /**
     * Allowed export formats.
     *
     * @var array
     */
    protected array $exportFormats = ['excel', 'csv'];

    /**
     * Columns to export.
     *
     * @var array|null
     */
    protected ?array $exportColumns = null;

    /**
     * Enable export functionality.
     *
     * @param array $formats Allowed formats: excel, csv, pdf
     * @return static
     */
    public function exportable(array $formats = ['excel', 'csv']): static
    {
        $this->exportable = true;
        $this->exportFormats = $formats;
        return $this;
    }

    /**
     * Check if export is enabled.
     *
     * @return bool
     */
    public function isExportable(): bool
    {
        return $this->exportable;
    }

    /**
     * Get allowed export formats.
     *
     * @return array
     */
    public function getExportFormats(): array
    {
        return $this->exportFormats;
    }

    /**
     * Set columns to export.
     *
     * @param array $columns
     * @return static
     */
    public function exportColumns(array $columns): static
    {
        $this->exportColumns = $columns;
        return $this;
    }

    /**
     * Get columns to export.
     *
     * @return array
     */
    public function getExportColumns(): array
    {
        return $this->exportColumns ?? array_keys($this->fields);
    }

    /**
     * Export data to CSV.
     *
     * @return StreamedResponse
     */
    public function exportToCsv(): StreamedResponse
    {
        $filename = $this->name . '_' . date('Y-m-d_H-i-s') . '.csv';
        $columns = $this->getExportColumns();
        $data = $this->getExportData($columns);

        return response()->streamDownload(function () use ($data, $columns) {
            $handle = fopen('php://output', 'w');

            // Write headers
            fputcsv($handle, $columns);

            // Write data rows
            foreach ($data as $row) {
                $rowData = [];
                foreach ($columns as $column) {
                    $rowData[] = $row->$column ?? '';
                }
                fputcsv($handle, $rowData);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Export data to Excel.
     *
     * This method requires maatwebsite/excel package.
     * If not installed, it will fall back to CSV export.
     *
     * @return StreamedResponse
     */
    public function exportToExcel(): StreamedResponse
    {
        // Check if maatwebsite/excel is installed
        if (!class_exists(\Maatwebsite\Excel\Facades\Excel::class)) {
            // Fallback to CSV
            return $this->exportToCsv();
        }

        $filename = $this->name . '_' . date('Y-m-d_H-i-s') . '.xlsx';
        $columns = $this->getExportColumns();
        $data = $this->getExportData($columns);

        // Create a simple export class
        $export = new class($data, $columns) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
            public function __construct(
                protected Collection $data,
                protected array $columns
            ) {}

            public function collection(): Collection
            {
                return $this->data->map(function ($row) {
                    $rowData = [];
                    foreach ($this->columns as $column) {
                        $rowData[$column] = $row->$column ?? '';
                    }
                    return $rowData;
                });
            }

            public function headings(): array
            {
                return $this->columns;
            }
        };

        return \Maatwebsite\Excel\Facades\Excel::download($export, $filename);
    }

    /**
     * Get data for export.
     *
     * @param array $columns
     * @return Collection
     */
    protected function getExportData(array $columns): Collection
    {
        // Get the query with filters applied
        $query = $this->getBaseQuery();

        // Select only export columns
        $query->select($columns);

        // Return all data (not paginated)
        return $query->get();
    }

    /**
     * Get the base query with filters applied.
     * This should be overridden by the datatable implementation.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getBaseQuery()
    {
        // This will be overridden by the datatable
        return $this->model['query'] ?? null;
    }
}
