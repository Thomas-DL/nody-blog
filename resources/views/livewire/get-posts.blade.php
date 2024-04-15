<div>
    {{-- Post List Component --}}
    @if ($this->posts()->count() <= 0)
        <div class="pt-10">
            @if ($this->showSearch && $this->showSearch === '1')
                <div class="flex px-12 mb-10 justify-center max-w-lg lg:px-0 mx-4 sm:mx-auto">
                    <div class="relative w-full mt-2">
                        <input type="text" name="search" id="search" placeholder="Search" wire:model.live="search"
                            class="block w-full rounded-md border-0 py-1.5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
            @endif
            @if ($this->showFilters && $this->showFilters === '1')
                <div class="bg-white dark:bg-gray-900 mt-10" x-data="{ open: false }">
                    <div x-show="open" class="relative z-50 sm:hidden" role="dialog" aria-modal="true">
                        <div class="fixed inset-0 bg-black bg-opacity-25"></div>

                        <div class="fixed inset-0 z-40 flex">
                            <div
                                class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white dark:bg-gray-900 py-4 pb-12 shadow-xl">
                                <div class="flex items-center justify-between px-4 mb-4">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Filters</h2>
                                    <button type="button" @click="open = false"
                                        class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white dark:bg-gray-800 p-2 text-gray-400">
                                        <span class="sr-only">Close menu</span>
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Filters -->
                                <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-6"
                                    x-data="{ openCategories: false }">
                                    <h3 class="-mx-2 -my-3 flow-root">
                                        <!-- Expand/collapse section button -->
                                        <button type="button" @click="openCategories = !openCategories"
                                            class="flex w-full items-center justify-between bg-white dark:bg-gray-900 px-2 py-3 text-sm text-gray-400 dark:text-white"
                                            aria-controls="filter-section-0" aria-expanded="false">
                                            <span class="font-medium text-gray-900 dark:text-white">Category</span>
                                            <span class="ml-6 flex items-center">
                                                <svg class="rotate-0 h-5 w-5 transform" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </button>
                                    </h3>
                                    <!-- Filter section, show/hide based on section state. -->
                                    <div x-show="openCategories" @click.away="openCategories = false" x-transition
                                        class="pt-6" id="filter-section-0">
                                        <div class="space-y-6">
                                            @foreach ($this->categories as $category)
                                                <div class="flex items-center" wire:key="{{ $category->id }}">
                                                    <input id="filter-mobile-{{ $category->slug }}" name="category"
                                                        wire:click="filterByCategory({{ $category->id }})"
                                                        value="new-arrivals" type="radio"
                                                        class="border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-mobile-{{ $category->slug }}"
                                                        class="ml-3 text-sm text-gray-500">
                                                        {{ $category->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-6"
                                    x-data="{ openTags: false }">
                                    <h3 class="-mx-2 -my-3 flow-root">
                                        <!-- Expand/collapse section button -->
                                        <button type="button" @click="openTags = !openTags"
                                            class="flex w-full items-center justify-between bg-white dark:bg-gray-900 px-2 py-3 text-sm text-gray-400 dark:text-white"
                                            aria-controls="filter-section-0" aria-expanded="false">
                                            <span class="font-medium text-gray-900 dark:text-white">Tags</span>
                                            <span class="ml-6 flex items-center">
                                                <svg class="rotate-0 h-5 w-5 transform" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </button>
                                    </h3>
                                    <!-- Filter section, show/hide based on section state. -->
                                    <div x-show="openTags" @click.away="openTags = false" x-transition class="pt-6"
                                        id="filter-section-0">
                                        <div class="space-y-6">
                                            @foreach ($this->tags as $tag)
                                                <div class="flex items-center" wire:key="{{ $tag->id }}">
                                                    <input id="filter-mobile-{{ $tag->slug }}" name="tag"
                                                        wire:click="filterByTags({{ $tag->id }})"
                                                        value="new-arrivals" type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-mobile-{{ $tag->slug }}"
                                                        class="ml-3 text-sm text-gray-500">
                                                        {{ $tag->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <section aria-labelledby="filter-heading"">
                        <h2 id="filter-heading" class="sr-only">Filters</h2>

                        <div class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 pb-4">
                            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                                <div class="relative inline-block text-left" x-data="{ open: false }">
                                    <div>
                                        <button type="button" @click="open = !open"
                                            class="group inline-flex justify-center text-sm font-medium text-gray-700 dark:text-white  hover:text-gray-900 dark:hover:text-gray-200"
                                            id="menu-button" aria-expanded="false" aria-haspopup="true">
                                            Sort
                                            <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 dark:text-gray-200 group-hover:text-gray-500 dark:group-hover:text-gray-200"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div x-show="open" @click.away="open = false" x-transition
                                        class="absolute left-0 z-10 mt-2 w-40 origin-top-left rounded-md bg-white dark:bg-gray-900 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                        tabindex="-1">
                                        <div class="py-1" role="none">
                                            <span wire:click="sortBy('best-rating')"
                                                class="text-gray-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-500 transition block px-4 py-2 text-sm cursor-pointer"
                                                role="menuitem" tabindex="-1" id="menu-item-1">
                                                Best Rating
                                            </span>
                                            <span wire:click="sortBy('newest')"
                                                class="text-gray-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-500 transition block px-4 py-2 text-sm cursor-pointer"
                                                role="menuitem" tabindex="-1" id="menu-item-2">
                                                Newest
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mobile filter dialog toggle, controls the 'mobileFiltersOpen' state. -->
                                <button type="button" @click="open = !open"
                                    class="inline-block text-sm font-medium text-gray-700 dark:text-white hover:text-gray-900 dark:hover:text-gray-200 sm:hidden">
                                    Filters
                                </button>

                                <div class="hidden sm:block">
                                    <div class="flow-root">
                                        <div
                                            class="-mx-4 flex items-center divide-x divide-gray-200 dark:divide-gray-700">
                                            <div class="relative inline-block px-4 text-left" x-data="{ open: false }">
                                                <button type="button" @click="open = !open"
                                                    class="group inline-flex justify-center text-sm font-medium text-gray-700 dark:text-white hover:text-gray-900 dark:hover:text-gray-200"
                                                    aria-expanded="false">
                                                    <span>Category</span>
                                                    @if (!empty($this->selectedCategory))
                                                        <span
                                                            class="ml-1.5 rounded border border-gray-300 dark:border-indigo-500 bg-gray-200 dark:bg-indigo-500/30 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700 dark:text-white">
                                                            1
                                                        </span>
                                                    @else
                                                        <span
                                                            class="ml-1.5 rounded border border-gray-300 dark:border-indigo-500 bg-gray-200 dark:bg-indigo-500/30 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700 dark:text-white">
                                                            0
                                                        </span>
                                                    @endif
                                                    <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 dark:text-gray-200 group-hover:text-gray-500 dark:group-hover:text-gray-200"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <div x-show="open" @click.away="open = false" x-transition
                                                    class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white dark:bg-gray-900 p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                    <form class="space-y-4">
                                                        @foreach ($this->categories as $category)
                                                            <div class="flex items-center"
                                                                wire:key="{{ $category->id }}">
                                                                <input id="filter-{{ $category->slug }}"
                                                                    name="category" value="new-arrivals"
                                                                    type="radio"
                                                                    wire:click="filterByCategory({{ $category->id }})"
                                                                    class="border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                                <label for="filter-category"
                                                                    class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900 dark:text-white">
                                                                    {{ $category->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="relative inline-block px-4 text-left" x-data="{ open: false }">
                                                <button type="button" @click="open = !open"
                                                    class="group inline-flex justify-center text-sm font-medium text-gray-700 dark:text-white hover:text-gray-900 dark:hover:text-gray-200"
                                                    aria-expanded="false">
                                                    <span>Tags</span>
                                                    @if (!empty($this->selectedTags))
                                                        <span
                                                            class="ml-1.5 rounded border border-gray-300 dark:border-indigo-500 bg-gray-200 dark:bg-indigo-500/30 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700 dark:text-white">
                                                            {{ count($this->selectedTags) }}
                                                        </span>
                                                    @else
                                                        <span
                                                            class="ml-1.5 rounded border border-gray-300 dark:border-indigo-500 bg-gray-200 dark:bg-indigo-500/30 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700 dark:text-white">
                                                            0
                                                        </span>
                                                    @endif
                                                    <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 dark:text-gray-200 group-hover:text-gray-500 dark:group-hover:text-gray-200"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <div x-show="open" @click.away="open = false" x-transition
                                                    class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white dark:bg-gray-900 p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                    <form class="space-y-4">
                                                        @foreach ($this->tags as $tag)
                                                            <div class="flex items-center"
                                                                wire:key="{{ $tag->id }}">
                                                                <input id="filter-{{ $tag->slug }}" name="tags"
                                                                    {{ in_array($tag->name, $this->selectedTagsName) ? 'checked' : '' }}
                                                                    value="{{ $tag->id }}" type="checkbox"
                                                                    wire:click="filterByTags({{ $tag->id }})"
                                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                                <label for="filter-tags"
                                                                    class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900 dark:text-white">
                                                                    {{ $tag->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active filters -->
                        <div class="bg-gray-100 dark:bg-gray-800">
                            <div class="mx-auto max-w-7xl px-4 py-3 sm:flex sm:items-center sm:px-6 lg:px-8">
                                @if ($this->selectedCategoryName || $this->selectedTagsName)
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-500 transition cursor-pointer"
                                        wire:click="clearFilters">
                                        Clear all filters
                                        <span class="sr-only">, active</span>
                                    </h3>
                                @else
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-white">
                                        Filters
                                        <span class="sr-only">, active</span>
                                    </h3>
                                @endif


                                <div aria-hidden="true"
                                    class="hidden h-5 w-px bg-gray-300 dark:bg-gray-700 sm:ml-4 sm:block"></div>

                                <div class="mt-2 sm:ml-4 sm:mt-0">
                                    <div class="-m-1 flex flex-wrap items-center">
                                        @if ($this->selectedCategoryName)
                                            <span
                                                class="m-1 inline-flex items-center rounded-full border border-gray-200 dark:border-indigo-500 bg-white dark:bg-indigo-500/30 py-1.5 px-3 text-sm font-medium text-gray-900 dark:text-white">
                                                <span>{{ $this->selectedCategoryName }}</span>
                                            </span>
                                        @endif
                                        @if ($this->selectedTagsName)
                                            @foreach ($this->selectedTagsName as $tag)
                                                <span wire:key="{{ $tag }}"
                                                    class="m-1 inline-flex items-center rounded-full border border-gray-200 dark:border-indigo-500 bg-white dark:bg-indigo-500/30 py-1.5 px-3 text-sm font-medium text-gray-900 dark:text-white">
                                                    <x-heroicon-o-tag class="h-4 w-4 mr-2" />
                                                    <span>{{ $tag }}</span>
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endif
            <div
                class="flex flex-col gap-y-4 p-4 justify-center items-center bg-gray-100 dark:bg-gray-800 rounded-lg text-center">
                <x-heroicon-o-inbox class="w-12 h-12 text-gray-700 dark:text-white" />
                <p class="text-gray-700 dark:text-white text-xl">Empty posts</p>
            </div>
        </div>
    @else
        <div class="pt-10">
            @if ($this->showSearch && $this->showSearch === '1')
                <div class="flex justify-center px-12 max-w-lg lg:px-0 mx-auto">
                    <div class="relative w-full mt-2">
                        <input type="text" name="search" id="search" placeholder="Search"
                            wire:model.live="search"
                            class="block w-full rounded-md border-0 py-1.5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
            @endif
            @if ($this->showFilters && $this->showFilters === '1')
                <div class="bg-white mt-10" x-data="{ open: false }">
                    <div x-show="open" class="relative z-50 sm:hidden" role="dialog" aria-modal="true">
                        <div class="fixed inset-0 bg-black bg-opacity-25"></div>

                        <div class="fixed inset-0 z-40 flex">
                            <div
                                class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white dark:bg-gray-900 py-4 pb-12 shadow-xl">
                                <div class="flex items-center justify-between px-4 mb-4">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Filters</h2>
                                    <button type="button" @click="open = false"
                                        class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white dark:bg-gray-800 p-2 text-gray-400">
                                        <span class="sr-only">Close menu</span>
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Filters -->
                                <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-6"
                                    x-data="{ openCategories: false }">
                                    <h3 class="-mx-2 -my-3 flow-root">
                                        <!-- Expand/collapse section button -->
                                        <button type="button" @click="openCategories = !openCategories"
                                            class="flex w-full items-center justify-between bg-white dark:bg-gray-900 px-2 py-3 text-sm text-gray-400 dark:text-white"
                                            aria-controls="filter-section-0" aria-expanded="false">
                                            <span class="font-medium text-gray-900 dark:text-white">Category</span>
                                            <span class="ml-6 flex items-center">
                                                <svg class="rotate-0 h-5 w-5 transform" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </button>
                                    </h3>
                                    <!-- Filter section, show/hide based on section state. -->
                                    <div x-show="openCategories" @click.away="openCategories = false" x-transition
                                        class="pt-6" id="filter-section-0">
                                        <div class="space-y-6">
                                            @foreach ($this->categories as $category)
                                                <div class="flex items-center" wire:key="{{ $category->id }}">
                                                    <input id="filter-mobile-{{ $category->slug }}" name="category"
                                                        wire:click="filterByCategory({{ $category->id }})"
                                                        value="new-arrivals" type="radio"
                                                        class="border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-mobile-{{ $category->slug }}"
                                                        class="ml-3 text-sm text-gray-500">
                                                        {{ $category->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-6"
                                    x-data="{ openTags: false }">
                                    <h3 class="-mx-2 -my-3 flow-root">
                                        <!-- Expand/collapse section button -->
                                        <button type="button" @click="openTags = !openTags"
                                            class="flex w-full items-center justify-between bg-white dark:bg-gray-900 px-2 py-3 text-sm text-gray-400 dark:text-white"
                                            aria-controls="filter-section-0" aria-expanded="false">
                                            <span class="font-medium text-gray-900 dark:text-white">Tags</span>
                                            <span class="ml-6 flex items-center">
                                                <svg class="rotate-0 h-5 w-5 transform" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </button>
                                    </h3>
                                    <!-- Filter section, show/hide based on section state. -->
                                    <div x-show="openTags" @click.away="openTags = false" x-transition class="pt-6"
                                        id="filter-section-0">
                                        <div class="space-y-6">
                                            @foreach ($this->tags as $tag)
                                                <div class="flex items-center" wire:key="{{ $tag->id }}">
                                                    <input id="filter-mobile-{{ $tag->slug }}" name="tag"
                                                        wire:click="filterByTags({{ $tag->id }})"
                                                        value="new-arrivals" type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-mobile-{{ $tag->slug }}"
                                                        class="ml-3 text-sm text-gray-500">
                                                        {{ $tag->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <section aria-labelledby="filter-heading"">
                        <h2 id="filter-heading" class="sr-only">Filters</h2>

                        <div class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 pb-4">
                            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                                <div class="relative inline-block text-left" x-data="{ open: false }">
                                    <div>
                                        <button type="button" @click="open = !open"
                                            class="group inline-flex justify-center text-sm font-medium text-gray-700 dark:text-white  hover:text-gray-900 dark:hover:text-gray-200"
                                            id="menu-button" aria-expanded="false" aria-haspopup="true">
                                            Sort
                                            <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 dark:text-gray-200 group-hover:text-gray-500 dark:group-hover:text-gray-200"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div x-show="open" @click.away="open = false" x-transition
                                        class="absolute left-0 z-10 mt-2 w-40 origin-top-left rounded-md bg-white dark:bg-gray-900 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                        tabindex="-1">
                                        <div class="py-1" role="none">
                                            <span wire:click="sortBy('best-rating')"
                                                class="text-gray-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-500 transition block px-4 py-2 text-sm cursor-pointer"
                                                role="menuitem" tabindex="-1" id="menu-item-1">
                                                Best Rating
                                            </span>
                                            <span wire:click="sortBy('newest')"
                                                class="text-gray-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-500 transition block px-4 py-2 text-sm cursor-pointer"
                                                role="menuitem" tabindex="-1" id="menu-item-2">
                                                Newest
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mobile filter dialog toggle, controls the 'mobileFiltersOpen' state. -->
                                <button type="button" @click="open = !open"
                                    class="inline-block text-sm font-medium text-gray-700 dark:text-white hover:text-gray-900 dark:hover:text-gray-200 sm:hidden">
                                    Filters
                                </button>

                                <div class="hidden sm:block">
                                    <div class="flow-root">
                                        <div
                                            class="-mx-4 flex items-center divide-x divide-gray-200 dark:divide-gray-700">
                                            <div class="relative inline-block px-4 text-left"
                                                x-data="{ open: false }">
                                                <button type="button" @click="open = !open"
                                                    class="group inline-flex justify-center text-sm font-medium text-gray-700 dark:text-white hover:text-gray-900 dark:hover:text-gray-200"
                                                    aria-expanded="false">
                                                    <span>Category</span>
                                                    @if (!empty($this->selectedCategory))
                                                        <span
                                                            class="ml-1.5 rounded border border-gray-300 dark:border-indigo-500 bg-gray-200 dark:bg-indigo-500/30 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700 dark:text-white">
                                                            1
                                                        </span>
                                                    @else
                                                        <span
                                                            class="ml-1.5 rounded border border-gray-300 dark:border-indigo-500 bg-gray-200 dark:bg-indigo-500/30 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700 dark:text-white">
                                                            0
                                                        </span>
                                                    @endif
                                                    <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 dark:text-gray-200 group-hover:text-gray-500 dark:group-hover:text-gray-200"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <div x-show="open" @click.away="open = false" x-transition
                                                    class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white dark:bg-gray-900 p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                    <form class="space-y-4">
                                                        @foreach ($this->categories as $category)
                                                            <div class="flex items-center"
                                                                wire:key="{{ $category->id }}">
                                                                <input id="filter-{{ $category->slug }}"
                                                                    name="category" value="new-arrivals"
                                                                    type="radio"
                                                                    wire:click="filterByCategory({{ $category->id }})"
                                                                    class="border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                                <label for="filter-category"
                                                                    class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900 dark:text-white">
                                                                    {{ $category->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="relative inline-block px-4 text-left"
                                                x-data="{ open: false }">
                                                <button type="button" @click="open = !open"
                                                    class="group inline-flex justify-center text-sm font-medium text-gray-700 dark:text-white hover:text-gray-900 dark:hover:text-gray-200"
                                                    aria-expanded="false">
                                                    <span>Tags</span>
                                                    @if (!empty($this->selectedTags))
                                                        <span
                                                            class="ml-1.5 rounded border border-gray-300 dark:border-indigo-500 bg-gray-200 dark:bg-indigo-500/30 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700 dark:text-white">
                                                            {{ count($this->selectedTags) }}
                                                        </span>
                                                    @else
                                                        <span
                                                            class="ml-1.5 rounded border border-gray-300 dark:border-indigo-500 bg-gray-200 dark:bg-indigo-500/30 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700 dark:text-white">
                                                            0
                                                        </span>
                                                    @endif
                                                    <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 dark:text-gray-200 group-hover:text-gray-500 dark:group-hover:text-gray-200"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <div x-show="open" @click.away="open = false" x-transition
                                                    class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white dark:bg-gray-900 p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                    <form class="space-y-4">
                                                        @foreach ($this->tags as $tag)
                                                            <div class="flex items-center"
                                                                wire:key="{{ $tag->id }}">
                                                                <input id="filter-{{ $tag->slug }}" name="tags"
                                                                    {{ in_array($tag->name, $this->selectedTagsName) ? 'checked' : '' }}
                                                                    value="{{ $tag->id }}" type="checkbox"
                                                                    wire:click="filterByTags({{ $tag->id }})"
                                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                                <label for="filter-tags"
                                                                    class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900 dark:text-white">
                                                                    {{ $tag->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active filters -->
                        <div class="bg-gray-100 dark:bg-gray-800">
                            <div class="mx-auto max-w-7xl px-4 py-3 sm:flex sm:items-center sm:px-6 lg:px-8">
                                @if ($this->selectedCategoryName || $this->selectedTagsName)
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-500 transition cursor-pointer"
                                        wire:click="clearFilters">
                                        Clear all filters
                                        <span class="sr-only">, active</span>
                                    </h3>
                                @else
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-white">
                                        Filters
                                        <span class="sr-only">, active</span>
                                    </h3>
                                @endif


                                <div aria-hidden="true"
                                    class="hidden h-5 w-px bg-gray-300 dark:bg-gray-700 sm:ml-4 sm:block"></div>

                                <div class="mt-2 sm:ml-4 sm:mt-0">
                                    <div class="-m-1 flex flex-wrap items-center">
                                        @if ($this->selectedCategoryName)
                                            <span
                                                class="m-1 inline-flex items-center rounded-full border border-gray-200 dark:border-indigo-500 bg-white dark:bg-indigo-500/30 py-1.5 px-3 text-sm font-medium text-gray-900 dark:text-white">
                                                <span>{{ $this->selectedCategoryName }}</span>
                                            </span>
                                        @endif
                                        @if ($this->selectedTagsName)
                                            @foreach ($this->selectedTagsName as $tag)
                                                <span wire:key="{{ $tag }}"
                                                    class="m-1 inline-flex items-center rounded-full border border-gray-200 dark:border-indigo-500 bg-white dark:bg-indigo-500/30 py-1.5 px-3 text-sm font-medium text-gray-900 dark:text-white">
                                                    <x-heroicon-o-tag class="h-4 w-4 mr-2" />
                                                    <span>{{ $tag }}</span>
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endif

            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div
                    class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                    @foreach ($this->posts() as $post)
                        <article class="flex flex-col items-start">
                            <div class="relative w-full">
                                <img src="{{ $post->getThumbnail() }}" width="1200" height="630"
                                    class="w-full rounded-lg" alt="">
                                <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-300/10"></div>
                            </div>
                            <div class="max-w-xl">
                                <div class="mt-8 flex items-center justify-between gap-x-4 text-xs">
                                    <div class="flex items-center gap-x-2">
                                        <time datetime="2020-03-16"
                                            class="text-gray-900 dark:text-gray-100">{{ $post->formatDate() }}</time>
                                        <span
                                            class="relative z-10 rounded-full bg-indigo-500/10 px-3 py-1 text-sm font-semibold leading-6 text-indigo-400 ring-1 ring-inset ring-indigo-500/20">
                                            {{ $post->category->name }}
                                        </span>
                                    </div>
                                    <div class="flex gap-x-6 text-gray-600 dark:text-gray-400">
                                        <span class="flex items-center gap-x-2 text-md">
                                            {{ $post->countLikes() }}
                                            <x-heroicon-o-heart class="w-4 h-4" />
                                        </span>
                                        <span class="flex items-center gap-x-2 text-md">
                                            {{ $post->countComments() }}
                                            <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4" />
                                        </span>
                                    </div>
                                </div>
                                <div class="flex justify-end gap-x-2 text-xs text-gray-600 dark:text-gray-400">
                                    <x-heroicon-o-clock class="w-4 h-4" />
                                    <span>{{ $post->getReadingTime() }}
                                        min read</span>
                                </div>
                                <div class="group relative">
                                    <h3
                                        class="mt-3 text-lg font-semibold leading-6 text-gray-900 dark:text-white group-hover:text-gray-800 dark:group-hover:text-gray-200">
                                        <a href="{{ route('blog.show', [$post->category->slug, $post->slug]) }}">
                                            <span class="absolute inset-0"></span>
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-900 dark:text-gray-100">
                                        {{ $post->excerpt }}
                                    </p>
                                </div>
                                <div class="relative mt-8 flex items-center gap-x-4">
                                    <img src="{{ $post->user->getProfileAvatar() }}" alt=""
                                        class="h-10 w-10 rounded-full bg-gray-100">
                                    <div class="text-sm leading-6">
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            <a href="{{ route('blog.author', $post->user->id) }}">
                                                <span class="absolute inset-0"></span>
                                                {{ $post->user->name }}
                                            </a>
                                        </p>
                                        <p class="text-gray-600 dark:text-gray-400">Co-Founder / CTO</p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>
                @if ($this->showLoadMore && $this->showLoadMore === '1' && $this->posts()->count() >= $this->postsCount)
                    <div class="mt-10 pb-10 flex justify-center">
                        <x-shared.button type="button" color="primary" text="Load more" size="md"
                            wire:click="loadMore" />
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
