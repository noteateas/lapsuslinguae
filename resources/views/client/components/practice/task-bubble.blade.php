<div style="position: relative" >
    <div @if(!$disabled) class="task task-click" @else class="task task-disabled" @endif  data-id="{{ $task->id }}">
        <div class="task-bubble-ring @if($task->finished === true) circular-progress @endif">
            {!! $task->symbol !!}
        </div>
        @if(session()->get('user')->language_id == 1)
            <h3>{{ ucfirst($task->title) }}</h3>
        @elseif(session()->get('user')->language_id == 2)
            <h3>{{ ucfirst($task->srb_translation) }}</h3>
        @endif
    </div>
    @include("client.components.practice.task-info-pop-up",["task" => $task])
</div>




