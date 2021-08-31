<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                        {!! __('pagination.previous') !!}
                    </button>
                @endif
            </span>


            <!-- page number links here -->
            @foreach($elements as $element)
                @if(is_array($element))
                    @foreach($element as $page=>$url)
                        @if($page == $paginator->currentPage())
                            <span>
                                <button wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled" rel="gotoPage" class="w-10 px-2 py-1 mx-2 text-center text-white bg-blue-500 border rounded shadow cursor-pointer">
                                    {{ $page}}
                                </button>
                            </span>
                        @else
                        <span>
                            <button wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled" rel="gotoPage"  class="w-10 px-2 py-1 mx-2 text-center bg-white border rounded shadow cursor-pointer">
                                {{ $page}}
                            </button>
                        </span>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <!--  page number links end -->

            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                        {!! __('pagination.next') !!}
                    </button>
                @else
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
                        {!! __('pagination.next') !!}
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>
