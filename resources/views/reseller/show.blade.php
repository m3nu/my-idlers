@section('title') {{$reseller->main_domain}} {{'reseller hosting'}} @endsection
<x-app-layout>
    <x-slot name="header">
        {{ __('Reseller hosting details') }}
    </x-slot>
    <div class="container">
        <x-card class="shadow mt-3">
            <div class="row">
                <div class="col-12 col-md-6 mb-2">
                    <h2>{{ $reseller->main_domain }}</h2>
                    <code>@foreach($labels as $label)
                            @if($loop->last)
                                {{$label->label}}
                            @else
                                {{$label->label}},
                            @endif
                        @endforeach</code>
                </div>
                <div class="col-12 col-md-6 text-md-end">
                    <h6 class="text-muted pe-lg-4">{{ $reseller->id }}</h6>
                    @if($reseller->active !== 1)
                        <h6 class="text-danger pe-lg-4">not active</h6>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="'col-12 col-lg-6">
                    <div class="table-responsive">
                        <table class="table table-borderless text-nowrap">
                            <tbody>
                            <tr>
                                <td class="px-2 py-2 font-bold text-muted">Type</td>
                                <td>{{ $reseller_extras[0]->reseller_type }}</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold text-muted">Main domain</td>
                                <td><a href="https://{{ $reseller->main_domain }}"
                                       class="text-decoration-none">{{ $reseller->main_domain }}</a></td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold text-muted">Location</td>
                                <td>{{ $reseller_extras[0]->location }}</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold text-muted">Provider</td>
                                <td>{{ $reseller_extras[0]->provider_name }}</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold text-muted">Price</td>
                                <td>{{ $reseller_extras[0]->price }} {{ $reseller_extras[0]->currency }}
                                    <small>{{\App\Process::paymentTermIntToString($reseller_extras[0]->term)}}</small>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold text-muted">Has dedicated IP?</td>
                                <td>
                                    @if(isset($ip_address[0]->address))
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold text-muted">IP</td>
                                <td><code>@if(isset($ip_address[0]->address))
                                            {{$ip_address[0]->address}}
                                        @endif
                                    </code></td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold text-muted">Owned since</td>
                                <td>
                                    @if(!is_null($reseller->owned_since))
                                        {{ date_format(new DateTime($reseller->owned_since), 'jS F Y') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold text-muted">Next due date</td>
                                <td>{{Carbon\Carbon::parse($reseller_extras[0]->next_due_date)->diffForHumans()}}
                                    ({{Carbon\Carbon::parse($reseller_extras[0]->next_due_date)->format('d/m/Y')}})
                                </td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold text-muted">Inserted</td>
                                <td>
                                    @if(!is_null($reseller->created_at))
                                        {{ date_format(new DateTime($reseller->created_at), 'jS M y g:i a') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold text-muted">Updated</td>
                                <td>
                                    @if(!is_null($reseller->updated_at))
                                        {{ date_format(new DateTime($reseller->updated_at), 'jS M y g:i a') }}
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="'col-12 col-lg-6">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td class="px-2 py-2 font-bold text-muted">Disk GB</td>
                            <td>{{$reseller->disk_as_gb}}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 font-bold text-muted">Accounts</td>
                            <td>{{$reseller->accounts}}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 font-bold text-muted">Domains Limit</td>
                            <td>{{$reseller->domains_limit}}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 font-bold text-muted">Subdomains Limit</td>
                            <td>{{$reseller->subdomains_limit}}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 font-bold text-muted">Bandwidth GB</td>
                            <td>{{$reseller->bandwidth}}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 font-bold text-muted">Email Limit</td>
                            <td>{{$reseller->email_limit}}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 font-bold text-muted">DB Limit</td>
                            <td>{{$reseller->db_limit}}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 font-bold text-muted">FTP Limit</td>
                            <td>{{$reseller->ftp_limit}}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <a href="{{ route('reseller.index') }}"
               class="btn btn-success btn-sm mx-2">
                Go back
            </a>
            <a href="{{ route('reseller.edit', $reseller->id) }}"
               class="btn btn-primary btn-sm mx-2">
                Edit
            </a>
        </x-card>
        @if(Session::has('timer_version_footer') && Session::get('timer_version_footer') === 1)
            <p class="text-muted mt-4 text-end"><small>
                    Built on Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}
                    )</small>
            </p>
        @endif
    </div>
</x-app-layout>
