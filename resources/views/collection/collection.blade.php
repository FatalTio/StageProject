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

                    @php if($collectionInfo == 'id') $collectionId = $collectionData . uniqid(); @endphp
                    
                    @if($collectionInfo != 'orbs')
                        <h5 class="text-warning"><strong><ins>{{ $collectionInfo }}</ins></strong> : {{ $collectionData }}</h5>
                    @else

                    <table id="{{ 'table_'. $collectionId }}" class="table table-striped table-dark">

                        @php $count = 0; @endphp
                        @foreach($collectionData as $contracts)

                            @if($count == 0)
                                <thead>
                                    <tr>
                                        
                                        @foreach($contracts as $dataName => $data)

                                            @if($dataName == 'asset')
                                                @foreach($data as $index => $metaData)

                                                    <th id="{{ $collectionId . $dataName  . '_' . $index . '_col' }}" scope="col" >
                                                        {{ $dataName . '_' . $index }}

                                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="col-icon bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                                        </svg>
                                                    </th>

                                                @endforeach

                                            @else
                                                <th id="{{ $collectionId . $dataName . '_col' }}" scope="col">{{ $dataName }}

                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="col-icon bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                                    </svg>
                                                </th>
                                            @endif
                                        @endforeach
                                    </tr>
                                </thead>
                            @endif

                            <tbody>
                                @php $newId = uniqid() @endphp
                                <tr id="{{ $collectionId . '_' . $newId }}" class="{{ $collectionId }}">

                                    @php $i = 0; @endphp
                                    @foreach($contracts as $dataName => $data)

                                    @php $scope = ($i == 0) ? 'scope="row"' : ''; @endphp

                                        @if($dataName == 'token')

                                            <th data-tr="{{ $collectionId . '_' . $newId }}" data-tbody="{{ $collectionId }}" class="{{ $collectionId . $dataName }}" {{ $scope }}>
                                                {{ $data['standard'] }}
                                            </th>

                                        @elseif($dataName == 'asset')

                                            @foreach($data as $index => $metaData)

                                                <th data-tr="{{ $collectionId . '_' . $newId }}" data-tbody="{{ $collectionId }}" class="{{ $collectionId . $dataName . '_' . $index }}" {{ $scope }}>
                                                    {{ $metaData }}
                                                </th>

                                            @endforeach

                                        @else
                                            <th data-tr="{{ $collectionId . '_' . $newId }}" data-tbody="{{ $collectionId }}" class="{{ $collectionId . $dataName }}" {{ $scope }}>{{ $data }}</th>
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

<script src="{{ asset('js/collection/collection.js') }}"></script>

@endsection
