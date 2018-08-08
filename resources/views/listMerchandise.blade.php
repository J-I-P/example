@extends('master')
@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>

        @include('validationErrorMessage')
        <table>
            <tr>
                <th>名稱</th>
                <th>照片</th>
                <th>價格</th>
                <th>剩餘數量</th>
            </tr>

            @foreach($MerchandisePaginate as $Merchandise)
                <tr>
                    <td>
                        <a href="/merchandise/{{ $Merchandise->id }}">{{ $Merchandise->name }}</a>
                    </td>
                    <td>
                        <a href="/merchandise/{{ $Merchandise->id }}">
                            <img src="{{ $Merchandise->photo or 'assets/images/default-merchandise.jpg' }}">
                        </a>
                    </td>
                    <td>{{ $Merchandise->price }}</td>
                    <td>{{ $Merchandise->remain_count }}</td>
                </tr>
            @endforeach
        </table>
        {{ $MerchandisePaginate->links() }}
    </div>
@endsection