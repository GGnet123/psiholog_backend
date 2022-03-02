<a href="?{{ getSortLink($request->all(), $attr) }}" class="text-white">
    @if ($request->sort == $attr && $request->sort_by == 'desc')
        <i class="icon-sort-amount-asc"></i>
    @elseif ($request->sort == $attr && $request->sort_by == 'asc')
        <i class="icon-sort-amount-desc"></i>
    @else
        <i class="icon-sort"></i>
    @endif
    {{ $name }}
</a>