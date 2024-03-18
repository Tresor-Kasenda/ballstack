@php
    $events = $getEvents();
    $type = $getType();
    $editable = $getEditable();
    $selectable = $getSelectable();
    $height = $getHeight();
@endphp

<div
    class="card"
    data-calendar="true"
    x-data="{
        calendar: null,
        init() {
            this.calendar = new FullCalendar.Calendar(this.$refs.calendar, {
                timeZone: 'UTC',
                initialView: '{{ $type }}',
                @if($selectable) editable: true, @endif
                @if($editable) selectable: true, @endif
                height: {{ $height ?? 650 }},
                themeSystem: 'bootstrap5',
                contentHeight: 780,
                aspectRatio: 3,
                views: {
                   dayGridMonth: {
                     dayMaxEventRows: 2
                   }
                },
                nowIndicator: true,
                events: {!! str_replace('"', "'", json_encode($events)) !!},
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                select: function(data) {
                    console.log(data)
                },
                eventDrop: function(data) {
                    @this.updateEvent(data.event.id, data.event.startStr, data.event.endStr);
                },
            });
            this.calendar.render();
        }
    }"
    x-init="init"
>
    <div class="card-inner">
        <div id="calendar" x-ref="calendar" class="nk-calendar"></div>
    </div>
</div>

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
@endpush
