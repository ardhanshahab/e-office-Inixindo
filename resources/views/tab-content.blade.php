@foreach ($data as $index => $monthRange)
    <div class="tab-pane fade{{ $index === 0 ? ' show active' : '' }}" id="pane-{{ $index }}" role="tabpanel" aria-labelledby="tab-{{ $index }}">
        @foreach ($monthRange['weeks'] as $weekRange)
            <p>{{ $weekRange['start'] }} - {{ $weekRange['end'] }}</p>
        @endforeach
    </div>
@endforeach
