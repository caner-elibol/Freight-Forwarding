<x-app-layout>
    <x-slot name="header">
        Tasks
    </x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><a href="{{route('tasks.create')}}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i>  Create Task</a></h5>
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">#</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Task Type</th>
                    <th scope="col">Task Status</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Country</th>
                    <th scope="col">Prerequisites</th>
                    <th scope="col">Activity</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                      $no=1;
                  @endphp
                    @foreach ($tasks as $task)
                  <tr>
                    <th scope="row">{{$no}}</th>
                    <th scope="row">{{$task->id}}</th>
                    <td>{{$task->task_name}}</td>
                    <td>{{$task->task_type}}</td>
                    <td style="text-color: white" class="bg-{{ $task->task_status === "Progress"?'warning':($task->task_status === "Finished"?'success':'danger')}}">{{$task->task_status}}</td>
                    <td>{{$task->amount}}</td>
                    <td>{{$task->country}}</td>
                    <td>{{$task->prerequisites}}</td>
                    <td>
                        <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-sm btn-{{ $task->task_status === "Progress"?'success':'warning'}}" @if($task->task_status == "Finished") style="display: none" @endif>{{ $task->task_status === "Progress"?'Görevi Bitir':'Göreve Başla'}}</a>
                        <a href="" class="btn btn-sm btn-danger"><i class="fa fa-erase"></i>Görevi Sil</a>
                    </td>
                  </tr>
                  @php
                      $no++;
                  @endphp
                  @endforeach
                </tbody>
              </table>
              {{$tasks->links()}}
        </div>
    </div>
</x-app-layout>
