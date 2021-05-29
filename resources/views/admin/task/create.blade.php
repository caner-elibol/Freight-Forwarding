<x-app-layout>
    <x-slot name="header">
        Create a Task
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create New</h5>
            <form action="{{route('tasks.store')}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4 pt-4">
                        <label for="task_name">Task Name</label>
                        <input type="text" name="task_name" class="form-control" id="task_name" placeholder="Task Name">
                    </div>
                    <div class="form-group col-md-4 pt-4">
                        <label for="task_type">Task Type</label>
                        <select name="task_type" id="task_type">
                            <option value="common_ops">Common Ops</option>
                            <option value="custom_ops">Custom Ops</option>
                            <option value="invoice_ops">İnvoice Ops</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-4 pt-4">
                    <label for="prerequisites">Prequisites</label>
                    <select multiple="multiple" name="prerequisites[]" id="prequisites">
                        @php
                            $sayi=1;
                        @endphp
                        @foreach ($tasks as $task)

                        <option value="{{$task->id}}">{{$sayi}} - {{$task->task_name}}</option>
                        @php
                            $sayi++;
                        @endphp
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12 pt-4">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>
<script>
    $('#prequisites').multiSelect();
</script>
