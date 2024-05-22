<x-app-layout>
    <x-slot name="header" class="hidden">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>
    @if (Auth::user()->admin == '0')    
    @include('includes.dashboard-cliente')
    @endif
    @if (Auth::user()->admin == '1')    
    @include('includes.dashboard')
    @endif
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
                    
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var weeklyCalendarEl = document.getElementById('weeklyCalendar');

        var weeklyCalendar = new FullCalendar.Calendar(weeklyCalendarEl, {
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'timeGridWeek'
            },
            initialView: 'timeGridWeek',
            timeZone: 'GMT+1',
            events: '/events',
            editable: false,
            slotDuration: '01:00:00',
            slotLabelInterval: '01:00:00',
            slotEventOverlap: false,
            slotMinTime: '07:00:00',
            slotMaxTime: '20:00:00',
            slotLabelInterval: '01:00:00',
            slotLabelFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            }
        });

        weeklyCalendar.render();
    });
</script>