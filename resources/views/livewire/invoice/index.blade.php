<main id="main" class="main">
    <div class="pagetitle">
        <h1>My Invoices</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Invoices</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body mt-3 table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SIP Amount</th>
                            <th>Scheduled Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice->amount }}</td>
                                <td>{{ $invoice->scheduled_date->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if ($invoice->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($invoice->status === 'success')
                                        <span class="badge bg-success">Success</span>
                                    @else
                                        <span class="badge bg-danger">Failed</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No invoices found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>