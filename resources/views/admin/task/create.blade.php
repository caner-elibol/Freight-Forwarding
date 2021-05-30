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
                    <div id="quantitydiv" style="display:none" class="form-group col-md-4 pt-4">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" placeholder="1000">
                    </div>
                    <div id="currencydiv" style="display:none" class="form-group col-md-4 pt-4">
                        <label for="currency">Currency</label>
                        <select name="currency" id="currency">
                            <option value="₺">₺</option>
                            <option value="£">£</option>
                            <option value="$">$</option>
                            <option value="€">€</option>
                        </select>
                    </div>
                    <div id="countrydiv" style="display:none" class="form-group col-md-4 pt-4">
                        <label for="country">Country</label>
                        <select name="country" id="country">
                            <option value="TR">TR</option>
                            <option value="DE">DE</option>
                            <option value="EN">EN</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-4 pt-4">
                    <label for="prerequisites">Prequisites</label>
                    <select multiple="multiple" name="prerequisites[]" id="prequisites">
                        @php
                            $sayi=1;
                        @endphp
                        <option value="none">Deselect</option>
                        @foreach ($tasks as $task)
                        <option value="{{$task->id}}">{{$task->id}} - {{$task->task_name}}</option>
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
    <x-slot name="js">
        <script>
            $('#task_type').change(function(){

                var select=document.getElementById("task_type");
                var value=select.options[select.selectedIndex].value;
                if(value=='custom_ops')
                {
                    $('#countrydiv').show();
                    $('#currencydiv').hide();
                    $('#quantity').required=false;
                    $('#quantitydiv').hide();
                }
                else if(value=='invoice_ops')
                {
                    $('#currencydiv').show();
                    $('#quantitydiv').show();
                    $('#quantity').required=true;
                    $('#countrydiv').hide();
                }
                else
                {
                    $('#currencydiv').hide();
                    $('#quantitydiv').hide();
                    $('#quantity').required=false;
                    $('#countrydiv').hide();
                }

            })

        </script>
    </x-slot>
</x-app-layout>

