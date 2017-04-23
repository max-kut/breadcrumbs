@if(!empty($separator_content) || !empty($separator_class))
    <style>
        ol.breadcrumb>li::before{
            display:none;
        }
    </style>
@endif

<div id="breadcrumbs">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <?php $i = 1; ?>
                @foreach($data as $d)

                    @if($i != count($data))
                        <li>
                            <a href="{{$d['link']}}">{!! $d['title'] !!}</a>
                        </li>
                        <li class="separator {{$separator_class}}">{!! $separator_content !!}</li>
                    @else
                        <li>
                            <p>{!! $d['title'] !!}</p>
                        </li>
                    @endif

                    <?php $i++; ?>
                @endforeach
            </ol>
        </div>
    </div>
</div>