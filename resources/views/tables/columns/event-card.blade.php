@props(['record'])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 flex flex-col justify-between h-full">
    <div class="space-y-2">
        <h5 class="text-lg font-bold text-gray-900 dark:text-white leading-snug">
            {{ record->title }}
        </h5>



        <div class="mt-4 flex justify-end space-x-2">
            @foreach($getTable()->getActions() as $action)
            {{ $action }}
            @endforeach
        </div>
    </div>
</div>