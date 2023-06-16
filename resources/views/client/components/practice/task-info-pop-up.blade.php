<div class="task-info-container" id="task-info-container-{{ $task->id }}" data-id="{{ $task->id }}">
    <span class="little-arrow">

    </span>
    <div>
        @if($task->finished)
            @if(session()->get('user')->language_id == 1)
                <p>Congratulations! You finished this level!</p>
            @elseif(session()->get('user')->language_id == 2)
                <p>Svaka čast! Završili ste nivo!</p>
            @endif
        @else
            <p>Level {{ $task->levels_finished }}/{{ $task->level_quantity }}</p>
        @endif

    </div>
    <div>
        @if(session()->get('user')->language_id == 1)
            <h4>{{ ucfirst($task->title) }}</h4>
        @elseif(session()->get('user')->language_id == 2)
            <h4>{{ ucfirst($task->srb_translation) }}</h4>
        @endif

    </div>
    <div class="link-container">
        @if(session()->get('user')->language_id == 1)
            <a href="{{ route('task', $task->id) }}" class="btn-get-started btn white-bg-button">Practice</a>
        @elseif(session()->get('user')->language_id == 2)
            <a href="{{ route('task', $task->id) }}" class="btn-get-started btn white-bg-button">Vežba</a>
        @endif
    </div>
    <div class="link-container">
        @if(session()->get('user')->language_id == 1)
            <a href="{{ route("task-info", $task->id) }}" class="btn-get-started btn white-bg-button">Tips</a>
        @elseif(session()->get('user')->language_id == 2)
            <a href="{{ route("task-info", $task->id) }}" class="btn-get-started btn white-bg-button">Pomoć</a>
        @endif
    </div>
</div>
