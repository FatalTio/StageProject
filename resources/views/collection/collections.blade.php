@extends('welcome')

@section('content')

<link rel="stylesheet" href="{{ asset('styles/collection/collections.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

    @php $i = 0; @endphp

    @foreach($datasources as $datasource)

        <li class="nav-item" id="datasourceChoice">
            <a class="nav-link datasources {{ $i == 0 ? 'active' : '' }}" id="pills-{{ $datasource }}-tab" data-toggle="pill"
                href="#pills-{{ $datasource }}" role="tab" aria-controls="pills-{{ $datasource }}"
                aria-selected="{{ $i == 0 ? 'true' : 'false' }}">{{ $datasource }}</a>
        </li>

        @php $i++; @endphp
    @endforeach
</ul>


<div class="tab-content" id="pills-tabContent">
    @php $collectionsCount = 0; @endphp
    @foreach($collections as $datasourceName => $collection)

        <div class="tab-pane fade collection_show {{ $collectionsCount == 0 ? 'show active' : '' }}" data-datasource="{{ $datasourceName }}" id="pills-{{ $datasourceName }}" role="tabpanel"
            aria-labelledby="pills-{{ $datasourceName }}-tab">

            <nav aria-label="Page navigation">
                {{-- <div class="nav nav-tabs ol-10 offset-1" id="nav-tab" role="tablist"> --}}
                <ul class="pagination col-10 offset-1">
                @php $iteration = 0; @endphp
                    @foreach($collection['collections'] as $oneCollection)

                        @foreach ($oneCollection as $collectionInfo => $collectionData )

                            @if($collectionInfo == 'id')

                                {{-- <a class="nav-link {{ $iteration == 0 ? 'active' : '' }}" id="{{ 'nav-' . $collectionId . '-tab' }}" data-toggle="tab" href="{{ '#nav-' . $collectionId }}" role="tab" 
                                aria-controls="{{ 'nav-' . $collectionId }}" aria-selected={{ $iteration == 0 ? 'true' : 'false' }}>
                                    {{ $collectionData }}
                                </a> --}}

                                <li class="page-item">
                                    <a class="page-link collections {{ $iteration == 0 ? 'current' : '' }}" 
                                    href="{{ '#' . $collectionData . '_' . $datasourceName }}">
                                        {{ $collectionData }}
                                    </a>
                                </li>

                                @php $iteration ++; @endphp
                            @endif

                        @endforeach
                    @endforeach
                </ul>
                {{-- </div> --}}
            </nav>

            <div class="col-10 offset-1">

                @foreach($collection['collections'] as $oneCollection)
                    @php $collectionId = $oneCollection['id']; @endphp

                    <div id="{{ $collectionId . '_' . $datasourceName }}" class="collectionsContent">

                        @php $countContent = 0; @endphp
                        @foreach($oneCollection as $collectionInfo => $collectionData)

                            {{-- <div class="tab-pane fade {{ $countContent == 0 ? 'show active' : '' }}" id="{{ 'nav-' . $collectionId }}" role="tabpanel" 
                            aria-labelledby="{{ 'nav-' . $collectionId . '-tab' }}"> --}}

                                @if(!is_array($collectionData))
                                        
                                    <h5 class="text-warning"><strong><ins>{{ $collectionInfo }}</ins></strong> : {{ $collectionData }}</h5>
                                    
                                @else

                                    <table class="table table-striped table-dark collectionTable">
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
                                                                    </th>

                                                                @endforeach
                                                            @else

                                                                <th id="{{ $collectionId . $dataName . '_col' }}" scope="col">
                                                                    {{ $dataName }}
                                                                </th>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                            @endif

                                            <tbody>
                                                <tr>
                                                    @foreach($contracts as $dataName => $data)
                                                        @php $scope = ($i == 0) ? 'scope="row"' : ''; @endphp

                                                        @if($dataName == 'token')

                                                            <th class="sorting {{ $collectionId . $dataName }}" {{ $scope }}>
                                                                {{ $data['standard'] }}
                                                            </th>

                                                        @elseif($dataName == 'asset')

                                                            @foreach($data as $index => $metaData)

                                                                <th class="sorting {{ $collectionId . $dataName . '_' . $index }}" {{ $scope }}>
                                                                    {{ $metaData }}
                                                                </th>

                                                            @endforeach

                                                        @else
                                                            <th class="sorting {{ $collectionId . $dataName }}" {{ $scope }}>{{ $data }}</th>
                                                        @endif

                                                    @endforeach
                                                </tr>
                                            </tbody>

                                            @php $count ++; @endphp
                                        @endforeach

                                    </table>
                                @endif

                            
                            @php $countContent++; @endphp
                        @endforeach
                    </div>
                    
                @endforeach 
            </div>
        </div>
        @php $collectionsCount ++; @endphp
    @endforeach
</div>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script src="{{ asset('js/collection/collections.js') }}"></script>

@endsection
