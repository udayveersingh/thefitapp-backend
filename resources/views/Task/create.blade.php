<x-layout.default>


    {{-- <form action="" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-1 sm:flex justify-between">
            <input type="text" placeholder="Task Name" name="task_name" class="form-input" />
            <input type="text" placeholder="Task Link" name ="task_link" class="form-input"/>
        </div>
        <div class="grid grid-cols-2 sm:flex justify-between">
            <input type="text" placeholder="Task Name" name="task_name" class="form-input" />
            <input type="text" placeholder="Task Link" name ="task_link" class="form-input"/>
        </div>
        <button type="button" class="btn btn-primary mt-6">Submit</button>
    </form> --}}
    <div class="panel lg:row-span-3">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Add Task</h5>
        </div>
    <form class="space-y-5" action="{{ route('task.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="taskName">Task Name</label>
            <input type="text" placeholder="Task Name" name="task_name" class="form-input" />
        </div>
        <div>
            <label for="taskLink">Task Link</label>
            <input type="text" placeholder="Task Link" name ="task_link" class="form-input" required />
        </div>
        <div>
            <label for="startDate">Start Date</label>
            <input type="date"  name ="start_date" class="form-input" required />
        </div>
        <div>
            <label for="endDate">End Date</label>
            <input type="date"  name ="end_date" class="form-input" required />
        </div>
        <div>
            <label for="taskSummary">Task Summary</label>
            <textarea id="task_summary" rows="3" class="form-textarea" placeholder="Task Summary.." required></textarea>
        </div>
        <button type="submit" value="submit" class="btn btn-primary !mt-6">Submit</button>
    </form>
</div>

</x-layout.default>