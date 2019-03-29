Hallo {{ $booked->customer_name }},

Vielen Dank für deine Buchung und viel Freude bei deinem Erlebnis!

Aktivitätsname: {{ $booked->event_name }}
Koste: {{ $booked->cost }}
Platz: {{ $booked->city }}
Datum: {{ $booked->date }}
Zeit: {{ $booked->time }}
Begleitung erforderlich: {{ $booked->is_caregiver_required == 'Y' ? 'Ja' : 'Nein' }}
Warm ankommen: {{ $booked->arrive_before }}
Stornierungsbedingungen: {{ $booked->cancellation_policy }}

Solltest du Fragen an uns haben, kannst du uns gern per E-Mail unter hello@kidwedo.de erreichen.

Mit besten Grüßen
Dein Kidwedo-Team

__________________________________

Kidwedo
Akazienstrasse 3A
10823 Berlin
E-Mail: hello@kidwedo.de