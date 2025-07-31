<main id="main" class="main">
    <div class="pagetitle">
        <h1>Create SIP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Create SIP</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body mt-3">

                        <form wire:submit.prevent="save">
                            <div class="mb-3">
                                <label for="amount" class="form-label">SIP Amount</label>
                                <input type="number" id="amount" class="form-control" wire:model.defer="amount">
                                @error('amount') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="frequency" class="form-label">Frequency</label>
                                <select id="frequency" class="form-control" wire:model="frequency">
                                    <option value="daily">Daily</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                                @error('frequency') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            @if ($frequency === 'monthly')
                                <div class="mb-3">
                                    <label for="sip_day" class="form-label">SIP Day (1–30)</label>
                                    <input type="number" id="sip_day" class="form-control" wire:model.defer="sip_day" min="1" max="30">
                                    @error('sip_day') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" id="start_date" class="form-control" wire:model.defer="start_date">
                                @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" id="end_date" class="form-control" wire:model.defer="end_date">
                                @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create SIP</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>