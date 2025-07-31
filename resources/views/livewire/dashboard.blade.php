<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <section class="section dashboard">
        <div class="row">
            <!-- SIP Summary Card -->
            <div class="col-md-4">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Total SIPs</h5>
                        <h6>{{ $totalSips }} (Active: {{ $activeSips }})</h6>
                    </div>
                </div>
            </div>

            <!-- Invoices -->
            <div class="col-md-4">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Invoices</h5>
                        <p>Total: {{ $totalInvoices }}</p>
                        <p class="text-success">Success: {{ $successCount }}</p>
                        <p class="text-warning">Pending: {{ $pendingCount }}</p>
                        <p class="text-danger">Failed: {{ $failedCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
