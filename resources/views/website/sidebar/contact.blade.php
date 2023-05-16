<div class="contact_omics">
    <div style="text-align:left;">
        @foreach($contacts as $contact)
            <address class="card card-header p-2 mb-3">
                <span>{{ $contact->office_name }}</span><br>
                <span>{{ $contact->location_name }}</span><br>
                <p>
                    {{-- Phone : {{ $contact->telephone_no }}<br>
                    Fax : {{ $contact->fax_no }}<br> --}}
                    E-mail: contact@seronijihou.com<br>
                    <span class="ml-5">support@seronijihou.com</span>
                </p>
            </address>
        @endforeach
    </div>
</div>
