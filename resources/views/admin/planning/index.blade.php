@extends('admin.layout')

@section('main')
    <div class="row justify-content-center">
        <div class="col-2">
            <a href="{{route('planning.create')}}" class="btn btn-primary">Créer une nouvelle Tâche</a>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agenda</div>

                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '{{ route('planning.getEvents') }}',
            });

            calendar.render();
        });
    </script>
@endsection
