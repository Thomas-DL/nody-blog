@props(['categories', 'tags', 'selectedCategory', 'selectedTags', 'selectedCategoryName', 'selectedTagsName'])
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
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Filters -->
                <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-6" x-data="{ openCategories: false }">
                    <h3 class="-mx-2 -my-3 flow-root">
                        <!-- Expand/collapse section button -->
                        <button type="button" @click="openCategories = !openCategories"
                            class="flex w-full items-center justify-between bg-white dark:bg-gray-900 px-2 py-3 text-sm text-gray-400 dark:text-white"
                            aria-controls="filter-section-0" aria-expanded="false">
                            <span class="font-medium text-gray-900 dark:text-white">Category</span>
                            <span class="ml-6 flex items-center">
                                <svg class="rotate-0 h-5 w-5 transform" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>
                    </h3>
                    <!-- Filter section, show/hide based on section state. -->
                    <div x-show="openCategories" @click.away="openCategories = false" x-transition class="pt-6"
                        id="filter-section-0">
                        <div class="space-y-6">
                            @foreach ($categories as $category)
                                <div class="flex items-center" wire:key="{{ $category->id }}">
                                    <input id="filter-mobile-{{ $category->slug }}" name="category"
                                        wire:click="filterByCategory({{ $category->id }})" value="new-arrivals"
                                        type="radio" class="border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="filter-mobile-{{ $category->slug }}" class="ml-3 text-sm text-gray-500">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-6" x-data="{ openTags: false }">
                    <h3 class="-mx-2 -my-3 flow-root">
                        <!-- Expand/collapse section button -->
                        <button type="button" @click="openTags = !openTags"
                            class="flex w-full items-center justify-between bg-white dark:bg-gray-900 px-2 py-3 text-sm text-gray-400 dark:text-white"
                            aria-controls="filter-section-0" aria-expanded="false">
                            <span class="font-medium text-gray-900 dark:text-white">Tags</span>
                            <span class="ml-6 flex items-center">
                                <svg class="rotate-0 h-5 w-5 transform" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
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
                            @foreach ($tags as $tag)
                                <div class="flex items-center" wire:key="{{ $tag->id }}">
                                    <input id="filter-mobile-{{ $tag->slug }}" name="tag"
                                        wire:click="filterByTags({{ $tag->id }})" value="new-arrivals"
                                        type="checkbox"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="filter-mobile-{{ $tag->slug }}" class="ml-3 text-sm text-gray-500">
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
                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
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
                        <div class="-mx-4 flex items-center divide-x divide-gray-200 dark:divide-gray-700">
                            <div class="relative inline-block px-4 text-left" x-data="{ open: false }">
                                <button type="button" @click="open = !open"
                                    class="group inline-flex justify-center text-sm font-medium text-gray-700 dark:text-white hover:text-gray-900 dark:hover:text-gray-200"
                                    aria-expanded="false">
                                    <span>Category</span>
                                    @if (!empty($selectedCategory))
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
                                        @foreach ($categories as $category)
                                            <div class="flex items-center" wire:key="{{ $category->id }}">
                                                <input id="filter-{{ $category->slug }}" name="category"
                                                    value="new-arrivals" type="radio"
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
                                    @if (!empty($selectedTags))
                                        <span
                                            class="ml-1.5 rounded border border-gray-300 dark:border-indigo-500 bg-gray-200 dark:bg-indigo-500/30 px-1.5 py-0.5 text-xs font-semibold tabular-nums text-gray-700 dark:text-white">
                                            {{ count($selectedTags) }}
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
                                        @foreach ($tags as $tag)
                                            <div class="flex items-center" wire:key="{{ $tag->id }}">
                                                <input id="filter-{{ $tag->slug }}" name="tags"
                                                    {{ in_array($tag->name, $selectedTagsName) ? 'checked' : '' }}
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
                @if ($selectedCategoryName || $selectedTagsName)
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


                <div aria-hidden="true" class="hidden h-5 w-px bg-gray-300 dark:bg-gray-700 sm:ml-4 sm:block"></div>

                <div class="mt-2 sm:ml-4 sm:mt-0">
                    <div class="-m-1 flex flex-wrap items-center">
                        @if ($selectedCategoryName)
                            <span
                                class="m-1 inline-flex items-center rounded-full border border-gray-200 dark:border-indigo-500 bg-white dark:bg-indigo-500/30 py-1.5 px-3 text-sm font-medium text-gray-900 dark:text-white">
                                <span>{{ $selectedCategoryName }}</span>
                            </span>
                        @endif
                        @if ($selectedTagsName)
                            @foreach ($selectedTagsName as $tag)
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
