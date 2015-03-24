@if ($breadcrumbs)
    @foreach ($breadcrumbs as $breadcrumb)
        @if (!$breadcrumb->last)
            <li>
                @if($breadcrumb->first)
                    <i class="fa fa-home"></i>
                @endif
                <a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a><i class="fa fa-angle-right"></i>
            </li>
        @else
            <li class="active">{{{ $breadcrumb->title }}}</li>
        @endif
    @endforeach
@endif
