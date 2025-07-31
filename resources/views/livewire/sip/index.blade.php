<main id="main" class="main">
    <div class="pagetitle">
        <h1>My SIPs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">SIPs</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <a href="{{ route('sips.form') }}" class="btn btn-primary mb-3">+ Create New SIP</a>

        <div class="card">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-body mt-3 table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Frequency</th>
                            <th>Day</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sips as $sip)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sip->amount }}</td>
                            <td>{{ ucfirst($sip->frequency) }}</td>
                            <td>{{ $sip->sip_day ?? '-' }}</td>
                            <td>{{ $sip->start_date }}</td>
                            <td>{{ $sip->end_date }}</td>
                            <td><span class="badge bg-success">{{ ucfirst($sip->status) }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="7">No SIPs found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>