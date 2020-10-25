@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 m-md-4">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('failure'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('failure') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('warning') }}
                        </div>
                    @endif

                    <p>
                        {{ __('You are logged in!') }}
                        <hr>
                    </p>
                    <p>
                        <h4>
                            Your Credit: {{ $user->credit }} IRR
                        </h4>
                    </p>
                    <p>
                        <h5><a href="{{ route('credit.index') }}">Increase your credit</a></h5>
                        <hr>
                    </p>
                    <p>
                        <h4>Last Day Report:</h4>
                        @php $newest = $user->transactions->where('created_at', '>', Carbon\Carbon::now()->subDays(1)); @endphp
                        <b>All Transactions: </b> {{ $newest->count() }}
                        <br>
                        <b>Successful Transactions: </b> {{ $newest->where('status', 'SUCCEED')->count() }}
                        <br>
                        <b>Failed Transactions: </b> {{ $newest->where('status', 'FAILED')->count() }}
                        <br>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Transactions') }}</div>

                <div class="card-body">
                    <p>
                        <a href="{{ route('transaction.export', ['type' => 'pdf']) }}" class="btn btn-info">PDF Export</a>
                        <a href="{{ route('transaction.export', ['type' => 'xls']) }}" class="btn btn-info">XLS Export</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-">
                            <thead>
                            <th>ID</th>
                            <th>Price</th>
                            <th>Invoice</th>
                            <th>Status</th>
                            <th>Issue Date</th>
                            </thead>
                            @foreach($user->transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->price }}</td>
                                <td>{{ $transaction->invoice_id }}</td>
                                <td>{{ $transaction->status }}</td>
                                <td>{{ $transaction->updated_at ?? $transaction->created_at }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
