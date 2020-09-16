@extends('welcome')

@section('content')

<link rel="stylesheet" href="{{ asset('styles/collection/collection.css') }}">

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

    @php $i = 0; @endphp

    @foreach($datasources as $datasource)

    <li class="nav-item">
        <a class="nav-link {{ $i == 0 ? 'active' : '' }}" id="pills-{{ $datasource }}-tab" data-toggle="pill"
            href="#pills-{{ $datasource }}" role="tab" aria-controls="pills-{{ $datasource }}"
            aria-selected="{{ $i == 0 ? 'true' : 'false' }}">{{ $datasource }}</a>
    </li>

    @php $i++; @endphp

    @endforeach

</ul>


<div class="tab-content" id="pills-tabContent">

    @foreach($collections as $datasourceName => $collection)

        <div class="tab-pane fade show active" id="pills-{{ $datasourceName }}" role="tabpanel"
            aria-labelledby="pills-{{ $datasourceName }}-tab">

            @foreach($collection['collections'] as $oneCollection)

                @foreach($oneCollection as $collectionInfo => $collectionData)
                    
                    @if($collectionInfo != 'orbs')
                        <h5 class="text-warning"><strong><ins>{{ $collectionInfo }}</ins></strong> : {{ $collectionData }}</h5>
                    @else

                    <table class="table table-striped table-dark">

                        @php $count = 0; @endphp
                        @foreach($collectionData as $contracts)

                            @if($count == 0)
                                <thead>
                                    <tr>
                                        
                                        @foreach($contracts as $dataName => $data)

                                            @if($dataName == 'asset')
                                                @foreach($data as $index => $metaData)
                                                    <th scope="col" >{{ $dataName . '_' . $index }}</th>
                                                @endforeach
                                            @else
                                                <th scope="col">{{ $dataName }}</th>
                                            @endif
                                        
                                        @endforeach
                                    </tr>
                                </thead>
                            @endif

                            <tbody>
                                <tr>

                                    @php $i = 0; @endphp
                                    @foreach($contracts as $dataName => $data)

                                        @if($dataName == 'token')
                                            <th {{ $i == 0 ? 'scope="row"' : '' }} >{{ $data['standard'] }}</th>
                                        @elseif($dataName == 'asset')
                                            @foreach($data as $index => $metaData)
                                                <th {{ $i == 0 ? 'scope="row"' : '' }} >{{ $metaData }}</th>
                                            @endforeach
                                        @else
                                            <th {{ $i == 0 ? 'scope="row"' : '' }} >{{ $data }}</th>
                                        @endif

                                        @php $i++; @endphp
                                    @endforeach

                                </tr>
                            </tbody>
                            @php $count ++; @endphp
                        @endforeach
                    </table>
                    @endif
                @endforeach
            @endforeach
        </div>
    @endforeach
</div>

@endsection
