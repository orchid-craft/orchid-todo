<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
           
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Total Tasks</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalCount }}</p>
                </div>
                <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
            </div>
           
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Pending</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $pendingCount }}</p>
                </div>
                <div class="p-3 bg-amber-50 rounded-xl text-amber-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Completed</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $completedCount }}</p>
                </div>
                <div class="p-3 bg-emerald-50 rounded-xl text-emerald-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 lg:col-span-1">
                <h3 class="text-lg font-semibold text-gray-800">Add New Task</h3>
                <form wire:submit.prevent="addTodo" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Task Description
                        </label>
                        <input 
                            type="text" 
                            wire:model="task" 
                            placeholder="What needs to be done?"  
                            class="w-full rounded-lg border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm p-3"
                        >
                        @error('task') 
                            <p class="text-red-500 text-xs mb-4">{{ $message }}</p> 
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Category</label>
                        <select 
                            wire:model="category" 
                            class="w-full rounded-lg border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 text-sm bg-gray-50/50"
                        >
                            @foreach($categoryList as $cat)
                                <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                            @endforeach
                        </select>
                        @error('category') 
                            <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> 
                        @enderror
                    </div>
                    <button 
                        type="submit" 
                        class="w-full justify-center inline-flex items-center px-4 py-3 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150 dynamic"
                    >
                        Add to List
                    </button>
                </form>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 lg:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-800">
                        {{ $showTrashed ? 'Trash Bin (Archived Tasks)' : 'Task Dynamic List' }}
                    </h3>
                    <span class="text-xs font-medium text-gray-400" mt-0.5>
                        {{ $showTrashed ? 'Showing soft-deleted records' : 'Real-time Updates'}}
                    </span>

                    <button 
                        wire:click="toggleTrashMode"
                        class="inline-flex items-center gap-1-5 px-3 py-1.5 rounded-lg text-xs font-semibold transition-all duration-150 {{ $showTrashed ? 'bg-slate-100 text-slate-700 hover:bg-slate-200' : 'bg-red-50 text-red-600 hover:bg-red-100'}}">
                        @if($showTrashed)
                            ⬅️ Back to Active Tasks
                        @else
                            🗑️ View Trash
                        @endif
                    </button>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 mb-5">
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input 
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search tasks..."
                            class="w-full pl-9 rounded-lg border-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50/50 p-2.5"
                        >
                    </div>

                    @if(!$showTrashed)
                        <div class="flex bg-gray-100 p-1 rounded-lg text-xs font-semibold text-gray-600 self-start sm:self-auto">
                            <button wire:click="$set('filterStatus','all')" class="px-3 py-1.5 rounded-md transition-all {{ $filterStatus === 'all' ? 'bg-white text-indigo-600 shadow-sm' : 'hover:text-gray-900'}}">
                                All
                            </button>
                            <button wire:click="$set('filterStatus','pending')" class="px-3 py-1.5 rounded-md transition-all {{ $filterStatus === 'pending' ? 'bg-white text-amber-600 shadow-sm' : 'hover:text-gray-900'}}">
                                Pending
                            </button>
                            <button wire:click="$set('filterStatus','completed')" class="px-3 py-1.5 rounded-md transition-all {{ $filterStatus === 'completed' ? 'bg-white text-emerald-600 shadow-sm' : 'hover:text-gray-900'}}">
                                Completed
                            </button>
                        </div>
                    @endif
                </div>

                @if(!$showTrashed)
                    <div class="mt-1 mb-5 flex flex-wrap gap-x-2.5 gap-y-2 items-center text-[11px] font-bold text-gray-500">
                        <span class="mr-1.5 text-gray-400 uppercase tracking-wider text-[10px]">
                            category filter:
                        </span>
                        <button wire:click="set('filterCategory','all')" class="px-3 py-1.5 rounded-md capitalize transition border {{ $filterCategory === 'all' ? 'bg-indigo-50 border-indigo-200 text-indigo-700' : 'bg-white border-gray-200 hover:bg-gray-50'}}">
                            all categories
                        </button>
                        @foreach($categoryList as $cat)
                            <button wire:click="$set('filterCategory','{{$cat}}')" class="px-3 py-1.5 rounded-md transition border {{ $filterCategory === $cat ? 'bg-indigo-50 border-indigo-200 text-indigo-700' : 'bg-white border-gray-200 hover:bg-gray-50'}}">
                                {{ $cat }}
                            </button>
                        @endforeach
                    </div>
                @endif

                <ul class="space-y-3">
                    @forelse($todos as $todo)
                        <li class="flex items-center justify-between p-4 rounded-xl border transition-all duration-200 group {{ $todo->is_completed ? 'bg-gray-50/70 border-gray-100 opacity-60' : 'bg-white border-gray-100 hover:border-indigo-100 hover:shadow-sm' }}">
                            <div class="flex items-center gap-3.5 flex-1">
                                <input 
                                    type="checkbox"
                                    wire:click="toggleTodo({{ $todo->id }})"
                                    {{ $todo->is_completed ? 'checked' : '' }}
                                    {{ $showTrashed ? 'disabled' : ''}}
                                    class="w-5 h-5 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer"
                                >
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium transition-all duration-150 {{ $todo->is_completed ? 'line-through text-gray-400' : 'text-gray-700' }}">
                                        {{ $todo->task }}
                                    </span>
                                    
                                    <span class="text-[11px] text-gray-400 mt-0.5 font-normal tracking-wide">
                                        ⏱️ Created {{ $todo->created_at->setTimezone('Asia/Jakarta')->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($showTrashed)
                                    <button                        
                                        wire:click="restoreTodo({{ $todo->id }})"
                                        class="text-emerald-600 hover:bg-emerald-50 rounded-lg p-1.5 transition"
                                        title="Restore Task"
                                   >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 10H18"></path></svg>
                                    </button>
    
                                    <button                        
                                        wire:click="forceDeleteTodo({{ $todo->id }})"
                                        class="text-red-600 hover:bg-red-50 rounded-lg p-1.5 transition"
                                        title="Delete Permanently"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                @else
                                    <button                        
                                        wire:click="deleteTodo({{ $todo->id }})"
                                        class="text-gray-400 hover:text-red-600 transition-colors duration-150 lg:opacity-0 group-hover:opacity-100 p-1"
                                        title="Move to Trash"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>  
                                @endif
    
                            </div>                    
                        </li>
                    @empty
                        <div class="text-center py-12 border-2 border-dashed border-gray-100 rounded-xl">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            <p class="mt-4 text-sm font-semibold text-gray-500">
                               {{ $showTrashed ? 'Trash bin is empty' : 'No tasks remaining' }}
                            </p>
                        </div>
                    @endforelse
                </ul>
                    <div class="mt-5">
                        {{ $todos->links() }} <!-- Pagination links -->
                    </div>
            </div>
        </div>
    </div>
</div>
