@php
    $models = $getModels();
    $actions = $getActions();
    $columns = $getFields();
    $datas = $models['data'];
@endphp
<div class="card-inner-group">
    <div class="card-inner p-0">
        <div class="nk-tb-list nk-tb-ulist">
            @if($columns)
                <div class="nk-tb-item nk-tb-head">
                    @foreach($columns as $value => $column)
                        <div class="nk-tb-col">
                            <span class="sub-text">{{ $column }}</span>
                        </div>
                        @if($column === 'actions')
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1 my-n1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                               data-bs-toggle="dropdown">
                                                <em class="icon ni ni-more-h"></em>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><em class="icon ni ni-mail"></em><span>Send Email to All</span></a>
                                                    </li>
                                                    <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend Selected</span></a>
                                                    </li>
                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Seleted</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
            @if($datas)
                @foreach($datas as $value => $item)
                    <div class="nk-tb-item">
                        @foreach($columns as $field => $column)
                            <div class="nk-tb-col tb-col-md">
                                <span>{{ $item->$field }}</span>
                            </div>
                            @if($field === 'actions')
                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li class="nk-tb-action-hidden">
                                            <a wire:navigate href="{{ route($actions['show'], $item->id) }}"
                                               class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                               data-bs-placement="top" title="Show">
                                                <em class="icon ni ni-eye-fill"></em>
                                            </a>
                                        </li>
                                        <li class="nk-tb-action-hidden">
                                            <a wire:navigate href="{{ route($actions['edit'], $item->id) }}"
                                               class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                               data-bs-placement="top" title="Edit">
                                                <em class="icon ni ni-edit-fill"></em>
                                            </a>
                                        </li>
                                        <li class="nk-tb-action-hidden">
                                            <button type="button" wire:click="delete({{ $item->id }})"
                                                    class="btn btn-danger btn-icon"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Delete">
                                                <em class="icon ni ni-trash-fill"></em>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="card-inner">
        <div class="nk-block-between-md g-3">
            <div class="g">
                {{ $datas->links('components.pagination') }}
            </div>
        </div>
    </div>
</div>
